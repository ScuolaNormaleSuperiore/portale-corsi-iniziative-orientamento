import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";

export default {
    modelName : 'iniziativa',
    search: {
        type: 'v-search',
        modelName : 'iniziativa',
        fields: [
			'titolo',

        ],
        fieldsConfig: {
			'titolo' : {
                type : "w-input",
			},

        },
        searchType: 'basic',
        searchLabel: false,
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
        modelName : 'iniziativa',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
            //'action-view2',
        ],

        actionsConfig : {
            'action-delete' : {
                visible() {
                    return this.modelData.candidati.length <= 0;
                }
            },
            'action-view2': {
                type: 'record',
                title: 'app.vista',
                //css: 'btn-outline-secondary',
                icon: 'fa fa-eye',
                text: '',

                controlType: 'link-download',
                href: function () {
                    var that = this;

                    return "#/iniziativa/" + that.modelData.id;
                    // var urlPrefix = import.meta.env.VITE_APP_TARGET || '';
                    // //
                    // return urlPrefix + CrudHelpers.addBearerTokenToUrl("#/front/studente/" + that.modelData.id);
                },
                target: '',
            },
        },
        fields: [
			'anno',
			'titolo',
			'descrizione',
			'data_apertura',
			'data_chiusura',
			'modalita_candidatura',
            'max_candidature_scuola',
			'attivo',

        ],
        fieldsConfig: {
            'anno' : {
                type : "w-text",
			},
			'titolo' : {
                type : "w-text",
			},
			'data_apertura' : {
                type : "w-text",
			},
			'data_chiusura' : {
                type : "w-text",
			},
			'modalita_candidatura' : {
                type : "w-text",
			},
            'max_candidature_scuola' : {
                type : "w-custom",
                ready() {
                    this.value = this.value === null ? 'Illimitate' : this.value;
                }
            },
			'attivo' : {
                type : "w-swap",
                modelName : 'iniziativa',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},

        },
        orderFields : {
			'anno' : 'anno',
			'titolo' : 'titolo',
			'data_apertura' : 'data_apertura',
			'data_chiusura' : 'data_chiusura',
			'modalita_candidatura' : 'modalita_candidatura',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'iniziativa',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'anno',
			'titolo',
			'modalita_candidatura',
			'data_apertura',
			'data_chiusura',

            'max_candidature_scuola',
            'posti',
            'posti_onere',
            'note',
			'attivo',
			'descrizione',


        ],
        fieldsConfig: {
			'anno' : {
                type : "w-select",

			},
			'titolo' : {
                type : "w-input",
			},
            'max_candidature_scuola' : {
                type : "w-input",
                inputType: 'number',
            },
			'descrizione' : {
                type : "w-editor",
                htmlAttributes: {},
                layout: {
                    colClass : "col-12"
                }
			},
			'data_apertura' : {
                type : "w-input",
                inputType : "date",
			},
			'data_chiusura' : {
                type : "w-input",
                inputType : "date",
			},
			'posti' : {
                type : "w-input",
                inputType : "number",
                layout: {
                    colClass : "col-12 md:col-3"
                }
			},
            'posti_onere' : {
                type : "w-input",
                inputType : "number",
                layout: {
                    colClass : "col-12 md:col-3"
                }
            },
            'modalita_candidatura' : {
                type : "w-select",
            },

            'note' : {
                type: 'w-textarea',
            },


            'attivo' : {
                type : "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
			},
            attachments : {
                type :'w-hasmany',
                langContext : 'attachments.fields',

                hasmanyConf : {
                    fields : [
                        'id','nome','resource','status'
                    ],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['pdf','doc','docx'],
                            //extensions : ['csv','xls'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'attachments|resource',
                                resource_type : 'attachment'
                            },
                            modelName : 'iniziativa',
                            previewConf:{
                                iconSize:'fa-3x'
                            },
                            label: 'File',
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                    }
                }
            },
            fotos : {
                type :'w-hasmany',
                hasmanyConf : {
                    langContext : 'fotos.fields',
                    fields : [
                        'id','nome','resource','status'
                    ],
                    fieldsConfig : {
                        resource : {
                            type : 'w-upload-ajax',
                            extensions : ['jpg','png'],
                            //extensions : ['csv','xls'],
                            maxFileSize : '2M',
                            ajaxFields : {
                                field : 'fotos|resource',
                                resource_type : 'foto'
                            },
                            modelName : 'iniziativa',
                            previewConf:{
                                iconSize:'fa-3x'
                            },
                            label: 'File',
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                        nome : 'w-hidden',
                    }
                }
            },

        }

    },
}

//
// type: "w-custom",
//     ready() {
//     var that = this;
//     var urlPrefix = import.meta.env.VITE_APP_TARGET || '';
//     var url = urlPrefix + '' + CrudHelpers.addBearerTokenToUrl(that.modelData.picture_icon);
//
//     var style = "background-image: url(\"" + url + "\") !important;";
//     //+ "background-color: red;";
//
//     //[style]="'background-image:url('+getImage(element.id)+')'"
//     that.value = "<div class='w-5rem h-4rem m-auto bg-cover-img' " +
//         // ":style=\"{ 'background-image': url('" + url + "') }\" " +
//         //":style=\"{ 'background-image': url('" + url + "') }\" " +
//         "style='" + style + "' >&nbsp;" +
//         // "<img class='w-full' src='/api" + CrudHelpers.addBearerTokenToUrl(url) + "'/>" +
//         "</div>";
// },
