import cs from 'cupparis-primevue';
import _ from "lodash";
import Server from "cupparis-primevue/src/lib/Server";
import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";
import CrudVars from "cupparis-primevue/src/lib/CrudVars";

export default {
    modelName: 'candidato',
    search: {
        searchType: 'advanced',
        searchLabel: false,

        type: 'v-search',
        modelName: 'candidato',
        fields: [
            'iniziativa_id',
            'status',
            'nome',
            'cognome',
            'provincia_id',
            'tipo',
            // 'scuola_id',
            // 'tipo',

        ],
        fieldsConfig: {
            'status': {
                type: "w-select",
            },
            'iniziativa_id': {
                type: "w-select",
            },
            'tipo': {
                type: "w-select",
            },
            'nome': {
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'provincia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'scuola_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },


        },
        // groups: {
        //     'g0': {
        //         fields: [
        //
        //         ],
        //     },
        //     'g1': {
        //         fields: [
        //
        //         ],
        //     }
        // },

    },
    list: {
        type: 'v-list',
        modelName: 'candidato',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
            'action-export-xls',
            'action-export-media',
            'action-view2',
        ],
        actionsConfig : {

            'action-view2': {
                type: 'record',
                title: 'app.vista',
                //css: 'btn-outline-secondary',
                icon: 'fa fa-eye',
                text: '',

                controlType: 'link-download',
                href: function () {
                    var that = this;

                    return "#/candidatov/" + that.modelData.id;
                    // var urlPrefix = import.meta.env.VITE_APP_TARGET || '';
                    // //
                    // return urlPrefix + CrudHelpers.addBearerTokenToUrl("#/front/studente/" + that.modelData.id);
                },
                target: '',
            },
            'action-export-xls' : {
                execute (event) {
                    let tA = this;
                    return new Promise(function (resolve,reject) {
                        tA._exportCsv(function (esito) {
                            console.log('save back Event',event,esito);
                            if (esito) {
                                resolve();
                            } else {
                                reject();
                            }

                        })
                    })
                    //this._save(callback)
                },
                _exportCsv (callback) {
                    var that = this
                    var r = that.view.createRoute(that.routeName)
                    r.setValues({
                        'foorm': that.view.modelName,
                        'foormtype': 'list'
                    })
                    r.setParams(that.view.getParams());
                    r.setParam('csvType', that.csvType)
                    that.view.waitStart(that.startMessage)
                    Server.route(r, function (json) {
                        that.view.waitEnd()
                        if (json.error) {
                            that.view.errorDialog(json.msg)
                            callback(false)
                            return
                        }
                        //let prefix = CrudVars.useApi?'/api':'';
                        //document.location.href = prefix + json.result.link
                        if (that.blob) {
                            let filename = json.result[that.nameField]?json.result[that.nameField]:'file.pdf';
                            CrudHelpers.createRuntimeDownload(json.result[that.contentField],json.result[that.mimeField],filename);
                        } else {
                            var anchor = document.createElement('a');
                            anchor.href = json.result.link;
                            anchor.target="_blank";
                            anchor.click();
                        }
                        callback(true)
                        //console.log(json)
                    })

                    //console.log('r', r)
                },
                type: 'collection',
                icon: 'fa fa-file-excel',
                text: 'Esporta',
                css: 'p-button-sm p-button-text p-button-secondary',
                csvType: 'default',
                routeName: 'xls-exporta',
                startMessage: 'Generazione csv in corso...',
                blob: true,
                contentField: 'content',
                mimeField: 'mime',
                nameField: 'name',
            },


            'action-export-media' : {
                visible() {
                    console.log("CICCIO",this.modelData);
                  return this.modelData.attachments.length > 0;
                },
                execute (event) {
                    let tA = this;
                    return new Promise(function (resolve,reject) {
                        tA._exportPdf(function (esito) {
                            console.log('save back Event',event,esito);
                            if (esito) {
                                resolve();
                            } else {
                                reject();
                            }

                        })
                    })
                    //this._save(callback)
                },
                _exportPdf (callback) {
                    var that = this
                    var r = that.view.createRoute(that.routeName)
                    let foormPk = that.modelData[that.view.primaryKey];
                    r.setValues({
                        'foorm': that.view.modelName,
                        'foormtype': 'list',
                        'foormpk' : foormPk
                    })
                    // r.setParams(that.view.getParams());
                    // r.setParam('relation', that.pdfType)
                    that.view.waitStart(that.startMessage)
                    Server.route(r, function (json) {
                        that.view.waitEnd()
                        if (json.error) {
                            that.view.errorDialog(json.msg)
                            callback(false);
                            return
                        }
                        if (that.blob) {
                            let filename = json.result[that.nameField]?json.result[that.nameField]:'file.zip';
                            CrudHelpers.createRuntimeDownload(json.result[that.contentField],json.result[that.mimeField],filename);
                        } else {
                            let prefix = CrudVars.useApi?'/api':'';
                            document.location.href = prefix + json.result.link
                        }
                        callback(true);
                        //console.log(json)
                    })

                    //console.log('r', r)
                },
                type: 'record',
                icon: 'fa fa-download',
                text: '',
                title: 'Esportazione di tutti gli allegati',
                css: 'p-button-sm p-button-text p-button-secondary',
                pdfType: 'record',
                routeName: 'media-export',
                startMessage: 'Generazione file zip in corso...',
                blob: true,
                contentField: 'content',
                mimeField: 'mime',
                nameField: 'name',
            }

        },
        fields: [
            'status',
            'iniziativa',
            'nome',
            'cognome',
            'tipo_text',
            'media',
            // 'tipo',
            'scuola',
            'data_candidatura',

        ],
        fieldsConfig: {
            'data_candidatura': {
                type: 'w-date-text',
                invalidDateString : "N.D.",
            },
            'iniziativa': {
                type: "w-custom",
                ready() {
                    this.value = this.modelData.iniziativa.titolo;
                }
            },
            'status': {
                type: "w-swap-select",
                modelName: 'candidato',
            },
            'nome': {
                type: "w-text",
            },
            'cognome': {
                type: "w-text",
            },
            'media': {
                type: "w-text",
            },
            'tipo': {
                type: "w-text",
            },
            'scuola': {
                type: "w-custom",
                ready() {
                    this.value = this.value.denominazione + ' - ' + this.value.comune + ' ('
                        + this.value.provincia_sigla + ')';
                }


            },

        },
        orderFields: {
            'anno': 'anno',
            'nome': 'nome',
            'cognome': 'cognome',
            'media': 'media',
            'tipo': 'tipo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'candidato',
        afterDraw() {
            this.getWidget('iniziativa_id').change();
        },
        actions : ['action-save','action-save-back','action-back'],
        fields: [
            'iniziativa_id',

            'corsi',

            'nome',
            'cognome',
            'sesso',
            'luogo_nascita',
            'data_nascita',
            'indirizzo',
            'comune',
            'cap',
            'provincia_id',
            'emails',
            'telefono',

            'scuola_id',
            'scuola_estera',
            'classe',
            'sezione',


            'gen1_titolo_studio_id',
            'gen2_titolo_studio_id',
            'gen1_professione_id',
            'gen2_professione_id',
            'gen1_professione_altro',
            'gen2_professione_altro',

            'inglese_livello_linguistico_id',
            'francese_livello_linguistico_id',
            'tedesco_livello_linguistico_id',
            'spagnolo_livello_linguistico_id',
            'cinese_livello_linguistico_id',
            'altre_competenze_linguistiche',

            'profilo',

            'olimpiadi_matematica',
            'olimpiadi_matematica_squadre',
            'olimpiadi_matematica_squadre_femminili',
            'olimpiadi_fisica',
            'olimpiadi_fisica_squadre_miste',
            'olimpiadi_scienze_naturali',
            'giochi_chimica',
            'olimpiadi_informatica',
            'stages',
            'gare_internazionali',
            'gare_umanistiche',


            'partecipazione_concorsi',
            'esperienze_estere',
            'settore_professionale',
            'motivazioni',

            'modalita_conoscenza_sns_id',
            'informativa',
            'note',
            'media',
            'tipo',
            'user_id',

            'attachments',
            'voti',


        ],
        fieldsConfig: {
            'olimpiadi_matematica': {
                type: 'w-select',
            },
            'olimpiadi_matematica_squadre': {
                type: 'w-select',
            },
            'olimpiadi_matematica_squadre_femminili': {
                type: 'w-select',
            },
            'olimpiadi_fisica': {
                type: 'w-select',
            },
            'olimpiadi_fisica_squadre_miste': {
                type: 'w-select',
            },
            'olimpiadi_scienze_naturali': {
                type: 'w-select',
            },
            'giochi_chimica': {
                type: 'w-select',
            },
            'olimpiadi_informatica': {
                type: 'w-select',
            },
            'stages': {
                type: 'w-checkbox',
                layout: {
                    colClass: 'w-12',
                },
            },
            'gare_internazionali': {
                type: 'w-checkbox',
                layout: {
                    colClass: 'w-12',
                },
            },
            'gare_umanistiche': {
                type: 'w-checkbox',
                layout: {
                    colClass: 'w-12',
                },
            },


            'iniziativa_id': {
                type: 'w-select',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Scegli l\'iniziativa',
                // dividerDescription : 'In caso di stato estero, la provincia è automaticamente EE',
                // rules: 'required',
                hidden: true,
                label: '',
                change() {
                    var that = this;
                    if (this.getValue() === -1) {
                        that.view.hideWidget('corsi');
                        that.view.metadata.corsi.domainValues = {};
                        that.view.metadata.corsi.domainValuesOrder = [];

                        return;
                    }
                    cs.Server.get('/api/iniziativa-corsi/' + that.getValue(), {
                        //id: id,
                    }, function (json) {
                        //let tt = this;
                        if (json.error) {
                            cs.CrudCore.alertError(json.msg);
                            return;
                        }


                        var dv = json.result.options;
                        var dvo = json.result.options_order
                        console.log("CHANGE CROSI", dv, dvo);
                        console.log("CORSIII ", that.view.getWidget('corsi').getValue());
                        that.view.metadata.corsi.domainValues = dv;
                        that.view.metadata.corsi.domainValuesOrder = dvo;

                        let corsi = that.view.getWidget('corsi');
                        corsi.domainValues = dv;
                        corsi.domainValuesOrder = dvo;
                        corsi.options = [];
                        for (var i in dvo) {
                            corsi.options.push({
                                code : ""+dvo[i],
                                name : dv[dvo[i]],
                            })
                        }
                        that.view.showWidget('corsi');
                        // that.view.config.fieldsConfig.corsi.type = 'w-select';
                        // that.view.getWidget('corsi').setValue(that.view.getWidget('corsi').getValue())
// /                        that.view.getWidget('corsi').value = that.view.getWidget('corsi').getValue();
                        // that.view.getWidget('corsi').setValue(that.view.modelData.corsi);

                    })
                    return;
                }
            },
            'corsi': {
                type: 'w-checkbox',
                layout: {
                    colClass: 'w-12',
                },
                label: '',
                ready() {
                    for (var i in this.value) {
                        this.value[i] = '' + this.value[i];
                    }
                }
            },
            'nome': {
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Dati anagrafici e di contatto',
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'emails': {
                type: "w-input",
            },
            'sesso': {
                type: "w-select",
            },
            'luogo_nascita': {
                type: "w-input",
            },
            'data_nascita': {
                type: "w-input",
                inputType: "date",
            },
            'indirizzo': {
                type: "w-input",
            },
            'comune': {
                type: "w-input",
            },
            'cap': {
                type: "w-input",
            },
            'provincia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'telefono': {
                type: "w-input",
            },
            'scuola_id': {
                type: "w-autocomplete",
                foormName: 'candidato',
                viewType: 'edit',
                labelFields: [
                    'id',
                    'denominazione',
                    'denominazione_istituto_riferimento',
                    'codice',
                    'comune',
                    'provincia|sigla',
                ],
                clearButton: true,
                extraBind: {
                    'placeholder': "Digita le iniziali di una scuola...",
                    'dropdown': true,
                    'option-label': function (obj) {
                        if (!obj.denominazione) {
                            return null;
                        }
                        return obj.denominazione + ' - Cod: ' + obj.codice + ' - ' + obj.comune + ' (' + obj["provincia|sigla"] + ') ';
                    },
                    'option-value': 'id',
                },
                label: 'Scuola',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Scuola di provenienza',
            },
            'scuola_estera': {
                type: 'w-input',
            },
            'classe': {
                type: "w-select",
                layout: {
                    colClass: 'col-6 md:col-3',
                }
            },
            'sezione': {
                type: "w-input",
                layout: {
                    colClass: 'col-6 md:col-3',
                }
            },
            'gen1_titolo_studio_id': {
                type: "w-select",
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Dati aggiuntivi della famiglia',
                //type : "w-input",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen2_titolo_studio_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen1_professione_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen2_professione_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'gen1_professione_altro': {
                type: "w-input",
            },
            'gen2_professione_altro': {
                type: "w-input",
            },
            'note': {
                type: "w-textarea",
            },
            'profilo': {
                type: "w-textarea",
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Profilo, esperienze, motivazioni',
                layout: {
                    lastInRow: true,
                }
            },
            'partecipazione_concorsi': {
                type: "w-textarea",
            },
            'inglese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Competenze linguistiche',
            },
            'francese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'tedesco_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'spagnolo_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'cinese_livello_linguistico_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'altre_competenze_linguistiche': {
                type: "w-input",
            },
            'esperienze_estere': {
                type: "w-textarea",
            },
            'settore_professionale': {
                type: "w-textarea",
            },
            'motivazioni': {
                type: "w-textarea",
            },
            'modalita_conoscenza_sns_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Altre info',

            },
            'informativa': {
                type: "w-select",
                'label': 'Informativa privacy',
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'media': {
                type: "w-hidden",
            },
            'tipo': {
                type: "w-hidden",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'user_id': {
                type: "w-hidden",
                //domainValues : [],
                //domainValuesOrder : [],
            },

            'voti': {
                type: 'w-hasmany',
                layout: {
                    'colClass': 'col-12',
                },
                label: '',
                divider: 'before',
                dividerClass: 'text-blue-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Voti',


                // template: {
                //     name: "tpl-record",
                //     layoutType: "full",
                //     labelType: "none"
                // },
                hasmanyType: 'list',
                hasmanyConf: {
                    getFieldName(name) {
                        return 'voti-' + name + '[]';

                    },
                    actions: ['action-insert', 'action-delete', 'action-delete-selected'],
                    modelName: 'candidato_voti',
                    fields: [
                        'id',
                        // 'nome_it',
                        'materia_id',
                        'voto_anno_1',
                        'voto_anno_2',
                        'voto_primo_quadrimestre',
                    ],
                    fieldsConfig: {
                        id: 'w-hidden',
                        materia_id: 'w-select',
                        voto_anno_1: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                        voto_anno_2: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                        voto_primo_quadrimestre: {
                            type: 'w-input',
                            inputType: 'number',
                        },
                    }
                }
            },
            attachments: {
                type: 'w-hasmany',
                langContext: 'attachments.fields',

                hasmanyConf: {
                    fields: [
                        'id', 'nome', 'resource', 'status'
                    ],
                    fieldsConfig: {
                        resource: {
                            type: 'w-upload-ajax',
                            extensions: ['pdf', 'doc', 'docx'],
                            //extensions : ['csv','xls'],
                            maxFileSize: '2M',
                            ajaxFields: {
                                field: 'attachments|resource',
                                resource_type: 'attachment'
                            },
                            modelName: 'candidato',
                            previewConf: {
                                iconSize: 'fa-3x'
                            },
                            label: 'File',
                        },
                        status: 'w-hidden',
                        id: 'w-hidden',
                        nome: 'w-hidden',
                    }
                }

            },

        }

    }
    ,
}
