<template>
    <div>
    <div v-if="loading">Chargement des événements...</div>
      <div v-for="event in events" :key="event.uid" class="event-card">
        <img :src="event.thumbnail" alt="Event Thumbnail" class="event-image"/>
        <h3>{{ event.title_fr }}</h3>
        <p>{{ event.description_fr }}</p>
        <a :href="event.canonicalurl" target="_blank">Plus de détails</a>
      </div>
    </div>
</template>

<script>
export default {
    props: ['filters'],
    data() {
      return {
        events: [],
        loading: true
      };
    },
    created() {
      this.fetchEvents();
    },
    watch: {
      filters: {
        deep: true,
        handler() {
          this.fetchEvents();
        }
      }
    },
    methods: {
      async fetchEvents() {
        this.loading = true;
        const { category, location } = this.filters;
        let apiUrl = 'https://public.opendatasoft.com/api/explore/v2.1/catalog/datasets/evenements-publics-openagenda/records?limit=20';

        if (category) {
          apiUrl += `&where=keywords_fr%20%3D%20%22${category}%22`; 
        }

        if (location) {
          apiUrl += `&where=location_city%20%3D%20%22${location}%22`;
        }

        try {
          const response = await fetch(apiUrl);
          const data = await response.json();
          this.events = data.results;
          this.loading = false;
        } catch (error) {
          console.error("Une erreur est survenue lors de la récupération des événements:", error);
          this.loading = false;
        }
      }
    }
}
</script>

<style>
.event-card {
  border: 1px solid #ccc;
  padding: 20px;
  margin: 20px 0;
  border-radius: 5px;
}
.event-image {
  width: 100%;
  max-width: 400px;
  display: block;
  margin-bottom: 20px;
}
</style>
