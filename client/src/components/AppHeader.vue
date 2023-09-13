<template>
  <header class="app-header">
    <a href="http://localhost:8080">
    <img src="@/assets/logo.png" alt="Vue logo" class="logo"/>
</a>
    <div class="profile-dropdown" @click="toggleDropdown">
      {{ isUserLoggedIn ? 'Profil' : 'Profil' }}
      <ul v-if="showDropdown">
        <li v-if="!isUserLoggedIn" @click="register">S'inscrire</li>
        <li v-if="!isUserLoggedIn" @click="login">Se connecter</li>
        <li v-if="isUserLoggedIn" @click="profil">MonProfil</li>
        <li v-if="isUserLoggedIn" @click="logout">Se déconnecter</li>
      </ul>
    </div>
  </header>
</template>

<script>
export default {
data() {
  return {
    showDropdown: false,
    isUserLoggedIn: false,  // Add this line
  }
},
mounted() {
  // Check for user session in localStorage when the component is mounted
  this.isUserLoggedIn = !!localStorage.getItem('id');
},
methods: {
  toggleDropdown() {
    this.showDropdown = !this.showDropdown;
  },
  register() {
    this.$router.push({ name: 'signup' });
  },
  login() {
    this.$router.push({ name: 'login' });
  },
  logout() {
    localStorage.removeItem('id'); // Remove user ID from localStorage
    this.isUserLoggedIn = false;   // Update user session state
  },
  profil() {
    this.$router.push({ name: 'profil' });
  },
}
}
</script>

<style scoped>
.app-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background: linear-gradient(90deg, #ff0084, #ff8c00);
  color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.logo {
  height: 50px;
  filter: brightness(2);
  transition: transform 0.3s;
}

.logo:hover {
  transform: scale(1.05);
}

.profile-dropdown {
  position: relative;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: background-color 0.3s;
  border-radius: 10px;
  padding: 5px 15px;
}

.profile-dropdown:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

.profile-dropdown::after {
  content: "\25BC";
  margin-left: 5px;
  font-size: 10px;
  transition: transform 0.3s;
}

.profile-dropdown:hover::after {
  transform: translateY(3px);
}

.profile-dropdown ul {
  display: block;
  position: absolute;
  top: 100%;
  right: 0;
  background-color: #fff;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 5px;
  list-style-type: none;
  margin: 10px 0 0 0;
  padding: 0;
  z-index: 1000;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  max-width: 200px;
  overflow: hidden;
}

.profile-dropdown ul li {
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.3s;
}

.profile-dropdown ul li:first-child {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.profile-dropdown ul li:last-child {
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}

.profile-dropdown ul li:hover {
  background-color: #f5f5f5;
  transform: scale(1.05);
}

</style>
