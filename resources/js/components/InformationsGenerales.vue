<template>
  <div>
     <div v-if="now">
      <q-card class="my-card" flat bordered v-for="item in data">
        <div class="text-h6">Établissement principal</div>
        <q-card-section >
          <q-tab-panel name="entreprise" v-for="pdc in item" :key="pdc.id">
            <q-field label="Raison sociale" stack-label >
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.entreprise.raison_sociale_entreprise}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.entreprise.raison_sociale_entreprise}}</q-tooltip>
            </q-field>
            <q-field label="SIRET" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.entreprise.siret_entreprise}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.siret_entreprise}}</q-tooltip>
            </q-field>
            <q-field label="Adresse" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.entreprise.adresse_administrative_entreprise}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.entreprise.adresse_administrative_entreprise}}</q-tooltip>
            </q-field>
            <q-field label="Date contrat" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ formatDate(pdc.created_at)}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ formatDate(pdc.created_at)}}</q-tooltip>
              <div>
                <q-icon name="event" color="grey" style="padding-right: 50px; font-size: 25px; top: 25px; position: absolute; right: 0px;" />
              </div>
            </q-field>
            <q-field label="Mail de contact" stack-label>
              <div>
                <q-icon name="mail" color="grey" style="padding-left: 10px; font-size: 25px; top: 3px;" />
              </div>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.user.email_client}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.user.email_client}}</q-tooltip>
            </q-field>
            <q-field label="Téléphone" stack-label>
              <div >
                <q-icon name="phone" color="grey" style="padding-left: 10px; font-size: 25px; top: 3px;" />
              </div>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.user.telephone_client}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.user.telephone_client}}</q-tooltip>
            </q-field> 
          </q-tab-panel>  
        </q-card-section> 
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

watch(() => props.title, (newVal) => {
  props.title = newVal
})
  
const now = computed(() =>  fetchData(props.title));
const data = ref(null);
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
  
async function fetchData(id) {
  if(id > 0){
    await axios.post('/api/collectePoint/{id}', {id:id})
    .then(response => {
        // console.log('Data posted successfully:', response.data);
        data.value = response.data;
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
  }  else {
    return 'pas de bol'
  }
};
</script>   