<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <h5>Esempio di Manage con constraint che filtra la lista utenti per created_by</h5>
                <SelectButton v-model="selectedManage" :options="manages" optionLabel="name" />
                <hr>
                <div v-if="selectedManage.code == 'simple'">
                    <h6>Manage con configurazione di default</h6>
                    <c-manage  :conf="m1()"></c-manage>
                </div>
                <div v-if="selectedManage.code == 'edit_insert'">
                    <h6>Manage con insert e edit custom</h6>
                    <c-manage  :conf="m2()"></c-manage>
                </div>
                <div v-if="selectedManage.code == 'list'">
                    <h6>Manage con lista custom</h6>
                    <c-manage  :conf="m3()"></c-manage>
                </div>
            </div>
        </div>
    </div>
</template>

<script>




import cupparisPrimevue from "cupparis-primevue";
import ModelUser from './ModelUser';
const cManage = cupparisPrimevue.cManage;

export default {
    name: "TestManage",
    extends: cupparisPrimevue.CrudComponent,
    components: {cManage},
    data() {
        console.log('parametri',this.$route.params);
        return {
            selectedManage: {
                name: 'Semplice', code: 'simple'
            },
            manages: [
                {
                    name: 'Utente 1', code: 'simple'
                },
                {
                    name: 'Edit Insert Custom', code: 'edit_insert'
                },
                {
                    name: 'List Custom', code: 'list'
                }
            ],
            userConf : JSON.parse(JSON.stringify(ModelUser))
        }
    },
    methods: {
        m1() {
            let m = JSON.parse(JSON.stringify(ModelUser));
            m.list.constraintKey = 'created_by';
            m.list.constraintValue = this.$route.params.created_by;
            m.list.routeName = 'list-constraint';
            m.autoUpdateHash = false;
            return m;
        },
        m2() {
            let m = JSON.parse(JSON.stringify(ModelUser));
            m.editComponentName = 'insert-edit-user';
            m.insertComponentName = 'insert-edit-user';
            m.autoUpdateHash = false;
            return m;
        },
        m3() {
            let m = JSON.parse(JSON.stringify(ModelUser));
            m.listComponentName = 'list-user';
            m.autoUpdateHash = false;
            return m;
        },
    }
}

</script>

<style scoped>

</style>
