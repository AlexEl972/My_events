<template>
  <div class="sidebar">
    <select v-model="selectedCategory">
      <option v-for="category in categories" :key="category" :value="category">
        {{ category }}
      </option>
    </select>

    <input v-model="locationName" placeholder="Localisation" />

    <button @click="confirmFilters">Filtrer</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedCategory: '',
      categories: ['','concert', 'musique', 'atelier', 'exposition', 'salon', 'gratuit', 'danse', 'balfolk', 'sport', 'théâtre',],
      locationName: ''
    };
  },
  methods: {
    fetchLocationName(latitude, longitude) {
  const apiKey = 'AIzaSyCKbg-B4t0NNnlF_mhUNmAWH5KMA5x9BsI';
  fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`)
    .then(response => response.json())
    .then(data => {
      if (data.status === "OK") {
        const cityComponent = data.results[0].address_components.find(component => component.types.includes('locality'));
        if(cityComponent) {
          this.locationName = cityComponent.short_name;
        } else {
          console.error('City not found in geocoding results.');
        }
      } else {
        console.error('raté', data.status);
      }
    })
    .catch(error => {
      console.error('raté', error);
    });
},
    confirmFilters() {
      this.$emit('filter-events', {
        category: this.selectedCategory,
        location: this.locationName
      });
    }
  },
  mounted() {
    navigator.geolocation.getCurrentPosition(position => {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
      this.fetchLocationName(latitude, longitude);
    });
  }
}
</script>

<style scoped>
.sidebar {
  width: 250px;
  height: 100%;
  padding: 20px;
  background-color: #f5f5f5;
  border-right: 1px solid #ccc;
}

select,
input,
button {
  display: block;
  width: 90%;
  margin-bottom: 10px;
  padding: 8px 12px;
}

button {
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
