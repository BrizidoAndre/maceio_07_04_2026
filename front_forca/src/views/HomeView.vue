<script setup>
import zero from "@/images/user_0.png";
import first from "@/images/user_1.png";
import second from "@/images/user_2.png";
import third from "@/images/user_3.png";
import forth from "@/images/user_4.png";
import fifth from "@/images/user_5.png";
import sixth from "@/images/user_6.png";
import {computed, reactive, ref, watchEffect} from "vue";
import StartForm from "@/StartForm.vue";
import {api} from "@/utils.js";
import WonModal from "@/components/WonModal.vue";

// what each image shows based on the number of user misses
const guy = {
  0: zero,
  1: first,
  2: second,
  3: third,
  4: forth,
  5: fifth,
  6: sixth,
}

// the game have started?
const started = ref(true);
const isOver = ref(false);
const hasWon = ref(false);
// is the page loading waiting for the request;
const loading = ref(false);
// the game info object
const gameInfo = reactive({
  id: 26,
  player_one: 'André',
  player_two: 'Computador',
  player_one_tries: 0,
  player_two_tries: 0,
  mode: 'Computador',
  word: 'learn',
})
const isPlayerOne = ref(true);
const triedLetters = ref([]);
// show the right amount of letter if it has been selectec
const showedLetters = computed(() => {
  const lettersWord = gameInfo.word.split('');
  const lettersShow = [];
  lettersWord.forEach((wordLetter) => {
    if (triedLetters.value.some(tried => tried === wordLetter)) {
      lettersShow.push(wordLetter);
    } else {
      lettersShow.push('_');
    }
  })
  return lettersShow.join('');
});

// when a game starts
async function handleSubmit(game) {
  started.value = false;
  const res = await api.post('/start', game);
  const data = await res.json();
  const info = data.data;
  gameInfo.id = info.id;
  gameInfo.player_one = info.player_one;
  gameInfo.player_two = info.player_two;
  gameInfo.mode = info.mode;
  gameInfo.word = info.word;
  isPlayerOne.value = true;
}

// what happens when a player tries a letter
async function handleLetterTry(letter) {
  // if the computer is loading then no move is registered
  if (loading.value) {
    return null;
  }
  const lowercase = letter.toLowerCase();
  const res = await api.post(`/${gameInfo.id}/move`, {
    player_responsible: isPlayerOne ? gameInfo.player_one : gameInfo.player_two,
    letter: lowercase,
  })
  if (!res.ok) {
    // does nothing since the letter has already been selected
    alert('Esta letra já foi selecionada 😡');
    return false;
  }
  const data = await res.json();
  const info = data.data;
  // if is not success add to the number of tries
  if (!info.success) {
    isPlayerOne.value ? gameInfo.player_one_tries++ : gameInfo.player_two_tries++;
  }
  // add to tried letters
  triedLetters.value.push(lowercase);
  // change players
  isPlayerOne.value = !isPlayerOne.value;
}

// what happens when is the computer playing
async function handleComputerGame() {
  loading.value = true;
  const res = await api.post(`/${gameInfo.id}/computer`);
  const data = await res.json();
  const info = data.data;
  if (!info.success) {
    gameInfo.player_two_tries++;
  }
  // adding default behavior when the computer is over moving
  triedLetters.value.push(info.letter);
  loading.value = false;
  isPlayerOne.value = true;
}

/**
 * making the request and finishig the match
 */
async function gameWon(won) {
  const res = await api.post(`/${gameInfo.id}/end`);
  const data = await res.json();
  isPlayerOne.value = !isPlayerOne.value;
  isOver.value = true;
  hasWon.value = won;
}

/**
 * reset everything in this application
 */
function restartGame() {
  gameInfo.id = null;
  gameInfo.player_one = '';
  gameInfo.player_two = '';
  gameInfo.player_one_tries = 0;
  gameInfo.player_two_tries = 0;
  gameInfo.mode = 'One by One';
  gameInfo.word = '';
  started.value = true;
  isOver.value = false;
  hasWon.value = false;
  triedLetters.value = [];
  isPlayerOne.value = true;
}

watchEffect(() => {
  // if the user has won
  if (showedLetters.value === gameInfo.word) {
    gameWon(true);
    return null;
  }
  // if both users loose
  if (gameInfo.player_two_tries >= 6 && gameInfo.player_one_tries >= 6) {
    gameWon(false);
    return null;
  }
  // if is not computers turn (or even if it should be able to play)
  if (started.value || gameInfo.mode !== 'Computador' || isPlayerOne.value) {
    return null;
  }
  if (gameInfo.player_two_tries >= 6 || gameInfo.player_one_tries >= 6) {
    isPlayerOne.value = !isPlayerOne.value;
    return null;
  }
  console.log(gameInfo.player_two_tries, gameInfo.player_one_tries);
  handleComputerGame();
})
</script>
<template>
  <main>
    <!--    if the loading is true, then shows to the page-->
    <div v-if="loading" class="loading">
      <img src="@/images/loading.gif" alt="Loading the request" class="">
    </div>
    <won-modal v-if="isOver" :hasWon="hasWon" @restart="restartGame"
               :winner="isPlayerOne ? gameInfo.player_one : gameInfo.player_two"/>
    <div id="logo">
      <img src="@/images/hangmanlogo.jpg" alt=""/>
    </div>
    <div id="loading" class="d-none"><img src="@/images/loading.gif" alt="loading"></div>
    <start-form v-if="started" @handle-submit="handleSubmit"/>
    <div id="container">
      <section id="player1" class="gameuser">
        <img :src="guy[gameInfo.player_one_tries]">
        <span id="username1" class="username">{{ gameInfo.player_one }}</span>
      </section>
      <section id="word"><span id="selectedWord">{{ showedLetters }}</span></section>
      <section id="player2" class="gameuser">
        <img :src="guy[gameInfo.player_two_tries]">
        <span id="username2" class="username">{{ gameInfo.player_two }}</span>
      </section>
    </div>
    <section id="keyboard">
      <p id="actualUser">Actual User:
        <span id="nameActualUser">{{ isPlayerOne ? gameInfo.player_one : gameInfo.player_two }}</span>
      </p>
      <button @click="handleLetterTry('A')" class="gamebutton">A</button>
      <button @click="handleLetterTry('B')" class="gamebutton">B</button>
      <button @click="handleLetterTry('C')" class="gamebutton">C</button>
      <button @click="handleLetterTry('D')" class="gamebutton">D</button>
      <button @click="handleLetterTry('E')" class="gamebutton">E</button>
      <button @click="handleLetterTry('F')" class="gamebutton">F</button>
      <button @click="handleLetterTry('G')" class="gamebutton">G</button>
      <button @click="handleLetterTry('H')" class="gamebutton">H</button>
      <button @click="handleLetterTry('I')" class="gamebutton">I</button>
      <button @click="handleLetterTry('J')" class="gamebutton">J</button>
      <button @click="handleLetterTry('K')" class="gamebutton">K</button>
      <button @click="handleLetterTry('L')" class="gamebutton">L</button>
      <button @click="handleLetterTry('M')" class="gamebutton">M</button>
      <button @click="handleLetterTry('N')" class="gamebutton">N</button>
      <button @click="handleLetterTry('O')" class="gamebutton">O</button>
      <button @click="handleLetterTry('P')" class="gamebutton">P</button>
      <button @click="handleLetterTry('Q')" class="gamebutton">Q</button>
      <button @click="handleLetterTry('R')" class="gamebutton">R</button>
      <button @click="handleLetterTry('S')" class="gamebutton">S</button>
      <button @click="handleLetterTry('T')" class="gamebutton">T</button>
      <button @click="handleLetterTry('U')" class="gamebutton">U</button>
      <button @click="handleLetterTry('V')" class="gamebutton">V</button>
      <button @click="handleLetterTry('W')" class="gamebutton">W</button>
      <button @click="handleLetterTry('X')" class="gamebutton">X</button>
      <button @click="handleLetterTry('Y')" class="gamebutton">Y</button>
      <button @click="handleLetterTry('Z')" class="gamebutton">Z</button>
      <div class="mt-3">
        <p>Tried letters</p>
        <p>{{ triedLetters.join('-') }}</p>
      </div>
    </section>
  </main>
</template>