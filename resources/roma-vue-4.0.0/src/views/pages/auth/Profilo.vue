<template>
    <Card>
        <template #title>
            Profilo
        </template>
        <template #content>
            <div class="grid" v-for="(field,name) in userData">
                <template v-if="name == 'mainrole'">
                    <div class="col-3">{{name}}</div>
                    <div class="col-9">{{field.name}}</div>
                </template>
                <template v-else>
                    <div class="col-3">{{name}}</div>
                    <div class="col-9">{{field}}</div>
                </template>
                
            </div>
        </template>
    </Card>
    
</template>
<script setup>
import cupparis from 'cupparis-primevue'
import {ref,onMounted} from 'vue';
const userData = ref({})

onMounted( () => {
    cupparis.Server.get('/api/me',{},(json) => {
        console.debug('json',json);
        userData.value = json
        //userData.value.mainrole =
    })
})
</script>