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
import moment from "moment";
import Download from "./Download.vue";


const candidato = ref({})
const candidatoMetadata = ref({})
const loading = ref(true)
const route = useRoute();

const votiTotals = ref([])

const votiColumns = ref([
    {field: 'materia_id', header: 'Materia'},
    {field: 'voto_anno_2', header: 'Voto due anni precedenti'},
    {field: 'voto_anno_1', header: 'Voto ultimo anno'},
    {field: 'voto_primo_quadrimestre', header: 'Voto primo quadrimestre'},
]);


onMounted(() => {


    Server.get('/api/foorm/candidato/' + route.params.candidatoId, {}, function (json) {

        if (json.error) {
            CrudCore.errorDialog(json.msg)
            return;
        }

        candidato.value = json.result;
        candidatoMetadata.value = json.metadata;

        votiTotals.value = [];
        for (var i in candidato.value.voti) {
            var v = candidato.value.voti[i];
            var row = {
                'materia_id': getStandardField('voti.materia_id', 'select', null, true, v.materia_id),
                'voto_anno_2': v.voto_anno_2,
                'voto_anno_1': v.voto_anno_1,
                'voto_primo_quadrimestre': v.voto_primo_quadrimestre,
            };
            votiTotals.value.push(row);
        }

        loading.value = false;

    });
})


function getStandardField(field, fieldType, fieldTypeParam, onlyRes, candValue) {

    var candFieldArray = field.split('.');
    var translation = "";
    if (!candValue) {
        if (candFieldArray.length === 1) {
            translation = CrudCore.translate('candidato.fields.' + field + '.label');
            candValue = candidato.value[field];
        } else if (candFieldArray.length === 2) {
            translation = CrudCore.translate('candidato.relations.' + candFieldArray[0] + '.label');
            candValue = candidato.value[candFieldArray[0]][candFieldArray[1]];
        }
    }
    var value = "";
    switch (fieldType) {
        case 'date':
            value = getFormattedDateValue(candValue);
            break;
        case 'checkbox':
            //Se non relation...
            if (!Array.isArray(candValue)) {
                value = "";
            }
            for (var c of candValue) {
                value += candidatoMetadata.value.fields[field].options[c] + '<br/>';
            }
            break;
        case 'checkbox-relation':
            //Se non relation...
            if (!Array.isArray(candValue)) {
                value = "";
            }
            for (var c of candValue) {
                value += candidatoMetadata.value.relations[field].options[c] + '<br/>';
            }
            break;
        case 'select':
            console.log("AAAAA ", candFieldArray[0], candFieldArray[1], candValue);
            //Se non relation...
            if (!candValue || candValue === -1) {
                break;
            }
            if (candFieldArray.length === 2) {
                value = candidatoMetadata.value.relations[candFieldArray[0]].fields[candFieldArray[1]].options[candValue];
            } else {
                value = candidatoMetadata.value.fields[field].options[candValue];
            }
            break;
        case 'select-altro':
            //Se non relation...
            if (!candValue || candValue === -1) {
                break;
            }
            if (candFieldArray.length === 2) {
                value = candidatoMetadata.value.relations[candFieldArray[0]].fields[candFieldArray[1]].options[candValue];
            } else {
                value = candidatoMetadata.value.fields[field].options[candValue];
            }
            if (candidato.value[fieldTypeParam]) {
                value += ' - ' + candidato.value[fieldTypeParam];
            }
            break;
        default:
            value = candValue ? candValue : "";
    }
    if (onlyRes) {
        return value;
    }
    var html = "<div class=\"col-3 font-bold text-right\">\n" +
        translation.charAt(0).toUpperCase() + translation.slice(1) +
        "                                </div>\n" +
        "                                <div class=\"col-9 border-left-1\">\n" +
        value +
        "                                </div>";

    return html;
}

function getStandardSection(section) {

    var fields = [];
    var specialFields = [];
    switch (section) {
        case 'anagrafica':
            fields = [
                'nome', 'cognome', 'luogo_nascita', 'data_nascita', 'sesso',
                'emails', 'indirizzo', 'comune', 'cap', 'provincia.sigla',
                'gen1_titolo_studio_id', 'gen2_titolo_studio_id',
                'gen1_professione_id', 'gen2_professione_id'
            ];
            specialFields = {
                'data_nascita': 'date',
                'gen1_titolo_studio_id': 'select',
                'gen2_titolo_studio_id': 'select',
                'gen1_professione_id': 'select-altro:gen1_professione_altro',
                'gen2_professione_id': 'select-altro:gen2_professione_altro',
            }
            break;
        case 'profilo':
            fields = [
                'profilo',
                'inglese_livello_linguistico_id',
                'francese_livello_linguistico_id',
                'tedesco_livello_linguistico_id',
                'spagnolo_livello_linguistico_id',
                'cinese_livello_linguistico_id',
                'altre_competenze_linguistiche',
                'esperienze_estere',
            ];
            specialFields = {
                'inglese_livello_linguistico_id': 'select',
                'francese_livello_linguistico_id': 'select',
                'tedesco_livello_linguistico_id': 'select',
                'spagnolo_livello_linguistico_id': 'select',
                'cinese_livello_linguistico_id': 'select',
            }
            break;
        case 'concorsi':
            fields = [
                'olimpiadi_matematica',
                'olimpiadi_fisica',
                'olimpiadi_matematica_squadre',
                'olimpiadi_matematica_squadre_femminili',
                'olimpiadi_fisica_squadre_miste',
                'olimpiadi_scienze_naturali',
                'giochi_chimica',
                'olimpiadi_informatica',
                'stages',
                'gare_internazionali',
                'gare_umanistiche',
                'partecipazione_concorsi',
            ];
            specialFields = {
                'olimpiadi_matematica': 'select',
                'olimpiadi_fisica': 'select',
                'olimpiadi_matematica_squadre': 'select',
                'olimpiadi_matematica_squadre_femminili': 'select',
                'olimpiadi_fisica_squadre_miste': 'select',
                'olimpiadi_scienze_naturali': 'select',
                'giochi_chimica': 'select',
                'olimpiadi_informatica': 'select',
                'stages': 'checkbox',
                'gare_internazionali': 'checkbox',
                'gare_umanistiche': 'checkbox',
            }
            break;
        case 'preferenze':
            fields = [
                'materie_preferite',
                'settore_professionale',
                'motivazioni',
                'corsi',
                'modalita_conoscenza_sns_id',
            ];
            specialFields = {
                'corsi' : 'checkbox-relation',
                'modalita_conoscenza_sns_id' : 'select',
            }
            break;
        default:
            break;
    }

    var html = "";
    for (var field of fields) {
        var fieldTypeParam = null;
        var fieldType = specialFields[field] || 'standard';
        var fieldArray = fieldType.split(':');
        if (fieldArray.length === 2) {
            fieldType = fieldArray[0];
            fieldTypeParam = fieldArray[1];
        }
        html += getStandardField(field, fieldType, fieldTypeParam);
    }

    return html;
}

function getFormattedDateValue(date) {
    let that = this;
    //return that.translate(that.invalidDateString)
    var md = moment(date);
    //console.log('displayFormat',that.displayFormat);
    if (md.isValid()) {
        return md.format('DD/MM/YYYY')
    } else {
        return that.translate("N.D."); // + '*' ;
    }
}

</script>

<template>
    <div class="container flex flex-column min-h-screen bg-white" v-if="!loading">
        <section class="py-5 px-4">

            <h2 class="text-center text-primary">
                Candidatura di {{ candidato.nome }} {{ candidato.cognome }}
            </h2>

            <h4 class="text-center">
                per l'iniziativa {{ candidato.iniziativa.titolo }}
            </h4>

            <p class="text-left text-xl">
                Status attuale: {{ candidato.status }}
                <span v-if="candidato.data_candidatura" class="pl-3">
                    Data invio candidatura: {{ getFormattedDateValue(candidato.data_candidatura) }}
                </span>
            </p>

            <div v-if="candidato.attachments.length > 0" class="text-xl">
                Scarica gli allegati della domanda: <Download :url="'/api/foormaction/media-download/candidato/list/'+candidato.id" :method="'post'"/>
            </div>
            <hr/>

            <div class="grid text-center mt-5 md:text-left">

                <div class="col-12 xl:col-6">

                    <Card class="border-1 border-gray-500">
                        <template #title>
                            <span class="text-primary">
                                Dati personali e familiari
                            </span>
                        </template>
                        <template #content>
                            <div class="grid text-center mt-5 md:text-left text-xl"
                                 v-html="getStandardSection('anagrafica')"
                            >
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-12 xl:col-6">

                    <Card class="border-1 border-gray-500">
                        <template #title>
                            <span class="text-primary">
                                Preferenze e corsi
                            </span>
                        </template>
                        <template #content>
                            <div class="grid text-center mt-5 md:text-left text-xl"
                                 v-html="getStandardSection('preferenze')"
                            >
                            </div>
                        </template>
                    </Card>

                </div>
                <div class="col-12 xl:col-6">

                    <Card class="border-1 border-gray-500">
                        <template #title>
                            <span class="text-primary">
                                Profilo, competenze ed esperienze
                            </span>
                        </template>
                        <template #content>
                            <div class="grid text-center mt-5 md:text-left text-xl"
                                 v-html="getStandardSection('profilo')"
                            >
                            </div>
                        </template>
                    </Card>
                </div>
                <div class="col-12 xl:col-6">

                    <Card class="border-1 border-gray-500">
                        <template #title>
                            <span class="text-primary">
                                Partecipazioni a concorsi
                            </span>
                        </template>
                        <template #content>
                            <div class="grid text-center mt-5 md:text-left text-xl"
                                 v-html="getStandardSection('concorsi')"
                            >
                            </div>
                        </template>
                    </Card>
                </div>

                <div class="col-12 xl:col-12">

                    <Card class="border-1 border-gray-500">
                        <template #title>
                            <span class="text-primary">
                                Info scolastiche
                            </span>
                        </template>
                        <template #content>
                            <div class="grid text-center mt-5 md:text-left text-xl">
                                <div class="col-3 font-bold text-right">
                                    Scuola
                                </div>
                                <div class="col-9 border-left-1">
                                    <div v-if="candidato.scuola_id">
                                        {{ candidato.scuola.denominazione }} ({{ candidato.scuola.codice }})
                                        <br/>
                                        {{ candidato.scuola.tipologia_grado_istruzione }}
                                        <br/>
                                        {{ candidato.scuola.comune }} - Provincia di:
                                        {{ getStandardField('provincia_id', 'select', null, true) }}
                                    </div>
                                    <div v-else>
                                        {{ candidato.scuola_estera }}
                                    </div>
                                </div>
                                <div class="col-3 font-bold text-right">
                                    Classe
                                </div>
                                <div class="col-9 border-left-1">
                                    {{ candidato.classe }}
                                </div>
                                <div class="col-3 font-bold text-right">
                                    Sezione
                                </div>
                                <div class="col-9 border-left-1">
                                    {{ candidato.sezione }}
                                </div>
                                <div class="col-3 font-bold text-right">
                                    Media
                                </div>
                                <div class="col-9 border-left-1">
                                    {{ candidato.media }}
                                </div>
                                <div class="col-3 font-bold text-right">
                                    Voti
                                </div>
                                <div class="col-9 border-left-1">
                                    <div id="table_info">

                                        <DataTable :value="votiTotals"
                                                   stripedRows
                                                   tableStyle="min-width: 50rem">
                                            <Column v-for="(col) of votiColumns" :key="col.field" :field="col.field"
                                                    :header="col.header" :class="text-right">
                                                <template #body="slotProps">
                                                    <div class="text-right"
                                                    >
                                                        {{ slotProps.data[col.field] }}
                                                    </div>
                                                </template>
                                            </Column>

                                        </DataTable>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </Card>
                </div>

            </div>

            <!--            <div class="grid text-center md:text-left">-->

            <!--                <div class="col-12 xl:col-6-->
            <!--        text-center align-content-center"-->

            <!--                >-->
            <!--                    <div id="map"></div>-->


            <!--                </div>-->
            <!--                <div class="col-12 xl:col-6-->
            <!--        text-center align-content-center"-->

            <!--                >-->
            <!--                    <div id="table_info">-->

            <!--                        <DataTable :value="infoTotals"-->
            <!--                                   stripedRows-->
            <!--                                   tableStyle="min-width: 50rem">-->
            <!--                            <Column v-for="(col) of infoColumns" :key="col.field" :field="col.field" :header="col.header" :class="text-right">-->
            <!--                                <template #body="slotProps">-->
            <!--                                    <div v-if="slotProps.data.regione === 'Totale'"-->
            <!--                                        class="font-bold text-right"-->
            <!--                                    >-->
            <!--                                        {{slotProps.data[col.field]}}-->
            <!--                                    </div>-->
            <!--                                    <div v-else-->
            <!--                                         class="text-right"-->
            <!--                                    >-->
            <!--                                        {{slotProps.data[col.field]}}-->
            <!--                                    </div>-->
            <!--                                </template>-->
            <!--                            </Column>-->

            <!--                        </DataTable>-->

            <!--                    </div>-->


            <!--                </div>-->


            <!--            </div>-->


        </section>


    </div>
</template>

<style>

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


