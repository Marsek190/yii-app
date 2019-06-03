import VueRouter from 'vue-router';

import LandingPage from './src/components/pages/LandingPage.vue';
import AboutPage from './src/components/pages/AboutPage.vue';
import LoginPage from './src/components/pages/LoginPage.vue';
import UserListPage from './src/components/pages/UserListPage.vue';

let routes = [{
    path: '/',
    component: LandingPage,
    name: 'landing'
  },
  {
    path: '/about',
    component: AboutPage,
    name: 'about'
  },
  {
    path: '/login',
    component: LoginPage,
    name: 'login'
  },
  {
    path: '/users',
    component: UserListPage,
    name: 'users'
  }
];

let router = new VueRouter({
  mode: 'history',
  routes
});

export default router;
