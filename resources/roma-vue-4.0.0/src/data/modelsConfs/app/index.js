import cs from 'cupparis-primevue';
//IMPORT START
import ModelComune from './ModelComune.js';
import ModelNazione from './ModelNazione.js';
import ModelCopertina from './ModelCopertina.js';
import ModelAvviso from './ModelAvviso.js';
import ModelScuolaRichiesta from './ModelScuolaRichiesta.js';
import ModelVideo from './ModelVideo.js';
import ModelCategoriaVideo from './ModelCategoriaVideo.js';
import ModelSezioneLayout from './ModelSezioneLayout.js';
import ModelEvento from './ModelEvento.js';
import ModelNews from './ModelNews.js';
import ModelStudenteOrientamento from './ModelStudenteOrientamento.js';
import ModelMateriaOrientamento from './ModelMateriaOrientamento.js';
import ModelClasse from './ModelClasse.js';
import ModelSezioneContenuto from './ModelSezioneContenuto.js';
import ModelPagina from './ModelPagina.js';
import ModelPaginaOrientamento from './ModelPaginaOrientamento.js';
import ModelPaginaInfo from './ModelPaginaInfo.js';
import ModelAppuntamento from './ModelAppuntamento.js';
import ModelCandidatoCorso from './ModelCandidatoCorso.js';
import ModelCandidatoVoti from './ModelCandidatoVoti.js';
import ModelCandidato from './ModelCandidato.js';
import ModelModalitaConoscenzaSns from './ModelModalitaConoscenzaSns.js';
import ModelLivelloLinguistico from './ModelLivelloLinguistico.js';
import ModelProfessione from './ModelProfessione.js';
import ModelTitoloStudio from './ModelTitoloStudio.js';
import ModelFiltroSelezione from './ModelFiltroSelezione.js';
import ModelCorso from './ModelCorso.js';
import ModelIniziativa from './ModelIniziativa.js';
import ModelDScuolaParitaria from './ModelDScuolaParitaria.js';
import ModelDScuola from './ModelDScuola.js';
import ModelScuola from './ModelScuola.js';
import ModelProvincia from './ModelProvincia.js';
import ModelRegione from './ModelRegione.js';
import ModelSettore from './ModelSettore.js';
import ModelMateria from './ModelMateria.js';
import ModelUser from './ModelUser.js';
import ModelUser2 from './ModelUser2.js';
import DCupGeoComune from './DCupGeoComune.js';
//IMPORT END

export default {
    install() {
        //INSTALL START
		cs.CrudVars.modelConfs.ModelComune = ModelComune;
		cs.CrudVars.modelConfs.ModelNazione = ModelNazione;
		cs.CrudVars.modelConfs.ModelCopertina = ModelCopertina;
		cs.CrudVars.modelConfs.ModelAvviso = ModelAvviso;
		cs.CrudVars.modelConfs.ModelScuolaRichiesta = ModelScuolaRichiesta;
		cs.CrudVars.modelConfs.ModelVideo = ModelVideo;
		cs.CrudVars.modelConfs.ModelCategoriaVideo = ModelCategoriaVideo;
		cs.CrudVars.modelConfs.ModelSezioneLayout = ModelSezioneLayout;
		cs.CrudVars.modelConfs.ModelEvento = ModelEvento;
		cs.CrudVars.modelConfs.ModelNews = ModelNews;
		cs.CrudVars.modelConfs.ModelStudenteOrientamento = ModelStudenteOrientamento;
		cs.CrudVars.modelConfs.ModelMateriaOrientamento = ModelMateriaOrientamento;
		cs.CrudVars.modelConfs.ModelClasse = ModelClasse;
		cs.CrudVars.modelConfs.ModelSezioneContenuto = ModelSezioneContenuto;
		cs.CrudVars.modelConfs.ModelPagina = ModelPagina;
		cs.CrudVars.modelConfs.ModelPaginaOrientamento = ModelPaginaOrientamento;
        cs.CrudVars.modelConfs.ModelPaginaInfo = ModelPaginaInfo;
		cs.CrudVars.modelConfs.ModelAppuntamento = ModelAppuntamento;
		cs.CrudVars.modelConfs.ModelCandidatoCorso = ModelCandidatoCorso;
		cs.CrudVars.modelConfs.ModelCandidatoVoti = ModelCandidatoVoti;
		cs.CrudVars.modelConfs.ModelCandidato = ModelCandidato;
		cs.CrudVars.modelConfs.ModelModalitaConoscenzaSns = ModelModalitaConoscenzaSns;
		cs.CrudVars.modelConfs.ModelLivelloLinguistico = ModelLivelloLinguistico;
		cs.CrudVars.modelConfs.ModelProfessione = ModelProfessione;
		cs.CrudVars.modelConfs.ModelTitoloStudio = ModelTitoloStudio;
		cs.CrudVars.modelConfs.ModelFiltroSelezione = ModelFiltroSelezione;
		cs.CrudVars.modelConfs.ModelCorso = ModelCorso;
		cs.CrudVars.modelConfs.ModelIniziativa = ModelIniziativa;
        cs.CrudVars.modelConfs.ModelDScuolaParitaria = ModelDScuolaParitaria;
        cs.CrudVars.modelConfs.ModelDScuola = ModelDScuola;
		cs.CrudVars.modelConfs.ModelScuola = ModelScuola;
		cs.CrudVars.modelConfs.ModelProvincia = ModelProvincia;
		cs.CrudVars.modelConfs.ModelRegione = ModelRegione;
		cs.CrudVars.modelConfs.ModelSettore = ModelSettore;
		cs.CrudVars.modelConfs.ModelMateria = ModelMateria;
        cs.CrudVars.modelConfs.ModelUser = ModelUser;
        cs.CrudVars.modelConfs.ModelUser2 = ModelUser2;
        cs.CrudVars.modelConfs.DCupGeoComune = DCupGeoComune;
        //INSTALL END

    }
}
