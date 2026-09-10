<script setup>
import {onMounted, reactive} from "vue";
import {api} from "@/utils.js";

const statistics = reactive({
  games_count: 0,
  computer_percentage: 0,
  player_percentage: 0,
  incomplete: 0,
  movements_total: 0,
  movements_avg: 0
});

async function loadStatistics() {
  const res = await api.post('/statistics');
  const data = await res.json();
  statistics.games_count = data.games_count;
  statistics.computer_percentage = data.computer_percentage;
  statistics.player_percentage = data.player_percentage;
  statistics.incomplete = data.incomplete;
  statistics.movements_total = data.movements_total;
  statistics.movements_avg = data.movements_avg;
}

onMounted(() => {
  loadStatistics()
})
</script>
<template>
  <div class="container py-3">
    <h1>Statistics</h1>
    <table class="table">
      <thead>
      <tr>
        <th>Name</th>
        <th>Value</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(value,key) in statistics">
        <td>{{ key }}</td>
        <td>{{ value }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<style>
</style>
