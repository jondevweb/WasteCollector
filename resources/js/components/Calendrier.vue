<template>
  <div>
    <div class="text-h6" style="margin: 5% 0 0 15%;">Préparez une collecte
    </div>
    <q-card class="my-card" flat bordered style="margin: 5%; display: flex; flex-wrap: wrap;">
      <q-card-section >
        <div>
          <Calendar locale="fr"/>
          <DatePicker :disabled-dates="disabledDates" v-model="date" mode="date"/>
        </div>
      </q-card-section>
      <div style="width: 65%;">
        <q-card-section>
          <div class="q-pa-md" style="display: flex; flex-wrap: wrap">
            <div style="width: 75%; display:flex; flex-wrap:no-wrap">
              <q-toggle v-model="expanded" label="Sélectionner une date de collecte :" class="q-mb-md text-cente" style="width: 72%;"/>
              <pre style="white-space: pre-line; top: 8px; position: relative;" class="text-center">{{ message }}</pre>
            </div>
            <div push style="z-index: 2">
              <q-btn color="primary" @click="dateSelect" style="padding-left: 40px;">
                <div class="text-center">Valider</div>
              </q-btn>
            </div>
          </div>
        </q-card-section>  
        <q-card-section style="bottom: 60px;">  
          <q-expansion-item
            v-model="expanded"
            expand-icon-toggle
            expand-separator
            label=""
            style="position: relative; bottom: 45px;"
          >
            <q-card style="text-align: center;">
              <q-card-section style="display: flex; flex-wrap: no-wrap; justify-content: center;">
                <div class="q-gutter-y-md column" style="max-width: 300px">
                  <q-select 
                    clearable 
                    filled 
                    v-model="data" 
                    :options="options" 
                    label="Déchets" 
                    use-input
                    hide-selected
                    fill-input 
                    input-debounce="0"
                    @filter="filterFn"
                    @filter-abort="abortFilterFn"
                    :options-dense="denseOpts" style="width: 300px">
                  </q-select>
                </div>
                <div>
                  <q-input rounded filled v-model="text" label="poids en gramme" style="left: 35px; position: relative; text-align: right;"/>
                  <p id="textPoid" style="bottom: 38px; position: relative; width: 19px; left: 146px; color: rgb(243, 243, 255);">gr</p>
                </div>
              </q-card-section>
              <q-btn color="primary" label="Collecter" id="Collecter" @click="createCollect()" style="width: 25%; padding-left: 40px;"/>
            </q-card>
          </q-expansion-item>
        </q-card-section >
      </div> 
    </q-card>
    <div style="width: 100%">
      <p id="resultMessage" style="font-size: 1rem; width: 50%; margin: auto;">{{ result }}</p>
    </div> 
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
const denseOpts= ref(true)
var nameDechet = [];
const props = defineProps({
  title: String
});


watch(() => date.value, (newVal) => {
  if(newVal != null){
  date.value = newVal;
    if(props.title == 0){
      document.getElementById("resultMessage").style.color = "red";
      result.value = "Choissisez un point de collecte";
      expanded.value = false;
    } else if((newVal.getTime() - Date.now())<=1){
      document.getElementById("resultMessage").style.color = "red";
      result.value = "Vous ne pouvez pas choisir de date ultérieur";
      expanded.value = false;
    } else { 
      document.getElementById("resultMessage").style.color = "green";
      result.value = "Date validée";
      const newDate = date.value.toLocaleString();
      message.value = newDate.substring(0, 10);
    }
  }
})

watch(() => text.value, (newVal) => {
  if(newVal.length === 0 ){
    document.getElementById("textPoid").style.color = "rgb(243, 243, 255)";
  } else if(newVal != null || !isNaN(value) && typeof value !== 'boolean'){
    document.getElementById("textPoid").style.color = "#000000";
  } else {
    document.getElementById("textPoid").style.color = "rgb(243, 243, 255)";
  }
})

const disabledDates = ref([
  {
    repeat: {
      weekdays: [7, 1],
    },
  },
]);

function isNumber(value) {
  if (!isNaN(value) && typeof value !== 'boolean') {
    return true;
  } else {
    return false;
  }
}

async function dateSelect() {
  if(result.value == "Date validée"){
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
          document.getElementById("resultMessage").style.color = "blue";
          result.value = "Choisir le déchet et la quantité";
      })
      .catch(error => {
        document.getElementById("resultMessage").style.color = "red";
        result.value = "Une erreur est survenue. Vérifiez vos informations";
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
}
  
async function createCollect() {
  if(props.title > 0 && data.value != null && text.value != null && isNumber(text.value)){
    try{
      const response = await axios.post('/api/createCollecte/', {
        dechet: data.value,
        poids: text.value,
        id: props.title,
        date: message.value
      })
      .then(response => {
        // console.log('Data posted successfully:', response.data);
        document.getElementById("resultMessage").style.color = "green";
        result.value = response.data.result;
        document.getElementById("Collecter").style.display = "none";
      })
      .catch(error => {
        document.getElementById("resultMessage").style.color = "red";
        result.value = "Une erreur est survenue. Vérifiez vos informations";
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
  } else {
    document.getElementById("resultMessage").style.color = "red";
    result.value = "Une erreur est survenue. Vérifiez vos informations";
  }
};
</script>   
