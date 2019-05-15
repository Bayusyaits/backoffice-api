<template>
  <div class="container">
    <transition name="fade" mode="out-in">
        <router-view class="page" :key="$route.path"></router-view>
    </transition>
  </div>
</template>
<script>

</script>
<style>
</style>