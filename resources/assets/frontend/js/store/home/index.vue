<template>
  <section class="mcm-home" :id="posts.mtp_title_en" v-scrolled>
    <div class="section-inner">
      <div class="mtp-mm">
        <div class="mm" ref="container">
          <img class="mm-img" :class="posts.mm_initial"  :alt="posts.mm_alt" :src="posts.mm_src" />
        </div>
        <div class="mtp">
          <div :class="posts.mtp_initial">
            <div class="column row">
              <div class="column-1">
                <h5 v-text="posts.mtp_caption_en"></h5>
                <h1 v-text="posts.mtp_content_en"></h1>
              </div>
            </div>
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
    name: 'Home',
    components: {},
    data() {
      return {
        posts: [],
        heightCol: { }
      }
    },
    methods: {
    },
    mounted () {
      this.$nextTick(() => {
        console.log(this.$el.clientHeight)
      })
    },
    created() {
      get('api/pages/home')
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
  .mcm-home {
    height: 100vh;
    >.section-inner {
      position: relative;
      overflow: hidden;
      float: left;
      max-height: 100vh;
      >.mtp-mm {
        position: fixed;
        transform: translate3d(0px, 0px, 0px);
        opacity: 1;
        width: 100%;
        >.mm {
          position: relative;
          float: left;
          overflow: hidden;
          width: 100%;
          height: 100vh;
          >.mm-img {
            max-width: none;
            max-height: none;
            float: none;
            position: absolute;
            width: 100%;
            top: 0px;
          }
        }
        >.mtp {
          position: absolute;
          display: table-cell;
          height: 100%;
          vertical-align: middle;
        }
      }
    }
  }
</style>