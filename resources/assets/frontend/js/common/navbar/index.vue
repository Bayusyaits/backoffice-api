<template>
    <header class="tg-h" id="tg-header">
        <div class="header-container">
            <div class="header-inner">
                <div class="flex">
                    <div class="flex-start">
                        <div class="flex-column">
                            <div class="header-logo">
                                <a href="/">
                                    <img class="mm-l_1" alt="Primary Logo" width="80" height="40" src="https://res.cloudinary.com/limononoto/image/upload/v1521290953/personal_web/uploads/logos/bayusyaits.svg" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-end">
                        <div class="flex-column">
                            <button type="button" class="nav-icon"></button>
                        </div>
                    </div>
                </div>
                <nav class="dm-nv" role="navigation">
                    <div class="flex-end">
                        <ul class="dm-ul flex-column">
                            <li v-for="post in posts" class="dm-li">
                                <a href="#" :class="post.dm_initial" v-scroll-to="post.dm_url" v-text="post.dm_name"></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
    import Vue from 'vue';
    import {
        get
    } from '../../libs/api';
    export default {
        name: 'navbar',
        data() {
            return {
                show: false,
                posts: [],
                model: {
                    items: [],
                    customer: {}
                },
                msg: 'Welcome to Your Vue.js App'
            }
        },
        methods: {

        },
        created() {
            get('api/pages/menu')
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
.tg-h {
    position: relative;
    display: block;
    padding: 0px;
    .header-inner {
        position: fixed;
        top: 15px;
        left: 0px;
        right: 0px;
        z-index: 50;
        pointer-events: none;
        .header-logo {
            pointer-events: visible;
            a {
                margin: 10px;
                img {
                    max-height: 100%;
                }
            }
        }
        button{
            vertical-align: baseline;
            border: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 40px;
            height: 40px;
            cursor: pointer;
            pointer-events: visible;
        }
        .dm-nv {
            position: fixed;
            top: 15px;
            top: 15px;
            left: 0px;
            right: 0px;
            z-index: 50;
            pointer-events: none;
                ul {
                display: table-cell;
                vertical-align: middle;
                text-align: center;
                pointer-events: visible;
                li {
                    list-style: none;
                    display: inline-block;
                    position: relative;
                    margin: 0px 20px;
                    a {
                        display: block;
                        text-decoration: none;
                    }
                }
            }
        }
    }
}
</style>