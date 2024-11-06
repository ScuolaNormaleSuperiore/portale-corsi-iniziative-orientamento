<template>
    <div>
        <v-list :conf="rolesConf"></v-list>
        <v-list ref="pView" :conf="permissionsConf"></v-list>
    </div>
    <Dialog v-model:visible="display" :modal="true" :style="{width: '40vw'}">
        <template #header>
            <h3>{{ title }}</h3>
        </template>
        <div class="flex mb-3">
            <label>Modello</label>
            <Dropdown class="w-7 ml-2" v-model="modelSelected" :options="modelOptions"
            optionLabel="label" optionValue="id" @change="modelSelect"/>
        </div>
        <div class="grid">
            <div class="col-2" v-for="(permission) in permissions" >
                <Checkbox v-model="permissionsSelected" :value="permission.code" />
                <label>{{permission.label}}</label>
            </div>
        </div>
        <template #footer>
            <Button :label="cupparis.CrudCore.translate('app.ok')" icon="pi pi-check" autofocus v-on:click="addPermessi()" />
        </template>
    </Dialog>
</template>
<script setup>
import {ref,onMounted} from 'vue'
import cupparis from 'cupparis-primevue'

const pView = ref();
const display = ref(false);
const title = ref(cupparis.CrudCore.translate('seleziona modello e permessi') );
const modelOptions = ref([
    {
        id : 'aa',
        label : 'Prova'
    }
]);
const modelSelected = ref(null);
const permissionsSelected = ref([]);
const roleSelected = ref({});

const permissions = ref([
    // {
    //     code : 'list',
    //     label : 'list'
    // },
    // {
    //     code : 'create',
    //     label : 'create'
    // },
    // {
    //     code : 'delete',
    //     label : 'delete'
    // },
    // {
    //     code : 'view',
    //     label : 'view'
    // },
])
const rolesConf = {
    modelName : 'role',
    type : 'v-list',
    actions : ['action-view'],
    actionsConfig : {
        'action-view' : {
            execute() {
                console.debug('roles',this.modelData);
                roleSelected.value = this.modelData;
                //pView.value.setParams({'s_roles|id':this.modelData.id})
                //pView.value.constraintValue = this.modelData.id;
                title.value = this.modelData.name + ': ' + cupparis.CrudCore.translate('seleziona modello e permessi');
                pView.value.load();
            }
        }
    }
}

const permissionsConf =  {
    modelName : 'permission',
    type : 'v-list',
    actions : ['action-delete','action-insert'],
    autoload : false,
    actionsConfig : {
        'action-insert' : {
            execute() {
                display.value = true;
            }
        }
    }
}
const baseRoute = '/api/superadmin';

onMounted(() => {
    console.debug('onmounted');
    cupparis.Server.get(baseRoute+'/models-permessi',{},(json) => {
        console.debug('json',json);
        modelOptions.value = json.models;
        for (let i in json.permessi) {
            permissions.value.push({
                code : json.permessi[i],
                label : json.permessi[i],
            })
        }
    })
})

function addPermessi() {
    display.value = false;
    cupparis.Server.post(baseRoute+'/save-permessi',{
        role_id : roleSelected.value.id,
        modelName : modelSelected.value,
        permessi : permissionsSelected.value,
    },(json) => {

    })
}

function modelSelect(event) {
    console.debug('selezionato modello',modelSelected.value);
}
</script>
<style>
div.p-dropdown-panel {
    z-index:10000 !important;
}
</style>
