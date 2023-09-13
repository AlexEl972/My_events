<template>
    <div class="signup-container">
      <div class="standard-signup">
        <h2>Inscription Standard</h2>
        <input v-model="name" placeholder="Nom complet" />
        <input v-model="email" placeholder="Email" />
        <input v-model="password" type="password" placeholder="Mot de passe" />
        <input v-model="password_confirmation" type="password" placeholder="Confirmer le mot de passe" />
        <button @click="signup">S'inscrire</button>
      </div>
      
      <div class="oauth-signup">
        <h2>OU</h2>
        <button @click="redirectToProvider('google')">S'inscrire avec Google</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      };
    },
    methods: {
        
        async signup() {
    try {
      const response = await axios.post('http://localhost:8000/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      });
      
      // Gérer la réponse
      if (response.data.success) {
        this.$router.push('/login');
      } else {
        console.error('Erreur lors de l\'inscription:', response.data.message);
      }
      
    } catch (error) {
      console.error('Erreur réseau lors de l\'inscription:', error);
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
  .signup-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Utilise toute la hauteur de la vue */
    padding: 20px;
    box-sizing: border-box;
    background-color: #f4f4f4; /* Arrière-plan gris clair pour une apparence douce */
  }

  .standard-signup, .oauth-signup {
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

  .oauth-signup {
    text-align: center;
  }

  .oauth-signup h2 {
    margin-top: 0;
  }
</style>
