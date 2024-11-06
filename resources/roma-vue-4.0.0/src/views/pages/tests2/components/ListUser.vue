<template>
    <div>
        <h4>Lista utenti</h4>
    </div>
    <div v-if="Object.keys(collectionActions).length > 0">
        <div class="mt-5 lg:mt-0">
            <c-action layout="buttons" :conf="collectionActions"></c-action>
        </div>
    </div>
    <div class="mt-2" v-if="loaded">
        <div class="flex flex-row flex-wrap w-full gap-1">
            <div class="card w-18rem h-10rem" v-for="(row,index) in value" :key="index">
                <h6>{{row.name}}</h6>
                <div>{{row.email}}</div>
                <div>
                    <c-action :conf="recordActionsConf[index]" layout="buttons"></c-action>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import cupparisPrimevue from "cupparis-primevue"
const vList = cupparisPrimevue.vList;
export default {
    name: "ListUser",
    extends:vList
}
</script>

<style scoped>

</style>
