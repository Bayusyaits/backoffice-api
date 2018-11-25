<template>
    <section class="mcm-casestudies" :id="posts.mtp_title_en" v-scrolled>
        <div class="column row">
            <div class="column-2 row">
              <h5 v-text="posts.mtp_title_en"></h5>
              <h2 v-text="posts.mtp_caption_en"></h2>
            </div>
            <div class="column-2 row">
              <p v-text="posts.mtp_content_en"></p>
            </div>
        </div>
        <fields></fields>
        <projects></projects>
    </section>
</template>

<script type="text-javascript">
import Vue from 'vue';
import { get } from '../../libs/api';
import Fields from '../../common/categories/fields.vue';
import Projects from './projects/';

export default {
  name: 'Casestudies',
  components: {
    'fields': Fields,
    'projects': Projects
  },
  data() {
    return {
      posts:[]
      }
  },
  created() {
    get('api/pages/case-studies')
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
  .mcm-casestudies {
    position: relative;
    float: left;
    width: 100%;
  }
</style>