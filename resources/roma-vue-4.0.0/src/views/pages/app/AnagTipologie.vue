<template>
    <div>
        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupAnagTipologiaAnagrafica"></c-manage>
            </div>
        </div>

        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupAnagTipologiaIndirizzo"></c-manage>
            </div>
        </div>

        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupAnagTipologiaAffiliazione"></c-manage>
            </div>
        </div>
    </div>
</template>

<script>
import Ata from '@/ModelConfs/CupAnagTipologiaAnagrafica.js'
import Ati from '@/ModelConfs/CupAnagTipologiaIndirizzo.js'
import Ataf from '@/ModelConfs/CupAnagTipologiaAffiliazione.js'

export default {
    name: "AnagTipologie",
    data() {
        return {
            ModelCupAnagTipologiaAnagrafica : Ata,
            ModelCupAnagTipologiaIndirizzo : Ati,
            ModelCupAnagTipologiaAffiliazione : Ataf,
            // ModelCupGeoRegione : Mr,
            // ModelCupGeoArea : Ma,
        }
    }
}
</script>

<style scoped>

</style>
