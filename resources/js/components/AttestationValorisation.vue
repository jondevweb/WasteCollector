<template>
    <div>{{now.value}}
      <div v-if="data">
        <q-card class="my-card" flat bordered v-for="item in data">
          <div class="text-h6">Établissement principal</div>
          <q-card-section >
            <q-tab-panel name="entreprise" v-for="entreprise in item" 
                :key="entreprise.id"> 
              <q-field label="Raison sociale" stack-label>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ entreprise.raison_sociale}}</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ entreprise.raison_sociale}}</q-tooltip>
              </q-field>
              <q-field label="SIRET" stack-label>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ entreprise.siret}}</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ entreprise.siret}}</q-tooltip></q-field>
              <q-field label="Adresse" stack-label>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ entreprise.adresse_administrative}}</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ entreprise.adresse_administrative}}</q-tooltip>
              </q-field>
              <q-field label="Date contrat" stack-label>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ formatDate(entreprise.created_at)}}</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ formatDate(entreprise.created_at)}}</q-tooltip>
                <div>
                  <q-icon name="event" color="grey" style="padding-right: 50px; font-size: 25px; top: 25px; position: absolute; right: 0px;" />
                </div>
              </q-field>
              <q-field label="Mail de contact" stack-label>
                <div>
                  <q-icon name="mail" color="grey" style="padding-left: 10px; font-size: 25px; top: 3px;" />
                </div>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px"> @@@@@</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">@@@@</q-tooltip>
              </q-field>
              <q-field label="Téléphone" stack-label>
                <div >
                  <q-icon name="phone" color="grey" style="padding-left: 10px; font-size: 25px; top: 3px;" />
                </div>
                <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">000000</div>
                <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">0000000</q-tooltip>
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
import { computed, ref } from 'vue';
  
  const title = defineModel('title')
    
  const now = computed(() =>  fetchData(title));
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
    if(id.value){
      try {
        const response = await axios.post('/api/attestation/{id}', {id:id.value});
        const result = await response.data;
        data.value = result;
      } catch (err) {
        error.value = err.message;
        console.error('Error fetching data:', err);
      }
    }  else {
      return 'pas de bol'
    }
  };
  </script>   