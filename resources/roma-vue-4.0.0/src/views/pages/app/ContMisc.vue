<template>
    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupContIva" ></c-manage>
        </div>
    </div>

    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupContTipologiaDocumento" ></c-manage>
        </div>
    </div>


    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupContFormaPagamento" ></c-manage>
        </div>
    </div>

    <div class="row mb--15">
        <div class="col-12">
            <c-manage :conf="ModelCupContCostanteFattEl" ></c-manage>
        </div>
    </div>
</template>

<script>
import Ci from '@/ModelConfs/CupContIva.js'
import Ctd from '@/ModelConfs/CupContTipologiaDocumento.js'
import Cfp from '@/ModelConfs/CupContFormaPagamento.js'
import Ccfe from '@/ModelConfs/CupContCostanteFattEl.js'

export default {
    name: "ContMisc",
    data() {
        return {
            ModelCupContIva : Ci,
            ModelCupContTipologiaDocumento : Ctd,
            ModelCupContFormaPagamento : Cfp,
            ModelCupContCostanteFattEl : Ccfe,
        }
    }
}
</script>

<style scoped>

</style>
