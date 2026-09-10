<script setup>
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import apple from '@/assets/imgs/fruit-apple.png';
import banana from '@/assets/imgs/fruit-banana.png';
import grape from '@/assets/imgs/fruit-grape.png';
import peach from '@/assets/imgs/fruit-peach.png';
import watermelon from '@/assets/imgs/fruit-watermelon.png';
import {getBetween} from "@/utils.js";

// all the url for the fruits images
const images = [
  apple,
  banana,
  grape,
  peach,
  watermelon,
]

// the user's username
const username = ref('');
// if the user tried to submit
const formTried = ref(false);
// the form has successfully submitted
const formSubmitted = ref(false);
// routing purposes
const router = useRouter();
// the foods array list
const foods = ref([{
  x: 0,
  y: 0,
  image: null,
}])

// when page load generate a fruit imag for every fruit registered in images array
function generateFoods() {
  for (let i = 0; i < images.length; i++) {
    foods.value.push({
      x: getBetween(0, 70) + '%',
      y: getBetween(0, 70) + '%',
      image: images[i],
      delay: getBetween(1, 99) / 100 + 's',
      duration: getBetween(1, 5) + 's',
    })
  }
}

/**
 * handle form notation
 */
function handleForm() {
  formTried.value = true;
  if (username.value === '') return null;
  formSubmitted.value = true;
  setTimeout(() => {
    router.push({
      query: {
        name: username.value,
      },
      name: 'game',
    })
  }, 1500)
}

// generate food when page loads
onMounted(() => {
  generateFoods()
})
</script>

<template>
  <!--start-->
  <div id="start">
    <!--    clouds-->
    <div class="food-container">
      <img v-for="img in foods" :src="img.image" :style="{
        top: img.y,
        left: img.x,
        '--delay': img.delay,
        '--duration': img.duration,
      }" alt="" class="cloud-image">
    </div>
    <!--start svg-->
    <div id="start-svg" data-svg-name="start.svg">

      <div id="start-form">
        <h1 class="text-center">Food fang</h1>
        <img src="@/assets/svg/start.svg" alt="">
        <form @submit.prevent="handleForm">
          <div><input type="text" id="nickname" placeholder="Nickname" v-model="username"></div>
          <p v-if="formTried && username === ''" class="text-danger">You must insert a placeholder</p>
          <button class="btn btn-primary" :class="[formSubmitted && 'btn-sent']">Start Game</button>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
.cloud-image {
  position: absolute;
  animation: pulse 3s infinite ease-in-out alternate,
  moveY var(--duration) infinite ease-in-out alternate var(--delay);
}

@keyframes moveY {
  from {
    transform: translateY(0%);
  }
  to {
    transform: translateY(200%);
  }
}

@keyframes pulse {
  from {
    scale: .8;
  }
  to {
    scale: 1.2;
  }
}

.btn-sent {
  animation: started 1s ease-in-out 1 forwards;
}

@keyframes started {
  from {
    opacity: 1;
    transform: scale(1);
  }
  to {
    transform: scale(2);
    opacity: 0;
  }
}
</style>