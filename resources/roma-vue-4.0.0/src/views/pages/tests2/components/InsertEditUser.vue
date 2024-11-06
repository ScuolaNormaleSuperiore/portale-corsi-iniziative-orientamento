<template>
    <div v-if="loaded">
        <h5>Layout di edit insert</h5>
        <div>
            <c-widget :conf="widgetsConfig['email']"></c-widget>
            <c-widget :conf="widgetsConfig['name']"></c-widget>
        </div>
        <div>
            <c-action ref="actions" :conf="recordActionsConf" layout="buttons" ></c-action>
        </div>
    </div>
</template>

<script>
import cupparisPrimevue from 'cupparis-primevue'

console.log('vRecord',cupparisPrimevue.vRecord);
export default {
    name: "insert-edit-user",
    extends: cupparisPrimevue.vRecord,

}
</script>

<style scoped>

</style>
