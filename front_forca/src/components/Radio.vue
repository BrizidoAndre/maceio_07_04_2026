<script setup>
import {useId} from "vue";

const model = defineModel();
defineOptions({
  inheritAttrs: false
})
const id = useId();
</script>

<template>
  <div class="form-check">
    <input class="form-check-input" type="radio" v-model="model" :id="id" v-bind="$attrs">
    <label class="form-check-label" :for="id">
      <slot/>
    </label>
  </div>
</template>