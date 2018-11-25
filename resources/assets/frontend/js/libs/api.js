
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import VueAxios from 'vue-axios';
import VueResource from 'vue-resource';
import axios from 'axios';
Vue.use(VueAxios, VueResource, axios);


export function get(url, params) {
	return axios({
		method: 'GET',
		url:url,
		params: params
	})
}

export function byMethod(method, url, data) {
	return axios({
		method: method,
		url: url,
		data: data
	})
}

// new Vue(Vue.util.extend({ router }, App)).$mount('#app');
