<template>
  <section class="mcm-contact" :id="posts.mtp_title_en" v-scrolled>
    <div :class="posts.mtp_initial">
      <div class="column">
        <div class="column-1">
          <h1 v-text="posts.mtp_content_en"></h1>
        </div>
      </div>
    </div>
    <subjects></subjects>
  </section>
</template>

<script type="text-javascript">
  import Vue from 'vue';
  import {
    get
  } from '../../libs/api';
  import Subjects from '../../common/categories/subjects.vue';
  
  export default {
    name: 'Contact',
    components: {
      'subjects': Subjects
    },
    data() {
      return {
        posts: []
      }
    },
    created() {
      get('api/pages/contact')
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
  .mcm-contact {
    position: relative;
    float: left; 
    overflow: hidden;;
  }
</style>