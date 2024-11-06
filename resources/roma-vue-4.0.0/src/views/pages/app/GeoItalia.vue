<template>
    <div>
        <h5>Esempi di Manage</h5>
        <SelectButton v-model="selectedManage" :options="manages" optionLabel="name" />
        <hr>
        <div v-if="selectedManage.code == 'comune'" class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoComune()"></c-manage>
            </div>
        </div>

        <div v-if="selectedManage.code == 'provincia'" class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoProvincia()"></c-manage>
            </div>
        </div>

        <div v-if="selectedManage.code == 'regione'" class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoRegione()"></c-manage>
            </div>
        </div>

        <div v-if="selectedManage.code == 'area'" class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoArea()"></c-manage>
            </div>
        </div>
    </div>
</template>

<script>
import Mc from '@/ModelConfs/CupGeoComune.js'
import Mp from '@/ModelConfs/CupGeoProvincia.js'
import Mr from '@/ModelConfs/CupGeoRegione.js'
import Ma from '@/ModelConfs/CupGeoArea.js'

export default {
    name: "GeoItalia",
    data() {
        Mr.list.actions.push('action-show-provincia');
        Mr.list.actionsConfig['action-show-provincia'] = {
            type : 'record',
            text : 'Pr',
            execute() {
                let ta = this;
                let defaultConf = ta.getDefaultViewConf('cup_geo_provincia','v-list');
                defaultConf.routeName = 'list-constraint';
                defaultConf.constraintKey = 'regione_id';
                defaultConf.constraintValue = ta.modelData.id;
                defaultConf.actions = [];
                ta.componentDialog('v-list',defaultConf)
            }
        }
        return {
            selectedManage: {
                name: 'Semplice', code: 'comune'
            },
            manages: [
                {
                    name: 'Comune', code: 'comune'
                },
                {
                    name: 'Provincia', code: 'provincia'
                },
                {
                    name: 'Area', code: 'area'
                },
                {
                    name: 'Regione', code: 'regione'
                }
            ],
        }
    },
    methods: {
        ModelCupGeoComune() {
            return Mc;
        },
        ModelCupGeoProvincia() {
            return Mp;
        },
        ModelCupGeoRegione() {
            return Mr;
        },
        ModelCupGeoArea() {
            return Ma;
        }
    }
}
</script>

<style scoped>

</style>
