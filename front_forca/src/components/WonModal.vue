<script setup>
defineProps({
  winner: '',
  hasWon: '',
})
const emits = defineEmits(['restart'])
</script>

<template>
  <div class="modal-won-bg">
    <div class="modal-won">
      <h2 v-if="hasWon">{{ winner }} has won</h2>
      <h2 v-else>Nobody has won</h2>
      <button @click="emits('restart')" class="btn btn-success">Play Again</button>
    </div>
  </div>
</template>

<style scoped>
.modal-won-bg {
  position: fixed;
  width: 100vw;
  height: 100vh;
  z-index: 1;
  background: rgba(0, 0, 0, .7);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-won {
  padding: 2rem;
  border-radius: .5rem;
  background: white;
}
</style>