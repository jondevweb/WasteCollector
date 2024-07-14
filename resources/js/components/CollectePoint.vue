<template>
  <div>
     <div v-if="now">
      <q-card class="my-card" flat bordered v-for="item in data" style="margin: 5%; width: 50%;">
        <div class="text-h6">Établissement principal</div>
        <q-card-section >
          <q-tab-panel name="entreprise" v-for="pdc in item" :key="pdc.id">
            <q-field label="Raison sociale" stack-label >
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.entreprise.raison_sociale_entreprise}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.entreprise.raison_sociale_entreprise}}</q-tooltip>
            </q-field>
            <q-field label="SIRET" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.entreprise.siret_entreprise}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.entreprise.siret_entreprise}}</q-tooltip>
            </q-field>
            <q-field label="Adresse" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.adresse_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.adresse_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Acsenceur" stack-label >
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.ascenseur_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.ascenseur_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Badge" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.badge_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.badge_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Batiment" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.batiment_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.batiment_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Code" stack-label >
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.code_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.code_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Commentaire" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.commentaire_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.commentaire_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Hauteur" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.hauteur_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.hauteur_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Parking" stack-label >
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.parking_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.parking_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Telephone point de collecte" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.telephone_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.telephone_collecte_point}}</q-tooltip>
            </q-field>
            <q-field label="Creneau horaire" stack-label>
              <div class="self-center full-width no-outline" tabindex="0" style="padding-left: 10px">{{ pdc.creneau_collecte_point}}</div>
              <q-tooltip class="bg-grey-8" anchor="top left" self="bottom left" :offset="[0, 8]">{{ pdc.creneau_collecte_point}}</q-tooltip>
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