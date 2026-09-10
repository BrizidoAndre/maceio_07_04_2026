<script setup>
import {onMounted, reactive} from "vue";
import {useRoute} from "vue-router";

const gameInfo = reactive({
  username: 'John doe',
  points: 10000,
  time: 60,
})
const route = useRoute();

function getParameters() {
  const {query} = route;
  if (query.username) {
    gameInfo.username = query.username;
  }
  if (query.points) {
    gameInfo.points = query.points;
  }
}

onMounted(() => {
  getParameters()
})
</script>

<template>
  <div id="end">
    <!--end results-->
    <img v-if="gameInfo.points >= 10000" src="@/assets/svg/game-success.svg" alt="" class="game-result">
    <img v-else src="@/assets/svg/game-fail.svg" alt="" class="game-result">
    <div class="container-points" id="end-result-svg" data-svg-name="game-result.svg">
      <h4 id="text-nickname-2">{{ gameInfo.username }}</h4>
      <h4 id="text-score-2">{{ gameInfo.points }}</h4>
      <h4 id="text-time">01:00</h4>
      <router-link to="/" class="btn btn-success btn-lg">Restart Game</router-link>
    </div>
  </div>
</template>

<style scoped>
#end-result-svg {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

.container-points {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.game-result {
  position: absolute;
  top: 50%;
  left: 50%;
  scale: .4;
  transform: translateY(-60%) translateX(-50%);
  width: 640px;
  height: 585px;
}
</style>