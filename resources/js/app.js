
import '@fortawesome/fontawesome-free/css/all.css'; // Import FontAwesome
import '@quasar/extras/material-icons/material-icons.css';
import { Quasar } from 'quasar';
import quasarIconSet from 'quasar/icon-set/material-icons'; // if you want to use a different icon set
import quasarLang from 'quasar/lang/en-US'; // if you want to change the language
import 'quasar/src/css/index.sass';
import { createApp } from 'vue';
import App from './App.vue';
import fontawesome from './plugins/fontawesome';

const app = createApp(App);
fontawesome(app);
app.use(Quasar, {
  plugins: {}, // import Quasar plugins and add here
  lang: quasarLang,
  iconSet: quasarIconSet, // import Quasar plugins and add here
}).mount('#app');