<template>
  <div id="app">
    <AppHeader />
    <router-view></router-view>
    <div class="content-wrapper">
      <AppSidebar @filter-events="handleEventFilters"/>
      <EventList :filters="eventFilters"/>
    </div>
  </div>
</template>


<script>
import AppHeader from './components/AppHeader.vue';
import EventList from './components/EventList.vue';
import AppSidebar from './components/AppSidebar.vue';

export default {
  name: 'App',
  components: {
    AppHeader,
    AppSidebar,
    EventList,
  },
  data() {
    return {
      eventFilters: {
        category: '',
        location: ''
      }
    };
  },
  methods: {
    handleEventFilters(filters) {
      this.eventFilters = filters;
    },
    checkRouteForId() {
      if (this.$route.query.id) {
        localStorage.setItem('id', this.$route.query.id);
      }
    }
  },
  watch: {
    '$route': 'checkRouteForId'
  },
  mounted() {
    this.checkRouteForId();
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.content-wrapper {
  display: flex;
  justify-content: space-between;
}
</style>
