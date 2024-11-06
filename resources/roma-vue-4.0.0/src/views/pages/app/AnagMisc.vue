<template>
    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupAnagNaturaGiuridica" ></c-manage>
        </div>
    </div>

    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupAnagStatoCivile" ></c-manage>
        </div>
    </div>


    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupAnagProfessione" ></c-manage>
        </div>
    </div>
</template>

<script>
import Ang from '@/ModelConfs/CupAnagNaturaGiuridica.js'
import Asc from '@/ModelConfs/CupAnagStatoCivile.js'
import Anp from '@/ModelConfs/CupAnagProfessione.js'


export default {
    name: "AnagMisc",
    data() {
        return {
            ModelCupAnagNaturaGiuridica : Ang,
            ModelCupAnagStatoCivile : Asc,
            ModelCupAnagProfessione : Anp,
        }
    }

}
</script>

<style scoped>

</style>
