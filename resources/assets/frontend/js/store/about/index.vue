<template>
    <section class="mcm-about" :id="posts.mtp_title_en" v-scrolled>
      <div class="section-inner">
          <div  :class="posts.mtp_initial">
            <div class="column row">
              <div class="column-2">
                <h5 v-text="posts.mtp_title_en"></h5>
                <h2 v-text="posts.mtp_caption_en"></h2>
              </div>
              <div class="column-2">
                <p v-text="posts.mtp_content_en"></p>
              </div>
            </div>
          </div>
        </div>
    </section>
</template>

<script type="text-javascript">
import Vue from 'vue';
import { get } from '../../libs/api';

export default {
  name: 'About',
  components: {
  },
  data() {
    return {
      posts:[]
      }
  },
  created() {
    get('api/pages/about')
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
  .mcm-about {
    position: relative;
    float: left;
    width: 100%;
    .section-inner {
      width: 100%;
      background-color: #FBFBFB;
      overflow: hidden;
      float: left;
    }
  }
</style>