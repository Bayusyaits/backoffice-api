
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Index from '../store/layout/index.vue';

import Auth from '../store/auth/index.vue';

const Routes = new VueRouter({
	mode: 'history',
	routes: [{
	path: '/',
	  // ini hanya alias route kalau dilaravel biasa kita pakai as atau name
      // ini path view, maksudnya bila kita mengunjungi http://localhost:8000/forum maka route ini yg akan menghandle
      // penting diingat path: '/' ini bukan berarti http://localhost:8000/ melainkan http://localhost:8000/forum
      // ini adalah tampilan/component yang akan munculkan saat user mengunjungi http://localhost:8000/forum - kita belum buat component ini
	name: 'Index', 
	component: Index
	},
	{
	path: '/auth',
	  // ini hanya alias route kalau dilaravel biasa kita pakai as atau name
      // ini path view, maksudnya bila kita mengunjungi http://localhost:8000/forum maka route ini yg akan menghandle
      // penting diingat path: '/' ini bukan berarti http://localhost:8000/ melainkan http://localhost:8000/forum
      // ini adalah tampilan/component yang akan munculkan saat user mengunjungi http://localhost:8000/forum - kita belum buat component ini
	name: 'Auth', 
	component: Auth
	}
	// {path: '/', redirect: '/home'},
	// {name: 'Home', path: '/home', component: Home}
	]
})

export default Routes;