<script setup>

import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";
import Server from "cupparis-primevue/src/lib/Server";

import {onMounted, ref} from "vue";

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import Route from "cupparis-primevue/src/lib/Route.js";                   // optional
import {useRoute} from 'vue-router';
import CrudCore from "cupparis-primevue/src/lib/CrudCore";

import regioniJson from "../../../data/regioni.json";


const italyRegionsGeoJson = ref(regioniJson)

const studente = ref({})
const titolo = ref({})
const corsi = ref({})
const rate = ref({})
const giustificazioni = ref({})
const giustificazioni_tipi = ref({})
const mavs = ref({})
const loading = ref(true)

const emails = ref({})

const cfu = ref([

  {

    "cfu": "Corsi di CFU 3 (24 ore)",
    "assenze": "3 lezioni",
  },
  {

    "cfu": "Corsi di CFU 6 (48 ore)",
    "assenze": "7 lezioni",
  },
  {

    "cfu": "Corsi di CFU 9 (72 ore)",
    "assenze": "10 lezioni",
  },
  {

    "cfu": "Corsi di CFU 12 (96 ore)",
    "assenze": "14 lezioni",
  },

])
const CFUcolumns = ref([
  {field: 'cfu', header: 'CFU'},
  {field: 'assenze', header: 'Massimo numero di assenze'},
]);

const regionData = ref({

    // Altre regioni...
});

const route = useRoute();

const totaliAssenze = ref({});

onMounted(() => {


  Server.get('/api/foorm/iniziativa/' + route.params.iniziativaId, {}, function (json) {

    if (json.error) {
      CrudCore.errorDialog(json.msg)
      return;
    }


    regionData.value = json.result.dati_statistici.totale_stati_regioni.approvata;
    //   {
    //     "Toscana": parseInt(100 * Math.random()),
    //     "Puglia": parseInt(100 * Math.random()),
    //       "Lombardia": parseInt(100 * Math.random()),
    //     "Lazio": parseInt(100 * Math.random()),
    //     "Campania": parseInt(100 * Math.random()),
    // }

      console.log("REGIONSSSS",regionData.value);

      var map = L.map('map').setView([41.9028, 12.4964], 6); // Coordinate centrali dell'Italia

// Livello tiles della mappa
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 10,
      }).addTo(map);



// Dati esemplificativi per le regioni

// Funzione per decidere il colore in base al valore

// Aggiungi GeoJSON alla mappa
      L.geoJson(italyRegionsGeoJson.value, {
          style: style
      }).addTo(map);
    // studente.value = json.result.studente;
    // titolo.value = json.result.titolo;
    // corsi.value = json.result.corsi;
    // rate.value = json.result.rate;
    // giustificazioni.value = json.result.giustificazioni;
    // giustificazioni_tipi.value = json.result.giustificazioni_tipi;
    // mavs.value = json.result.mavs;
    //
    // emails.value = {
    //   "Email": studente.value.email,
    //   "Email UNIPI": studente.value.email_unipi,
    //   "Email personale": studente.value.email_personale,
    // }
    //
    // totaliAssenze.value = getTotaliGiustificazioni();

      var legend = L.control({position: 'bottomright'});

      legend.onAdd = function (map) {

          var div = L.DomUtil.create('div', 'info legend'),
              grades = [0, 1, 3, 6, 9, 12, 15],
              labels = ["PIPPO","PASTICCIO"];

          // loop through our density intervals and generate a label with a colored square for each interval
          for (var i = 0; i < grades.length; i++) {
              div.innerHTML +=
                  '<i class="fa fa-square" style="color:' + getColor(grades[i] + 1) + '"></i> ' +
                  grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
          }

          return div;
      };

      legend.addTo(map);

      loading.value = false;

  });
})

function getImage(picture) {

  var that = this;
  var urlPrefix = import.meta.env.VITE_APP_TARGET || '';
  var url = urlPrefix + '' + CrudHelpers.addBearerTokenToUrl(picture);

  var style = "background-image: url(\"" + url + "\") !important;";
  //+ "background-color: red;";

  //[style]="'background-image:url('+getImage(element.id)+')'"
  return "<div class='w-24rem h-24rem m-auto bg-contain bg-no-repeat' " +
      // ":style=\"{ 'background-image': url('" + url + "') }\" " +
      //":style=\"{ 'background-image': url('" + url + "') }\" " +
      "style='" + style + "' >&nbsp;" +
      // "<img class='w-full' src='/api" + CrudHelpers.addBearerTokenToUrl(url) + "'/>" +
      "</div>";

}

function getColor(d) {
    return d > 10 ? '#800026' :
        d > 8 ? '#BD0026' :
            d > 4 ? '#E31A1C' :
                d > 2 ? '#FC4E2A' :
                    d > 0 ? '#FD8D3C' :
                        '#FFEDA0';
}

// Stile da applicare a ciascuna regione
function style(feature) {
    console.log("REG NAME",feature.properties.reg_name,regionData.value[feature.properties.reg_name]);
    return {
        fillColor: getColor(regionData.value[feature.properties.reg_name]),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}


function getDays(giustificazione, tipo) {
  if (giustificazione.tipo === tipo) {
    return giustificazione.days;
  }
  return 0;
}


</script>

<template>
  <div class="container flex flex-column min-h-screen">
    <section class="py-5">
      <div class="grid text-center md:text-left">

        <div class="col-12 xl:col-8 xl:col-offset-2
        text-center align-content-center"

        >
            <div id="map"></div>


        </div>

<!--        <div class="col-12 lg:col-6">-->

<!--          <div class="bg-gray-200 p-4 border-round-lg flex flex-wrap w-full justify-content-center align-content-center">-->

<!--            <div class="mx-3 my-4">-->


<!--              <h2 class="text-3xl sm:text-4xl font-medium mb-0">-->
<!--                {{ titolo }}-->
<!--              </h2>-->

<!--              <p class="text-4xl sm:text-6xl text-center font-light mb-4 ">-->
<!--                {{ studente.categoria_accademica_attuale }}-->
<!--              </p>-->


<!--              <div><i class="fa fa-university"></i> Anno Immatricolazione:-->
<!--                {{ studente.anno_immatricolazione }}-->
<!--              </div>-->



<!--            </div>-->
<!--          </div>-->

<!--        </div>-->


      </div>


    </section>


  </div>
</template>

<style>

    .leaflet-container {
        height: 800px;
        width: 100%;
    }

    .leaflet-container  .leaflet-map-pane  .leaflet-tile-pane  .leaflet-layer {
        opacity: 0 !important;
    }

</style>

