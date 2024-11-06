import cs from "cupparis-primevue";
import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";

export default {
    modelName: 'news',
    search: {
        type: 'v-search',
        modelName: 'news',
        fields: [
            'data',
            'titolo_it',

        ],
        fieldsConfig: {
            'titolo_it': {
                type: "w-input",
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
        modelName: 'news',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
            'picture',
            'data',
            'titolo_it',
            'evidenza',
            'attivo',

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
            'data': {
                type: "w-text",
            },
            'titolo_it': {
                type: "w-text",
            },
            evidenza: {
                type: 'w-select',
                modelName: 'news',
                oldValue: null,
                ready() {
                    this.oldValue = this.value;
                },
                change() {
                    let that = this;
                    let st = that.getValue();
                    if (st === that.oldValue) {
                        return;
                    }

                    let r = that.createRoute('set');
                    r.modelName = 'news'
                    r.setParams({
                        field: 'evidenza',
                        value: st,
                        id: that.conf.pk,
                    })
                    cs.Server.route(r, function (json) {
                        console.debug('json', json)
                        if (json.error) {
                            cs.CrudCore.alertError(json.msg);
                            return;
                        }
                        that.view.reload();
                    })

                }
            },


            'attivo': {
                type: "w-swap",
                modelName: 'news',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },

        },
        orderFields: {
            'data': 'data',
            'titolo_it': 'titolo_it',
            'evidenza': 'evidenza',
            'attivo': 'attivo',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'news',
        actions: ['action-save', 'action-back'],
        fields: [
            'data',
            'titolo_it',
            'sottotitolo_it',
            'evidenza',
            'attivo',
            'sezioni',
            'fotos',
            'attachments',

        ],
        fieldsConfig: {
            'data': {
                type: "w-input",
                inputType: 'date',
            },
            'titolo_it': {
                type: "w-input",
            },
            'sottotitolo_it': {
                type: "w-input",
            },
            'evidenza': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'attivo': {
                type: "w-select",
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
                            modelName : 'news',
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
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Foto e allegati',
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
                            modelName : 'news',
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
            sezioni : {
                label: '',
                type :'w-hasmany',
                divider: 'before',
                dividerClass: 'text-primary-700 my-5',
                dividerContentClass: 'font-bold border-1 p-2',
                dividerContent: 'Le sezioni della news',
                hasmanyConf : {
                    // name : 'sezioni',
                    // modelName: 'sezione_contenuto',
                    langContext : 'sezione_contenuto.fields',
                    fields : [
                        'id','nome_it','contenuto_it','status'
                    ],
                    fieldsConfig : {
                        "contenuto_it" : {
                            type : 'w-texthtml',
                            layout : {
                                colClass : 'w-12',
                            }
                        },
                        status : 'w-hidden',
                        id : 'w-hidden',
                    }
                },
                layout : {
                    colClass : 'w-12',
                }
            },
        }

    },
}
