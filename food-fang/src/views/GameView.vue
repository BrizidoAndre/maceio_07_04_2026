<script setup>
import bar from "@/assets/imgs/bar-top.png";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {useRoute, useRouter} from "vue-router";

// importing images
import apple from '@/assets/imgs/fruit-apple.png'
import banana from '@/assets/imgs/fruit-banana.png'
import grape from '@/assets/imgs/fruit-grape.png'
import peach from '@/assets/imgs/fruit-peach.png'
import watermelon from '@/assets/imgs/fruit-watermelon.png'
import bomb from "@/assets/imgs/bomb.png";
import {getBetween} from "@/utils.js";

// array of fruits images
const images = [
  apple,
  banana,
  grape,
  peach,
  watermelon,
]

const foods = ref([]);
const foodSelected = reactive({
  x: null,
  y: null,
});
const canSelect = ref(true);
const tableSize = 600;
const numberSide = 8;
const foodSize = tableSize / numberSide;

// route related objects
const router = useRouter();
const route = useRoute();

// game info
const gameInfo = reactive({
  username: '',
  points: 0,
})

// seconds
const seconds = ref(0);
// max size of the bar
const barFullLength = 530;
// how long shoud the bar be
const barLength = computed(() => {
  const piece = barFullLength / 60;
  return piece * seconds.value;
})
// how much time there is left
const timeLeft = computed(() => {
  return Math.abs(60 - seconds.value);
})

// every seconds increase the number of seconds
function startLoader() {
  setInterval(() => {
    seconds.value++;
  }, 1000)
}

// watch, for every second when it
// reaches 60 go to end page
watch(() => seconds.value, value => {
  if (value === 60) {
    router.push({
      name: 'end',
      query: {
        ...gameInfo
      }
    })
  }
})

// get username from query params
function getUsername() {
  let name = route.query?.name
  if (!name) {
    name = 'John Doe'
  }
  gameInfo.username = name;
  gameInfo.points = 0;
}

// every time the game starts
function startGame() {
  const maxElements = 8 * 8;
  for (let i = 0; i < maxElements; i++) {
    foods.value.push({
      index: i,
      x: (i % 8),
      y: (Math.floor(i / 8)),
      image: generateFoodImage(),
      appear: false,
    })
  }
  checkFoodItems();
}

function generateFoodImage() {
  let smallChance = getBetween(0, 40);
  if (smallChance > 38) {
    return bomb;
  }
  return images[getBetween(0, images.length)]
}

function handleBomb(x, y) {
  const bomb = foods.value.find(item => item.x === x && item.y === y);
  bomb.appear = true;
  const bombedFoods = foods.value.filter(item => item.x === x || item.y === y);
  gameInfo.points += bombedFoods.length * 20;
  setTimeout(() => {
    bombedFoods.forEach(food => {
      food.appear = true;
      setTimeout(() => {
        food.image = generateFoodImage();
        food.appear = false;
        resetSelected();
        checkFoodItems()
      }, 500)
    })
  }, 500)
}

function pressFood(x, y, imageUrl) {
  // if user cannot select then it shouldn't
  if (!canSelect.value) return null;
  // if element is not selected then select it
  if (foodSelected.x === null && foodSelected.y === null) {
    if (imageUrl.includes('bomb')) {
      handleBomb(x, y);
      return null;
    }
    foodSelected.x = x;
    foodSelected.y = y;
    return null;
  }
  // get cartesian distances
  const xDif = Math.abs(foodSelected.x - x);
  const yDif = Math.abs(foodSelected.y - y);
  let totalDif = xDif + yDif;

  // is second press possible | adjacent to the first element?
  // if not then nothing happens
  // and the first element is destroyed
  const isPossible = totalDif === 1;
  if (!isPossible) {
    resetSelected()
    return null;
  }

  // find element selected on the first try
  const firstElement = foods.value.find((food, i) => {
    return food.x === foodSelected.x && food.y === foodSelected.y;
  })
  // find element pressed now
  const secondElement = foods.value.find((food, i) => {
    return food.x === x && food.y === y;
  })
  // keep the first image;
  const thirdImage = firstElement.image;
  firstElement.image = secondElement.image;
  secondElement.image = thirdImage;
  resetSelected();
  checkFoodItems()
}

// check every triple fruits in a row
function checkFoodItems() {
  canSelect.value = false;
  setTimeout(() => {
    foods.value.forEach((food, foodIndex) => {
      const x = foodIndex % numberSide;
      const y = Math.floor(foodIndex / numberSide);
      const currentImage = food.image;
      // if it is below the threshold X
      if (x <= 5) {
        const rightFood = foods.value[foodIndex + 1];
        const rightImage = rightFood.image;
        const rightRightFood = foods.value[foodIndex + 2]
        const rightRightImage = rightRightFood.image;
        if (currentImage === rightImage && currentImage === rightRightImage) {
          handleThreePoints(food, rightFood, rightRightFood);
        }
      }
      // if it is below the threshold Y
      if (y <= 5) {
        const bottomFood = foods.value[foodIndex + numberSide];
        const bottomImage = bottomFood.image;
        const bottomBottomFood = foods.value[foodIndex + numberSide * 2];
        const bottomBottomImage = bottomBottomFood.image;
        if (currentImage === bottomImage && currentImage === bottomBottomImage) {
          handleThreePoints(food, bottomFood, bottomBottomFood);
        }
      }
    })
    canSelect.value = true;
  }, 500)
}

// if this function is called then it should check again
function handleThreePoints(first, second, third) {
  first.appear = true;
  second.appear = true;
  third.appear = true;
  setTimeout(() => {
    first.image = generateFoodImage();
    second.image = generateFoodImage();
    third.image = generateFoodImage();
    first.appear = false;
    second.appear = false;
    third.appear = false;
    gameInfo.points += 60;
    checkFoodItems();
  }, 2000)
}

/**
 * every time this function is called the
 * selected food should be unselected
 */
function resetSelected() {
  foodSelected.x = null;
  foodSelected.y = null;
}

// register arrow key events
watch(foodSelected, value => {
  if (foodSelected.x !== null && foodSelected.y !== null) {
    window.addEventListener('keydown', keyPress)
  } else {
    window.removeEventListener('keydown', keyPress)
  }
})

function keyPress(ev) {
  let {key} = ev;
  if (key === 'ArrowUp') {
    if (foodSelected.y > 0) {
      pressFood(foodSelected.x, foodSelected.y - 1)
    }
  } else if (key === 'ArrowDown') {
    if (foodSelected.y < 7) {
      pressFood(foodSelected.x, foodSelected.y + 1)
    }
  } else if (key === 'ArrowLeft') {
    if (foodSelected.x > 0) {
      pressFood(foodSelected.x - 1, foodSelected.y)
    }
  } else if (key === 'ArrowRight') {
    if (foodSelected.x < 7) {
      pressFood(foodSelected.x + 1, foodSelected.y)
    }
  }
  resetSelected()
}

// when page loads
onMounted(() => {
  startLoader();
  startGame();
  getUsername()
})
</script>

<template>
  <div id="game">
    <div class="container-bar-top">
      <p>Time {{ timeLeft }}</p>
      <img src="@/assets/svg/timer.svg" alt="" class="bg-timer">
      <img class="bar-top" :src="bar" alt="Bar top showing the user's progress" :style="{
      width: barLength + 'px',
    }">
    </div>
    <!--game data svg-->
    <div id="game-data-svg" data-svg-name="game-info.svg">
      <img class="game-info" src="@/assets/svg/game-info.svg" alt="">
      <h2 id="text-stage">STAGE 1 </h2>
      <h2 id="text-nickname">{{ gameInfo.username }}</h2>
      <h2 id="text-score">{{ gameInfo.points }}</h2>
    </div>
    <!--timer svg-->
    <div id="game-timer-svg" data-svg-name="timer.svg">
    </div>
    <!--game boards-->
    <div id="game-boards-svg" data-svg-name="game-boards.svg">
      <div class="game-board">
        <div
            @click="pressFood(food.x, food.y, food.image)"
            class="container-food"
            v-for="food in foods"
            :style="{
              '--top': food.y * foodSize + 'px',
              '--left': food.x * foodSize + 'px',
            }"
            :class="{
                'appear': food.appear,
                'food-selected':food.x === foodSelected.x && food.y === foodSelected.y,
             }"
        >
          <img :src="food.image" :alt="food.image + '\'s image'">
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.container-bar-top {
  position: fixed;
  top: 10%;
  right: 5%;
  width: 530px;
}

.bg-timer {
  width: 150%;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

.bar-top {
  position: absolute;
  left: 5%;
  top: 90%;
  transform: translate(0, -30%);
  width: v-bind(barFullLength+ 'px');
  height: 24px;
  object-fit: cover;
  object-position: left center;
}

#game-data-svg {
  position: absolute;
  left: 5%;
  top: 20%;
}

#game-data-svg h2 {
  z-index: 3;
}

.game-board {
  width: 660px;
  height: 660px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  background: url("@/assets/svg/game-boards.svg") no-repeat center;
  background-size: cover;
}

.container-food {
  width: v-bind(foodSize+ 'px');
  position: absolute;
  top: var(--top);
  left: var(--left);
  transition: .4s;
}

.container-food img {
  width: 78px;
  height: 78px;
}

.appear {
  scale: 1.2;
}

.food-selected {
  scale: 1.1;
  animation: shake .4s infinite alternate ease-in-out;
}

@keyframes shake {
  from {
    rotate: 20deg;
  }
  to {
    rotate: -20deg;
  }
}

.game-info {
  position: absolute;
  width: 420px;
  transform: translateY(-160px);
}
</style>