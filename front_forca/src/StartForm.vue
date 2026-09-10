<script setup>
import {computed, reactive, ref} from "vue";
import Radio from "@/components/Radio.vue";
import Field from "@/components/Field.vue";

const emits = defineEmits(['handleSubmit'])
const game = reactive({
  player_one: '',
  player_two: '',
  mode: "One by One"
})
const steps = ref(0);
const shouldBeDisabled = computed(() => {
  if (game.mode === 'One by One') {
    return game.player_one === '' || game.player_two === '';
  }
  return game.player_one === '';
})
</script>

<template>
  <div id="users" class="modal-form" title="User Registration" v-if="steps === 0">
    <h2>Select game mode</h2>
    <radio v-model="game.mode" value="One by One">One by One</radio>
    <radio v-model="game.mode" value="Computador">Computer</radio>
    <button class="btn btn-primary" @click="steps++">Next</button>
  </div>
  <div class="modal-form" title="User Registration" v-else>
    <form @submit.prevent="emits('handleSubmit', game)">
      <h2>Sign player(s)</h2>
      <field v-model="game.player_one">Player one</field>
      <field v-if="game.mode !== 'Computador'" v-model="game.player_two">Player two</field>
      <button :disabled="shouldBeDisabled" class="btn btn-primary" id="start" type="submit">Start Game</button>
    </form>
  </div>
</template>

<style scoped>
.modal-form {
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: clamp(300px, 90%, 800px);
  padding: 2rem;
  border-radius: .5rem;
  box-shadow: 0 0 0 1000px rgba(0, 0, 0, .4);
  background: white;
}
</style>