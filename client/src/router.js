// router.js
import { createRouter, createWebHistory } from 'vue-router';
import LoginComponent from './components/LoginComponent';
import SignUpComponent from './components/SignUp';
import profil from './components/App-Profil';

const routes = [
    {
      path: '/login',
      name: 'login',
      component: LoginComponent
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignUpComponent
    },
    {
      path: '/profil',
      name: 'profil',
      component: profil
    }
    // Ajoutez d'autres routes au besoin
  
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
