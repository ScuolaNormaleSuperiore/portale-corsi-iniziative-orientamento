import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";

export default {
    modelName : 'corso',
    search: {
        type: 'v-search',
        modelName : 'corso',
        fields: [
			'titolo',
			'iniziativa_id',

        ],
        fieldsConfig: {
			'titolo' : {
                type : "w-input",
			},
			'iniziativa_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
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
        modelName : 'corso',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
			'picture',
			'titolo',
            'homepage',
            // 'descrizione',
			'data_inizio',
			'data_fine',
			'note',
			'luogo',
			'indirizzo',
			'attivo',
			'provincia',
			'iniziativa',

        ],
        fieldsConfig: {

            'homepage' : {
                type : "w-swap",
                modelName : 'corso',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },
			'picture' : {
				type : "w-custom",
				ready() {
					var that = this;
					var urlPrefix = import.meta.env.VITE_APP_TARGET || '';
					var url = urlPrefix + '' + CrudHelpers.addBearerTokenToUrl(that.modelData.picture);

					var style = "background-image: url(\"" + url + "\") !important;";
					//+ "background-color: red;";

					//[style]="'background-image:url('+getImage(element.id)+')'"
					that.value = "<div class='w-5rem h-4rem m-auto bg-contain bg-no-repeat' " +
						// ":style=\"{ 'background-image': url('" + url + "') }\" " +
						//":style=\"{ 'background-image': url('" + url + "') }\" " +
						"style='" + style + "' >&nbsp;" +
						// "<img class='w-full' src='/api" + CrudHelpers.addBearerTokenToUrl(url) + "'/>" +
						"</div>";
				},
			},
			'titolo' : {
                type : "w-text",
			},
			'data_inizio' : {
                type : "w-text",
			},
			'data_fine' : {
                type : "w-text",
			},
			'luogo' : {
                type : "w-text",
			},
			'indirizzo' : {
                type : "w-text",
			},
			'attivo' : {
                type : "w-swap",
                modelName : 'corso',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
			},
			'provincia' : {
                type : "w-belongsto",
                labelFields : [
					'sigla'
				],
			},
			'iniziativa' : {
                type : "w-belongsto",
                labelFields : [
					'titolo',
				],
			},

        },
        orderFields : {
			'titolo' : 'titolo',
			'data_inizio' : 'data_inizio',
			'data_fine' : 'data_fine',
			'luogo' : 'luogo',
			'indirizzo' : 'indirizzo',
			'attivo' : 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName : 'corso',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
			'titolo',
			'iniziativa_id',
            'homepage',
			'data_inizio',
			'data_fine',
			'luogo',
			'indirizzo',
			'provincia_id',
			'note',
			'descrizione',
			// 'attivo',

			'attachments',
			'fotos'
        ],
        fieldsConfig: {
            'homepage' : {
                type : "w-radio",
                layout : {
                    lastInRow: true,
                    // colClass : 'col-12 md:col-4',
                }
            },
			'titolo' : {
                type : "w-input",
			},
			'descrizione' : {
                type : "w-editor",
                htmlAttributes: {},
				layout : {
					colClass : 'col-12',
				}
			},
			'data_inizio' : {
                type : "w-input",
                inputType: 'date',
			},
			'data_fine' : {
                type : "w-input",
                inputType: 'date',
			},
			'note' : {
                type : "w-textarea",
                htmlAttributes: {},
			},
			'iniziativa_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
			},
			'luogo' : {
                type : "w-input",
			},
			'indirizzo' : {
                type : "w-input",
			},
			'provincia_id' : {
                type : "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
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
							modelName : 'corso',
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
							modelName : 'corso',
							previewConf:{
								iconSize:'fa-3x'
							},
							label: 'File',
						},
						status : 'w-hidden',
						id : 'w-hidden',
						nome : 'w-hidden',
					}
				},
                limit: 1
			},

        }

    },
}
