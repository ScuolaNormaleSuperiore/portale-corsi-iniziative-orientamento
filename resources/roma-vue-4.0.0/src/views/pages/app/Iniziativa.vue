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

const infoTotals = ref([

])
const infoColumns = ref([
    {field: 'regione', header: 'Regione'},
    {field: 'bozza', header: 'Candidature in bozza'},
    {field: 'inviata', header: 'Candidature inviate'},
    {field: 'approvata', header: 'Candidature approvate'},
    {field: 'rifiutata', header: 'Candidature rifiutate'},
    {field: 'totale', header: 'Candidature totali'},
]);

const regionData = ref({

    // Altre regioni...
});

const fasce = ref({

    // Altre regioni...
});

const grades = ref([]);
const labels = ref([]);

const route = useRoute();

const geojson = ref({});
const map = ref({});
const info = ref({});

const totaliAssenze = ref({});

const iniziativa = ref({});
onMounted(() => {


    Server.get('/api/foorm/iniziativa/' + route.params.iniziativaId, {}, function (json) {

        if (json.error) {
            CrudCore.errorDialog(json.msg)
            return;
        }

        iniziativa.value = json.result;

        regionData.value = json.result.dati_statistici.totale_stati_regioni.approvata
            ? json.result.dati_statistici.totale_stati_regioni.approvata : {};
        fasce.value = json.result.dati_statistici.fasce_stati_regioni.approvata;

        console.log("FASCEEEE", fasce.value);
        grades.value = [];
        labels.value = [];
        for (var k in fasce.value) {
            var f = fasce.value[k];
            grades.value.push(parseInt(f.min));
            labels.value.push(f.label);
        }

        grades.value.reverse();
        labels.value.reverse();

        var regioni = Object.keys(json.result.dati_statistici.totale_stati_regioni.approvata);
        for (var i in regioni) {
            var r = regioni[i];
            var row = {
                "regione" : r,
            };
            for (var status in json.result.dati_statistici.totale_stati_regioni) {
                row[status] = json.result.dati_statistici.totale_stati_regioni[status][r];
            }
            infoTotals.value.push(row);
        }

        infoTotals.value.push({
            "regione" : "Totale",
            "bozza" : json.result.dati_statistici.totale_stati.bozza,
            "inviata" : json.result.dati_statistici.totale_stati.inviata,
            "approvata" : json.result.dati_statistici.totale_stati.approvata,
            "rifiutata" : json.result.dati_statistici.totale_stati.rifiutata,
            "totale" : json.result.dati_statistici.totale_stati.totale,
            // "Totale" : json.result.dati_statistici.totale,
        })

        console.log("GRADES", grades.value);
        console.log("LABELS", labels.value);
        //   {
        //     "Toscana": parseInt(100 * Math.random()),
        //     "Puglia": parseInt(100 * Math.random()),
        //       "Lombardia": parseInt(100 * Math.random()),
        //     "Lazio": parseInt(100 * Math.random()),
        //     "Campania": parseInt(100 * Math.random()),
        // }

        console.log("REGIONSSSS", regionData.value);

        map.value = L.map('map').setView([41.9028, 12.4964], 6); // Coordinate centrali dell'Italia

// Livello tiles della mappa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 10,
        }).addTo(map.value);


        // control that shows state info on hover
        info.value = L.control();

        info.value.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.value.update = function (props) {
            const contents = props ? `<b>${props.reg_name}</b><br />${regionData.value[props.reg_name] ? regionData.value[props.reg_name] : 0}` : 'Passa sopra a una regione';
            this._div.innerHTML = `<h4>Candidature approvate</h4>${contents}`;
        };

        info.value.addTo(map.value);

// Dati esemplificativi per le regioni

// Funzione per decidere il colore in base al valore

// Aggiungi GeoJSON alla mappa
        geojson.value = L.geoJson(italyRegionsGeoJson.value, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map.value);
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

            var div = L.DomUtil.create('div', 'info legend');

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.value.length; i++) {
                console.log("OOH", i, grades.value[i], grades.value);
                div.innerHTML +=
                    '<i class="fa fa-square" style="color:' + getColor(grades.value[i], true) + '"></i> ' +
                    labels.value[i] + '<br/>';
            }

            return div;
        };

        legend.addTo(map.value);

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

function getColor(d, log) {


    var nGrades = grades.value.length;

    var colors = [
        '#800026',
        '#BD0026',
        '#E31A1C',
        '#FC4E2A',
        '#FD8D3C',
        '#FFEDA0',
        '#FFFFFF',
    ];

    switch (nGrades) {
        case 0:
        case 1:
            colors = [
                '#FFFFFF',
            ];
            break;
        case 2:
            var colors = [
                '#800026',
                '#FFFFFF',
            ];
            break;
        case 3:
            var colors = [
                '#800026',
                '#FC4E2A',
                '#FFFFFF',
            ];
            break;
        case 4:
            var colors = [
                '#800026',
                '#E31A1C',
                '#FC4E2A',
                '#FFFFFF',
            ];
            break;
        case 5:
            var colors = [
                '#800026',
                '#E31A1C',
                '#FC4E2A',
                '#FD8D3C',
                '#FFFFFF',
            ];
            break;
        case 6:
            var colors = [
                '#800026',
                '#E31A1C',
                '#FC4E2A',
                '#FD8D3C',
                '#FFEDA0',
                '#FFFFFF',
            ];
            break;
        default:
            break;
    }

    var i = 0;
    d = parseInt(d);
    for (var k in grades.value) {
        var v = parseInt(grades.value[k]);
        if (log) {
            console.log("VALUES", d, v);
        }
        // console.log("VALUES:::",v,d);
        if (d >= v) {
            if (log) {
                console.log("COLOR::: ", i, colors[i]);
            }
            return colors[i];
        }
        i++;
    }
    return colors[colors.length - 1];

}

// Stile da applicare a ciascuna regione
function style(feature) {
    var value = (regionData.value && regionData.value[feature.properties.reg_name]) ? regionData.value[feature.properties.reg_name] : 0;
    console.log("REG NAME", feature.properties.reg_name, value);
    return {
        fillColor: getColor(value),
        weight: 2,
        opacity: 1,
        color: 'white',
        dashArray: '3',
        fillOpacity: 0.7
    };
}

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    layer.bringToFront();
    info.value.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.value.resetStyle(e.target);
    info.value.update();
}

function zoomToFeature(e) {
    map.value.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        // click: zoomToFeature
    });
}
</script>

<template>
    <div class="container flex flex-column min-h-screen">
        <section class="py-5">

            <h2>
                Informazioni iniziativa {{iniziativa.titolo}}
            </h2>

            <div class="grid text-center md:text-left">

                <div class="col-12 xl:col-6
        text-center align-content-center"

                >
                    <div id="map"></div>


                </div>
                <div class="col-12 xl:col-6
        text-center align-content-center"

                >
                    <div id="table_info">

                        <DataTable :value="infoTotals"
                                   stripedRows
                                   tableStyle="min-width: 50rem">
                            <Column v-for="(col) of infoColumns" :key="col.field" :field="col.field" :header="col.header" :class="text-right">
                                <template #body="slotProps">
                                    <div v-if="slotProps.data.regione === 'Totale'"
                                        class="font-bold text-right"
                                    >
                                        {{slotProps.data[col.field]}}
                                    </div>
                                    <div v-else
                                         class="text-right"
                                    >
                                        {{slotProps.data[col.field]}}
                                    </div>
                                </template>
                            </Column>

                        </DataTable>

                    </div>


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

.leaflet-container .leaflet-map-pane .leaflet-tile-pane .leaflet-layer {
    opacity: 0 !important;
}

.info {
    padding: 6px 8px;
    font: 14px/16px Arial, Helvetica, sans-serif;
    background: white;
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}

.info h4 {
    margin: 0 0 5px;
    color: #777;
}
</style>

