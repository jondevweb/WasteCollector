<template>
  <OpenMenu></OpenMenu>
  <div style="display: flex; height: 100%" >
    <div style="width: 330px; background: #003f6e;" aria-expande="false" id="closeMenu">
      <q-list bordered padding class="rounded-borders text-primary">
        <q-item
          clickable
          v-ripple
          :active="link === 'home'"
          @click="link = 'home'"
          active-class="my-menu-link"
          >
          <q-item-section avatar>
            <q-icon name="home" style="margin-left: 13px;"/>
          </q-item-section>
          <q-item-section>
            <q-btn align="left"  href="#/" flat label="Tableau de bord" class="full-width" />
          </q-item-section>
        </q-item>       
        <q-separator />
        <q-expansion-item :content-inset-level="0.5" icon="settings" label="Informations du site" style="margin-left: 14px;">
          <q-item
            clickable
            v-ripple
            :active="link === 'informationsGenerales'"
            @click="link = 'informationsGenerales'"
            active-class="my-menu-link"
            >
            <q-item-section style="margin-left: 13px;">
              <q-btn align="left" href="#/informationsGenerales" flat label="Informations générales" class="full-width"/>
            </q-item-section>
          </q-item>
          <q-item
            clickable
            v-ripple
            :active="link === 'contactsAssocies'"
            @click="link = 'contactsAssocies'"
            active-class="my-menu-link"
            >
            <q-item-section style="margin-left: 13px;">
              <q-btn align="left"  href="#/contactsAssocies" flat label="Contacts associés" class="full-width"/>
            </q-item-section>
          </q-item>
          <q-item
            clickable
            v-ripple
            :active="link === 'conditionsDAccEs'"
            @click="link = 'conditionsDAccEs'"
            active-class="my-menu-link"
            >
            <q-item-section style="margin-left: 13px;">
              <q-btn align="left"  href="#/collectePoint" flat label="Point de Collectes" class="full-width"/>
            </q-item-section>
          </q-item>
        </q-expansion-item>
        <div style="position: relative">
          <i class="fas fa-truck" style="position: absolute; left: 17px; top: 12px; font-size: 1.5rem; color: white;"></i>
        </div>
        <q-expansion-item :content-inset-level="0.5" label="Informations des collectes" default-opened style="margin-left: 70px;" >
          <q-item
            clickable
            v-ripple
            :active="link === 'calendrier'"
            @click="link = 'calendrier'"
            active-class="my-menu-link"
            style="margin-left: -42px;"
            >
            <q-item-section>
              <q-btn align="left"  href="#/calendrier" flat label="Calendrier" class="full-width"/>
            </q-item-section>
          </q-item>
          <q-item
            clickable
            v-ripple
            :active="link === 'donneesBrutes'"
            @click="link = 'donneesBrutes'"
            active-class="my-menu-link"
            style="margin-left: -42px;"
            >
            <q-item-section>
              <q-btn align="left"  href="#/donneesBrutes" flat label="Données brutes" class="full-width"/>
            </q-item-section>
          </q-item>
          <q-expansion-item :content-inset-level="0.5" label="Documents de traçabilité" style="margin-left: -25px;">
            <q-item
              clickable
              v-ripple
              :active="link === 'attestationValorisation'"
              @click="link = 'attestationValorisation'"
              active-class="my-menu-link"
              >
              <q-item-section>
                <q-btn align="left"  href="#/attestationValorisation" label="Attestation de valorisation" flat class="full-width" style="padding: 2px;"/>
              </q-item-section>
            </q-item>
            <q-item
              clickable
              v-ripple
              :active="link === 'registreDeSuiviDeDechets'"
              @click="link = 'registreDeSuiviDeDechets'"
              active-class="my-menu-link"
              >
              <q-item-section>
                <q-btn align="left"  href="#/registreDeSuiviDeDechets" flat  label="Registre de suivi de déchets" class="full-width" style="padding: 2px;"/>
              </q-item-section>
            </q-item>
          </q-expansion-item>
        </q-expansion-item>
      </q-list>
    </div>
    <div style="width: 69%;">
      <component :is="currentView" :title="id" @update:title="id"/>
    </div>
  </div>
</template>
<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import AttestationValorisation from './components/AttestationValorisation.vue';
import Calendrier from './components/Calendrier.vue';
import CollectePoint from './components/CollectePoint.vue';
import ContactsAssocies from './components/ContactsAssocies.vue';
import DonneesBrutes from './components/DonneesBrutes.vue';
import InformationsGenerales from './components/InformationsGenerales.vue';
import OpenMenu from './components/OpenMenu.vue';
import RegistreDeSuiviDeDechets from './components/RegistreDeSuiviDeDechets.vue';
import TableauDeBord from './components/TableauDeBord.vue';

const link = ref('home');
const currentPath = ref(null);
const collecteId = document.getElementById('collecteId');
const id = ref(collecteId.value);

function handleValueChanged(event) {
  id.value = event.detail;
  localStorage.setItem('id', id.value);
}

onMounted(() => {
  document.getElementById('app').addEventListener('value-changed', handleValueChanged);  
});

onBeforeUnmount(() => {
  document.getElementById('app').removeEventListener('value-changed', handleValueChanged);
});

const routes = {
  '/': TableauDeBord,
  '/informationsGenerales': InformationsGenerales,
  '/contactsAssocies': ContactsAssocies,
  '/collectePoint': CollectePoint,
  '/calendrier': Calendrier,
  '/donneesBrutes': DonneesBrutes,
  '/attestationValorisation': AttestationValorisation,
  '/registreDeSuiviDeDechets': RegistreDeSuiviDeDechets
}

if(collecteId.value != 0){
  currentPath.value = window.location.hash;
} else {
  currentPath.value = '#/'
  window.location.hash = '#/'

}

window.addEventListener('hashchange', () => {
  currentPath.value = window.location.hash
})

const currentView = computed(() => {
  return routes[currentPath.value.slice(1) || '/']
})
// const currentView = computed(() => {
//   return routes[currentPath.value.slice(1) || '/'] || NotFound
// })
</script>

<style lang="sass">
.my-menu-link
  color: #badf68
  font-weight: bolder

.q-btn
  text-transform: initial

.btn-outline-secondary
  border: none 

body.desktop .q-focusable:focus>.q-focus-helper, body.desktop .q-hoverable:hover>.q-focus-helper
  background: rgba(0, 0, 0, 0)
  opacity: 0

q-ripple
  background: rgba(0, 0, 0, 0)
  opacity: 0

.q-btn:hover
  color: currentColor

.q-item
  padding: 0px
  margin: 0px

.q-item__section--side
  color: #ffffff
  right: 16px

.q-list
  color: white !important

.q-separator
  width: 80%
  margin: auto
  border: solid white 1px
  height: 0px

q-expansion-item:active, q-expansion-item:focus
  overflow-x: hidden

.q-field--standout.q-field--readonly .q-field__control::before
  border: none 

.q-toggle__inner
  visibility: hidden

.q-field__label
  left: 20px

.q-field__input
  left: 20px

.q-select__dropdown-icon
  left: 25px
</style>