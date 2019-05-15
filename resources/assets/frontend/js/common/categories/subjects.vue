<template>
    <ul class="mc-contact" id="mc-subjects" v-bind:class="{active}" v-on:click.prevent>
        <li v-for="post in posts" class="mc">
          <a href="#" :class="post.mc_initial" :id="post.mc_name" v-text="post.mc_name" v-on:click="makeActive(post.mc_name)"></a>
        </li>
    </ul>
</template>

<script type="text-javascript">
import Vue from 'vue';
import { get } from '../../libs/api';

export default {
  name: 'Subjects',
  data() {
    return {
      active: null,
      posts:[]
      }
  },
  methods: {
    makeActive: function(item) {
      this.active = item;
      console.log(this.active)
    }
  },
  created() {
    get('api/categories/subjects')
    .then(({
          data
        }) => {
          console.log(data)
          this.posts = data
        })
        .catch(as => {
          console.log(as)
        })
  }

}

</script>

<style lang="scss">

</style>