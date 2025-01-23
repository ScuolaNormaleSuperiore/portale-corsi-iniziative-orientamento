<template>
    <InlineMessage class="p-3 m-1" severity="info">
        <div>Gestione Tabelle di supporto per la configurazione amministrativa.</div>
    </InlineMessage>
    <div class="mt-3">
        <MegaMenu :model="menuItems" class="text-teal-500"/>
    </div>
    <hr/>
    <div v-if="conf">
        <c-manage :conf="conf"></c-manage>
    </div>
    <div v-if="confEdit">
        <c-view :conf="confEdit"></c-view>
    </div>
</template>

<script>
import cs from "cupparis-primevue";
import ModelMateria from "../../../data/modelsConfs/app/ModelMateria";
import ModelClasse from "../../../data/modelsConfs/app/ModelClasse";
import ModelModalitaConoscenzaSns from "../../../data/modelsConfs/app/ModelModalitaConoscenzaSns";
import ModelRegione from "../../../data/modelsConfs/app/ModelRegione";
import ModelProvincia from "../../../data/modelsConfs/app/ModelProvincia";
import ModelProfessione from "../../../data/modelsConfs/app/ModelProfessione";
import ModelTitoloStudio from "../../../data/modelsConfs/app/ModelTitoloStudio";
import ModelLivelloLinguistico from "../../../data/modelsConfs/app/ModelLivelloLinguistico";
import ModelFiltroSelezione from "../../../data/modelsConfs/app/ModelFiltroSelezione";
import ModelMateriaOrientamento from "../../../data/modelsConfs/app/ModelMateriaOrientamento";
import ModelCategoriaVideo from "../../../data/modelsConfs/app/ModelCategoriaVideo";
import ModelComune from "../../../data/modelsConfs/app/ModelComune";
import ModelNazione from "../../../data/modelsConfs/app/ModelNazione";

export default {
    data() {
        let that = this;
        const menuItems = [
            {
                label: 'Materie scolastiche', icon: 'fa fa-book-open', class: 'text-red-500',
                command() {
                    that.setConf(ModelMateria);
                }
            },
            {
                label: 'Nazioni', icon: 'fa fa-map-location-dot',
                command() {
                    that.setConf(ModelNazione);
                }
            },
            {
                label: 'Regioni', icon: 'fa fa-map-location-dot',
                command() {
                    that.setConf(ModelRegione);
                }
            },
            {
                label: 'Province', icon: 'fa fa-map-location-dot',
                command() {
                    that.setConf(ModelProvincia);
                }
            },
            {
                label: 'Comuni', icon: 'fa fa-map-location-dot',
                command() {
                    that.setConf(ModelComune);
                }
            },
            {
                label: 'Professioni', icon: 'fa fa-briefcase',
                command() {
                    that.setConf(ModelProfessione);
                }
            },
            {
                label: 'Titoli di studio', icon: 'fa fa-graduation-cap',
                command() {
                    that.setConf(ModelTitoloStudio);
                }
            },
            {
                label: 'Livelli linguistici', icon: 'fa fa-language',
                command() {
                    that.setConf(ModelLivelloLinguistico);
                }
            },
            {
                label: 'Modalita Conoscenza Sns', icon: 'fa fa-person-circle-question',
                command() {
                    that.setConf(ModelModalitaConoscenzaSns);
                }
            },
            {
                label: 'Filtri di selezione iniziative', icon: 'fa fa-sliders',
                command() {
                    that.setConf(ModelFiltroSelezione);
                }
            },
            {
                label: 'Classi orientamento', icon: 'fa fa-gears',
                command() {
                    that.setConf(ModelClasse);
                }
            },
            {
                label: 'Materie orientamento', icon: 'fa fa-gears',
                command() {
                    that.setConf(ModelMateriaOrientamento);
                }
            },
            {
                label: 'Categorie video', icon: 'fa fa-brands fa-youtube',
                command() {
                    that.setConf(ModelCategoriaVideo);
                }
            },

        ];

        return {
            menuItems: menuItems,
            conf: null,
            confEdit: null,
        };
    },
    methods: {
        setConf(conf) {
            let that = this;
            let cf = cs.CrudCore.clone(conf);
            cf.autoUpdateHash = false;
            that.conf = null;
            that.confEdit = null;
            setTimeout(function () {
                that.conf = cf;
            }, 20)
        },

        setConfEdit(conf, pk) {
            let that = this;
            let ce = cs.CrudCore.clone(conf.edit);
            ce.pk = pk;
            ce.actions = ['action-save']
            that.conf = null;
            that.confEdit = null;
            setTimeout(function () {
                that.confEdit = ce;
            }, 20)
        }
    }
};
</script>
