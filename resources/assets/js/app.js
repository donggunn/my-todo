/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import axios from 'axios';
import VueRouter from 'vue-router';
import VueKonva from 'vue-konva';
import App from './components/App.vue';
import Welcome from './components/Welcome.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Dashboard from './components/Dashboard.vue';
import ArticlesIndex from './components/articles/ArticlesIndex.vue';
import ArticlesCreate from './components/articles/ArticlesCreate.vue';
import ArticlesEdit from './components/articles/ArticlesEdit.vue';
import Drawer from './components/Drawer.vue';

import PageNotFound from './components/PageNotFound';

Vue.use(VueRouter);
Vue.use(VueKonva);

const routes = [{
  path: '/',
  name: 'home',
  component: Welcome,
}, {
  path: '/login',
  name: 'login',
  component: Login
}, {
  path: '/register',
  name: 'register',
  component: Register
}, {
  path: '/dashboard',
  name: 'dashboard',
  component: Dashboard
}, {
  path: '/drawer',
  name: 'drawer',
  component: Drawer
}, {
  path: 'articles',
  name: 'articleIndex',
  component: ArticlesIndex,
}, {
  path: 'articles/create',
  component: ArticlesCreate,
  name: 'createArticle',
}, {
  path: 'articles/edit/:id',
  component: ArticlesEdit,
  name: 'editArticle',
}, {
  path: '*',
  component: PageNotFound,
  name: 'pageNotFound'
}];

const router = new VueRouter({
  mode: 'history',
  routes,
});

const app = new Vue({
  el: '#app',
  router,
  components: { App },
});