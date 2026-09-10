<script setup>
</script>

<template>
  <div id="wrap">
    <div id="inner">
      <transition name="page" mode="out-in">
        <RouterView/>
      </transition>
    </div>
  </div>
</template>

<style>
.page-enter-from {
  transform: translateX(100%);
}

.page-enter-active,
.page-leave-active {
  transition: 1s;
}

.page-leave-to {
  transform: translateX(-100%);
}
</style>