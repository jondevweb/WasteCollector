<template>
  <div>
     <div v-if="now">
      <q-card class="my-card" flat bordered v-if="data" style="margin: 5%; width: 90%;">
        <div class="text-h6">Résumé des collectes</div>
        <div class="q-pa-md" >
          
            <!-- <div v-if="item.adress == row.adress">{{item.adress}}</div> -->
          <q-table
            :rows="rows"
            :columns="columns"
            row-key="date"
            flat bordered
          >
           <!--  <template v-slot:header="props">
              <q-tr :props="props">
                <q-th></q-th>
                <q-th
                  v-for="col in props.cols"
                  :key="col.name"
                  :props="props"
                >
                  {{ col.label }}
                </q-th>
              </q-tr>
            </template>-->
            <template v-slot:body="props" >
              <!--  <q-tr :props="props" :key="`m_${props.row.index}`">
                <q-td
                  v-for="col in props.cols"
                  :key="col.name"
                  :props="props"
                >
                  {{ col.value }}
                </q-td>
              </q-tr>-->
              <q-tr :props="props" :key="`e_${props.row.index}`" class="q-virtual-scroll--with-prev">
                <q-td colspan="100%">
                  <div class="text-left">adresse du point de collecte: {{ props.row.adress }} </div>
                </q-td>
              </q-tr>
            </template>
          </q-table>
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

const rows = [];

const columns = [
  {
    name: 'date',
    required: true,
    label: 'Date de collecte',
    align: 'left',
    field: row => row.date,
    format: val => `${val}`,
    sortable: true
  },
  { name: 'dechet', align: 'center', label: 'Dechets', field: 'dechet', sortable: true },
  { name: 'poid', label: 'Poids (g)', field: 'poid', sortable: true },
];

watch(() => rows, (newrows) => {
  rows = newrows;
});
  
const now = computed(() =>  fetchData());
var data;
const error = ref(null);

function formatDate(date){
  const newDate = date.value.toLocaleString();
  message.value = newDate.substring(0, 10);
  return date.substr(0, 10);
}
  
async function fetchData() {
  await axios.post('/api/indexCollecte')
  .then(response => {
      console.log('Data posted successfully:', response.data);
      data = response.data.result;
      data.forEach(function (dt) {
        console.log(dt['date']);
        rows.push(dt);
      });
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