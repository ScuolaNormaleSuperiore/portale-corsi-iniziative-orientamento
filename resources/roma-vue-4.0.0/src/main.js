import { createApp } from 'vue';
import App from './App.vue';
import "@fortawesome/fontawesome-free/css/all.css"
import CrudInit from './crud/CrudInit.js';
import cupparisPrimevue from "cupparis-primevue";
import InsertEditUser from "@/views/pages/tests2/components/InsertEditUser.vue";
import ListUser from "@/views/pages/tests2/components/ListUser.vue";
import ActionSelect from "@/views/pages/tests2/components/ActionSelect.vue";

const app = createApp(App);

function mountApp() {
    app.component('insert-edit-user',InsertEditUser)
    app.component('ListUser',ListUser)
    app.component('ActionSelect',ActionSelect)
    console.log('monto app');
    app.mount('#app');
}

CrudInit.sakaiInit(app);
CrudInit.install(app).then(function () {
    cupparisPrimevue.install(app);
    CrudInit.loadMenu().then(function() {
        mountApp();
    }).catch(error => {
        console.warn('Caricamento menu applicazione fallito')
        console.error(error);
    })
})


//app.mount('#app');
