<template>
    <div>
        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoNazione"></c-manage>
            </div>
        </div>

        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoContinente" c-collapsible="collapsed"></c-manage>
            </div>
        </div>


        <div class="row mb--15">
            <div class="col-12">
                <c-manage :conf="ModelCupGeoAreaMondiale" c-collapsible="collapsed"></c-manage>
            </div>
        </div>
    </div>
</template>

<script>
import Mn from '@/ModelConfs/CupGeoNazione.js'
import Mc from '@/ModelConfs/CupGeoContinente.js'
import Ma from '@/ModelConfs/CupGeoAreaMondiale.js'
export default {
    name: "GeoMondo",
    data() {
        return {
            ModelCupGeoNazione : Mn,
            ModelCupGeoContinente : Mc,
            ModelCupGeoAreaMondiale : Ma
        }
    }
}
</script>

<style scoped>

</style>
