<template>
  <div style="width: 100%">
    <p id="resultMessage" style="font-size: 1rem; width: 50%; margin: auto;">{{ result }}</p>
  </div> 
  <div>
    <div v-if="now">
      <q-card class="my-card" flat bordered style="margin: 5%; width: 90%;" v-for="item in data">
        <div class="text-h6">Résumé des collectes</div>
        <div class="q-pa-md" >
          <q-table
            :title=item.adresse_collecte_point
            :rows="rows"
            :columns="columns"
            row-key="date"
            flat bordered
            rows-per-page-label="Lignes par page:"
            :pagination-label="customLabels.pagination"
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

const result = ref("Choissisez un point de collecte");
const data = ref(null);
const customLabels = {
  pagination: (start, end, total) => `${start}-${end} sur ${total}`
}

const props = defineProps({
  title: String
});

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

const rows = ref([]);

watch(() => props.title, (newVal) => {
  props.title = newVal
  if(props.title == 0){
    document.getElementById("resultMessage").style.color = "red";
    result.value = "Choissisez un point de collecte";
  } else {
    fetchData(props.title)
  }
})

watch(() => rows.value, (newVal) => {
  newVal.forEach(function (collecte) {
    collecte["date"] = formatDate(collecte["date"]);
  });
  rows.value = newVal
})

const now = computed(() => {
  console.log(props.title);
  if(props.title != 0){
    result.value = "";
    if(rows.value.length == 0){
      fetchData(props.title)
    }
    selectPdcById(props.title);
    return true
  } else {
    result.value = "Choissisez un point de collecte";
    return false
  }
});

function formatDate(date){
  const newDate = new Date(date);
  const frenchDate = newDate.toLocaleString();
  return frenchDate.substring(0, 10);
}

async function fetchData(id) {
  if(id > 0){
    await axios.post('/api/indexCollecte', {id:id})
    .then(response => {
        // console.log('Data posted successfully:', response.data);
        const data = response.data.result;
        rows.value = [];
        data.forEach(function (collecte) {
          rows.value.push(collecte);
        });
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
  }   
};


async function selectPdcById(id) {
  if(id > 0){
    await axios.post('/api/collectePoint/$id', {id:id})
    .then(response => {
        // console.log('Data posted successfully:', response.data.result);
        data.value = response.data.result;
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
  }   
};
</script>