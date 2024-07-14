<template>
  <div>
     <div v-if="now">{{rows}}
      <q-card class="my-card" flat bordered v-for="item in data" style="margin: 5%; width: 50%;">
        <div class="text-h6">Résumé des collectes</div>
        <div class="q-pa-md">
          <q-table
            :rows="rows"
            :columns="columns"
            row-key="name"
            flat bordered
          />
        </div>
      </q-card>
    </div>
    <div v-else>
      <p>Pas de data!</p>
    </div>  
  </div>
</template>
<script setup>
import axios from 'axios';
import { computed, defineProps, ref, watch } from 'vue';

const props = defineProps({
  title: String
})

var rows;

const columns = [
  {
    name: 'name',
    required: true,
    label: 'Dessert (100g serving)',
    align: 'left'
  },
  { name: 'calories', align: 'center', label: 'Calories', field: 'calories', sortable: true },
  { name: 'fat', label: 'Fat (g)', field: 'fat', sortable: true },
  { name: 'carbs', label: 'Carbs (g)', field: 'carbs' },
  { name: 'protein', label: 'Protein (g)', field: 'protein' },
]

watch(() => rows, (newrows) => {
  rows = newrows
});
  
const now = computed(() =>  fetchData());
var data;
const error = ref(null);

function formatDate(date){
  date = (new Date(date.substr(0, 10).toString().split('-').join(', '))).toLocaleString("en-US");
  if(isNaN(date.slice(1, 2))){
    date = 0 + date
  }
  if(isNaN(date.slice(4, 5))){
    date = date.slice(0, 3).concat(0 + date.slice(3, 10))
  }
  return date.substr(0, 10);
}
  
async function fetchData() {
  await axios.post('/api/indexCollecte')
  .then(response => {
      console.log('Data posted successfully:', response.data);
      data = response.data.result;
      rows = data;
      console.log(rows);
     
     
  })
  .catch(error => {
      if (error.response) {
          console.error('Server responded with an error:', error.response.data);
          console.error('Status code:', error.response.status);
      } else if (error.request) {
          console.error('No response received:', error.request);
          if (error.message.includes('Network Error')) {
              console.error('This might be a CORS issue or network problem.');
          }
      } else {
          console.error('Error setting up request:', error.message);
      }
      console.error('Config:', error.config);
  });
};
</script>   