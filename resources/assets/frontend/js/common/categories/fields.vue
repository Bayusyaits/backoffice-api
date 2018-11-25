<template>
    <div class="mc-casestudies" id="mc-fields">
        <div v-for="post in posts" :class="post.mc_initial" :id="post.mc_name">
          <h5>{{ post.mc_name }}</h5>
        </div>
    </div>
</template>

<script type="text-javascript">
import Vue from 'vue';
import { get } from '../../libs/api';

export default {
  name: 'fields',
  data() {
    return {
      posts:[]
      }
  },
  created() {
    get('api/categories/fields')
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