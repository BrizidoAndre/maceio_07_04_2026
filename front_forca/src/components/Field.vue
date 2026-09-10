<script setup>
import {useId} from "vue";

const model = defineModel();
const id = useId();
defineOptions({
  inheritAttrs: false
})
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label">
      <slot/>
    </label>
    <input type="text" class="form-control" :id="id" v-model="model"
           v-bind="$attrs">
  </div>
</template>