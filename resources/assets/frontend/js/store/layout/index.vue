<template>
  <div class="layout tg-b" id="tg-body" v-if="show">
    <!-- <my-component></my-component> -->
    <home></home>
    <about></about>
    <casestudies></casestudies>
    <contact></contact>
  </div>
</template>

<script type="text-javascript">
  import Vue from 'vue';
  import Contact from '../contact/index.vue';
  import About from '../about/index.vue';
  import Casestudies from '../casestudies/index.vue';
  import Home from '../home/index.vue';
  import {
    get
  } from '../../libs/api';
  
  // Vue.component('my-component', {
  //   template: '<div>A custom component!</div>'
  // })
  export default {
    name: 'Layout',
    components: {
      'home': Home,
      'about': About,
      'casestudies': Casestudies,
      'contact': Contact
    },
    data() {
      return {
        show: true,
        posts: [],
        model: {
          items: [],
          customer: {}
        },
        currentView: 'home'
      }
    }
  }
</script>

<style lang="scss">
  .tg-b {
    width: 100%;
    float: left;
    overflow: hidden;
    position: relative;
    top: 0px;
    > .mcm-home {
      background: blue;
    }
  }
  a {
    color: #42b983;
  }
</style>