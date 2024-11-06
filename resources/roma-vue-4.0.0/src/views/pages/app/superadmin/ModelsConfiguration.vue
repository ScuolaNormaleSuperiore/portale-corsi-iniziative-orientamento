<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Lista modelli usati nell'applicazione</h5>
                <PickList v-model="files" listStyle="height:342px" breakpoint="1400px"
                          :showSourceControls="false" :showTargetControls="false">
                    <template #sourceheader> Enabled </template>
                    <template #targetheader> Disabled </template>
                    <template #item="slotProps">
                        <div class="flex flex-wrap p-2 align-items-center gap-3">
                            <span>{{ slotProps.item }}</span>
                            <span class="cursor-pointer" @click="readModel(slotProps.item)"><i class="pi pi-file"></i></span>
<!--                            <img class="w-4rem shadow-2 flex-shrink-0 border-round" :src="'https://primefaces.org/cdn/primevue/images/product/' + slotProps.item.image" :alt="slotProps.item.name" />-->
<!--                            <div class="flex-1 flex flex-column gap-2">-->
<!--                                <span class="font-bold">{{ slotProps.item.name }}</span>-->
<!--                                <div class="flex align-items-center gap-2">-->
<!--                                    <i class="pi pi-tag text-sm"></i>-->
<!--                                    <span>{{ slotProps.item.category }}</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <span class="font-bold text-900">$ {{ slotProps.item.price }}</span>-->
                        </div>
                    </template>
                </PickList>
                <hr />
                <div class="flex gap-2">
                    <InputText v-model="filename"></InputText>
                    <Button label="Save" @click="save"></Button>
                    <SplitButton label="New" :model="newConfs" icon="pi pi-plus" @click="save"></SplitButton>
                </div>
                <hr />
                <div class="grid">
                    <div class="col-12">
                        <h6>Configurazione Modello</h6>
                        <div class="font-italic">Modifica la configurazione e salva</div>
                        <div id='example' class="h-20rem w-full">
                            export default {
                            list : {
                            type : 'v-list',
                            modelName : 'user'
                            }
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref,onMounted,onUnmounted} from "vue";
import Utility from "@/service/Utility.js";
//import crudSakai from 'crud-vue-sakai'
//import CrudComponent from "@/cupparis/CrudComponent.vue";

import cs from "cupparis-primevue";
import JsToCode from "@/service/JsToCode";
const jsc = new JsToCode();
const filename = ref('');
const files = ref([[],[]]);
const newConfs = [
    {
        label: 'New Manage',
        icon: 'pi pi-file',
        command: () => {
            readConfTemplate('Manage')
        }
    },
    {
        label: 'New Import',
        icon: 'pi pi-file',
        command: () => {
            readConfTemplate('Import')
        }
    },
]

var editor = null;
var connection = null;
onUnmounted(() => {
    if (connection) {
        connection.close();
    }

    connection = null;
})

onMounted(() => {
    setTimeout(function() {
        jsc.loadVisLib(function () {
            console.debug('OK',document.getElementById('example'));
            editor = ace.edit("example", {
                theme: "ace/theme/textmate",
                mode: "ace/mode/javascript",
            });
            Utility.connectToServer().then((ws) => {
                connection = ws;
                console.log('connection', connection)

                connection.onopen = function (event) {
                    console.log('event on open', event)
                    console.log('Successfully')
                }
                connection.onmessage = function (event) {
                    console.log('onmessage', event.data);
                    let json = JSON.parse(event.data);
                    switch (json.action) {
                        case 'list-models':
                            files.value[0] = json.result.enabled;
                            files.value[1] = json.result.disabled;
                            break;
                        case 'load-model':
                            editor.setValue(atob(json.result));
                            filename.value = json.modelName;
                            break;
                        case 'load-template-conf':
                            editor.setValue(atob(json.result));
                            filename.value = '';
                            break;
                        case 'save-model':
                            cs.CrudCore.alertSuccess('model saved',3000);
                            break;
                        case 'stdout':
                            cs.CrudCore.alertInfo(json.data);
                            break;
                        case 'stderr':
                            cs.CrudCore.alertError(json.data);
                            break;
                        case 'error':
                            cs.CrudCore.errorDialog(JSON.stringify(json,'','\t'));
                            break;
                    }
                }
                loadModels();
            });

        })
    },200)
})

function loadModels() {
    let json = {
        action : 'list-models',
    }
    connection.send(JSON.stringify(json));
}

function save() {
    if (!filename.value) {
        cs.CrudCore.errorDialog('Inserire la variabile del modello');
        return ;
    }
    let s = editor.getValue();
    let json = {
        action : 'save-model',
        filename : filename.value,
        body : btoa(jsc.getCodeString(s))
    }
    connection.send(JSON.stringify(json));
}

function readModel(item) {
    console.debug('readModel',item);
    let json = {
        action : 'load-model',
        modelName : item,
    }
    connection.send(JSON.stringify(json));
}

function readConfTemplate(tplName) {
    console.debug('tplName',tplName);
    let json = {
        action : 'load-template-conf',
        confName : tplName,
    }
    connection.send(JSON.stringify(json));
}

</script>

<style scoped>

</style>
