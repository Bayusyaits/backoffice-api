/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';

import App from './App.vue';
import Router from './router';
import Navbar from './common/navbar';
import Footer from './common/footer';
import VueLazyload from 'vue-lazyload';
import $ from './jquery/jquery.min.js';
import vueScrollto from 'vue-scrollto';

Vue.use(vueScrollto);

window.jQuery = window.$ = require("./jquery/jquery.min.js");

//vue lazyload or with options
Vue.use(VueLazyload, {
  lazyComponent: true,
  preLoad: 1.3,
  // the default is ['scroll', 'wheel', 'mousewheel', 'resize', 'animationend', 'transitionend']
  listenEvents: [ 'scroll' ],
  error: 'https://res.cloudinary.com/limononoto/image/upload/v1521294359/personal_web/uploads/icons/error.png',
  loading:'https://res.cloudinary.com/limononoto/image/upload/v1521294360/personal_web/uploads/icons/loading.gif',
  attempt: 1
})


//scrolled visible
Vue.directive('scrolled', {
  inViewport (el) {
    var rect =el.getBoundingClientRect()
        return !(rect.bottom < 0 || rect.right < 0 || rect.left > window.innerWidth ||
             rect.top > window.innerHeight)
  },

  bind: function (el,binding) {
    el.classList.add('not-visible')
    el.$onScroll = function() {
      if (binding.def.inViewport(el)) {
        el.classList.add('already-visible')
        el.classList.remove('not-visible')
        binding.def.unbind(el, binding)        
      }
    }
    document.addEventListener('scroll', el.$onScroll)
  },
  inserted: function (el, binding) {
    el.$onScroll()  
  },
  update: function () {},
  componentUpdated: function () {},
  unbind: function (el,binding) {
    document.removeEventListener('scroll', el.$onScroll)
    delete el.$onScroll
  }  
})

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

//format money
Vue.filter('formatMoney', (value) => {
  return Number(value)
  .toFixed(2)
  .replace()
})

const app = new Vue({
  el: '#app',
  components: {
    'navbar': Navbar,
    'foot': Footer,
    'page': App
  },
  router: Router

})

// new Vue(Vue.util.extend({ router }, App)).$mount('#app');
