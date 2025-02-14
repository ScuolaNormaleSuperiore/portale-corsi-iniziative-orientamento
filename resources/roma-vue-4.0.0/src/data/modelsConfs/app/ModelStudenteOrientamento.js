import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";

export default {
    modelName: 'studente_orientamento',
    search: {
        type: 'v-search',
        modelName: 'studente_orientamento',
        fields: [
            'nome',
            'cognome',
            'materia_id',

        ],
        fieldsConfig: {
            'materia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'nome': {
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'link': {
                type: "w-input",
            },
            'attivo': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },

        },
        searchType: 'advanced',
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
        modelName: 'studente_orientamento',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            // 'action-delete-selected',
        ],
        fields: [
            'picture',
            'nome',
            'cognome',
            'attivo',
            'materia',

        ],
        fieldsConfig: {
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
            'nome': {
                type: "w-text",
            },
            'cognome': {
                type: "w-text",
            },
            'link': {
                type: "w-text",
            },
            'attivo': {
                type: "w-swap",
                modelName: 'studente_orientamento',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },
            'materia': {
                type: "w-belongsto",
                labelFields: [
                    'nome_it',
                ],
            },

        },
        orderFields: {
            'nome': 'nome',
            'cognome': 'cognome',
            'link': 'link',
            'attivo': 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'studente_orientamento',
        actions : ['action-save','action-save-back','action-back'],
        fields: [
            'nome',
            'cognome',
            'materia_id',
            'link',
            'attivo',
            'descrizione_it',
            'fotos',

        ],
        fieldsConfig: {
            'materia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'nome': {
                type: "w-input",
            },
            'cognome': {
                type: "w-input",
            },
            'descrizione_it': {
                type: "w-editor",
                layout: {
                    colClass: 'w-12'
                }
            },
            'link': {
                type: "w-input",
            },
            'attivo': {
                type: "w-radio",
                //domainValues : [],
                //domainValuesOrder : [],
            },

            fotos: {
                type: 'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Foto',
                hasmanyConf: {
                    langContext : 'fotos.fields',
                    fields: [
                        'id', 'nome', 'resource', 'status'
                    ],
                    fieldsConfig: {
                        resource: {
                            type: 'w-upload-ajax',
                            extensions: ['jpg', 'png'],
                            //extensions : ['csv','xls'],
                            maxFileSize: '2M',
                            ajaxFields: {
                                field: 'fotos|resource',
                                resource_type: 'foto'
                            },
                            modelName: 'studente_orientamento',
                            previewConf: {
                                iconSize: 'fa-3x'
                            },
                            label: 'File',
                        },
                        status: 'w-hidden',
                        id: 'w-hidden',
                        nome : 'w-hidden',
                    }

                },
                layout: {
                    colClass: 'w-12'
                },
                limit: 1,

            },
        },


    },
}
