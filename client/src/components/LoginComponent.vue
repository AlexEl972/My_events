<template>
    <div class="login-container">
      <!-- Connexion Standard -->
      <div class="standard-login">
        <h2>Connexion Standard</h2>
        <input v-model="email" placeholder="Email" />
        <input v-model="password" type="password" placeholder="Mot de passe" />
        <button @click="login">Se connecter</button>
      </div>
      
      <!-- Connexion via Fournisseurs OAuth -->
      <div class="oauth-login">
        <h2>OU</h2>
        <button @click="redirectToProvider('google')">Se connecter avec Google</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
        async login() {
    try {
        const response = await axios.post('/api/login', {
            email: this.email,
            password: this.password
        });

        if (response.data.success) {
            this.$router.push('/home'); 
        } else {
            console.error('Erreur lors de la connexion:', response.data.message);
        }
    } catch (error) {
        console.error('Erreur réseau lors de la connexion:', error);
    }
}
,
      redirectToProvider(provider) {
        window.location.href = `http://localhost:8000/api/redirect/${provider}`;
      }
    }
  }
  </script>
  <style scoped>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Utilise toute la hauteur de la vue */
    padding: 20px;
    box-sizing: border-box;
    background-color: #f4f4f4; /* Arrière-plan gris clair pour une apparence douce */
  }

  .standard-login, .oauth-login {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
  }

  h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
  }

  input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
  }

  button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 4px;
    background-color: #007BFF; /* Couleur bleu primaire pour les boutons */
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #0056b3; /* Assombrir légèrement le bouton lors du survol */
  }

  .oauth-login {
    text-align: center;
  }

  .oauth-login h2 {
    margin-top: 0;
  }
</style>
