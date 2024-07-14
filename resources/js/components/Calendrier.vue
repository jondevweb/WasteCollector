<template>
  <div>
    <div class="text-h6" style="margin: 5% 0 0 15%;">Préparez une collecte</div>
     <p id="succes"></p>
    <q-card class="my-card" flat bordered style="margin: 5%; width: 50%; display: flex">
      <q-card-section >
        <div>
          <Calendar locale="fr"/>
          <DatePicker v-model="date" mode="date"/>
        </div>
      </q-card-section>
      <q-card-section>
        <div class="q-pa-md" style="max-width: 350px">
          <q-toggle v-model="expanded" label="Sélectionner une date de collecte" class="q-mb-md text-cente" style="width: 190px;"/>
          <pre style="white-space: pre-line" class="text-center">{{ message }}</pre>
          <div class="text-center" >
            <q-btn color="primary" label="Valider" @click="dateSelect"/>
          </div>
        </div>
      </q-card-section>
    </q-card>
    <q-card class="my-card" flat bordered style="margin: 5%; width: 50%; display: flex">
      <q-card-section>  
        <q-expansion-item
          v-model="expanded"
          icon="perm_identity"
          label=""
          caption=""
        >
          <q-card style="display: flex">
              <div id="line1" >
                <div class="q-gutter-md">
                  <q-select
                    filled
                    v-model="data"
                    clearable
                    use-input
                    hide-selected
                    fill-input
                    input-debounce="0"
                    label="Déchets"
                    :options="options"
                    @filter="filterFn"
                    @filter-abort="abortFilterFn"
                    style="width: 250px"
                  >
                  </q-select>
                </div>
              </div>
              <div style="margin-left: 15px">
                <q-input rounded filled v-model="text" label="poids en gramme" style="left: 15px;"/>
              </div>
            </q-card>
          <q-btn color="primary" label="Collecter" @click="createCollect()"/>
        </q-expansion-item>         
      </q-card-section >
    </q-card>
  </div>
</template>
<script setup>
import axios from 'axios';
import { defineProps, ref, watch } from 'vue';

import { DatePicker } from 'v-calendar';
import 'v-calendar/style.css';

const date = ref(new Date());
const options = ref(null)
const message = ref('')  
const data = ref(null);
const error = ref(null);
const expanded = ref(false);
const dechet = ref([null]);
const text = ref(null);
const result = ref(null);
var nameDechet = [];
const props = defineProps({
  title: String
})

watch(() => date.value, (newVal) => {
  date.value = newVal;
  const newDate = date.value.toLocaleString();
  message.value = newDate.substring(0, 10);
  if(result.value != null){
    const succes = document.getElementById('succes');
    succes.innerHTML = result.value;
  }
})



async function dateSelect() {
  expanded.value = !expanded.value;
  try {
    await axios.post('/api/dechet')
    .then(response => {
        console.log('Data posted successfully:', response.data);
        dechet.value = response.data;
        const allDechet = dechet.value
        allDechet.result.forEach(function (dv) {
          nameDechet.push(dv.name_dechet);
        });
        options.value = nameDechet;
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
  } catch (err) {
    error.value = err.message;
    console.error('Error fetching data:', err);
  }
}
  
async function createCollect() {
  if(props.title > 0){
    try {
      const response = await axios.post('/api/createCollecte/', {
        dechet: data.value,
        poids: text.value,
        id: props.title,
        date: message.value
      })
      .then(response => {
        console.log('Data posted successfully:', response.data);
        result.value = response.data;
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
    } catch (err) {
      error.value = err.message;
      console.error('Error fetching data:', err);
    }}
};
</script>   