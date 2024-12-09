import cs from "cupparis-primevue";
import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";

export default {
    modelName: 'video',
    search: {
        type: 'v-search',
        modelName: 'video',
        fields: [
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
        modelName: 'video',
        actions: [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
        ],
        fields: [
            'picture',
            'titolo_it',
            'autore',
            'categoria',
            'video_id',
            'ordine',
            'homepage',
            'attivo',

        ],
        fieldsConfig: {

            'picture': {
                type: "w-custom",
                ready() {
                    var that = this;
                    var url = "https://img.youtube.com/vi/"+that.modelData.video_id+"/0.jpg";


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
            'titolo_it': {
                type: "w-text",
            },
            'video_id': {
                type: "w-text",
            },
            'categoria': {
                type: "w-belongsto",
                labelFields: [
                    "nome_it",
                ],
            },


            ordine: {
                type: 'w-select',
                modelName: 'video',
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
                    r.modelName = 'video'
                    r.setParams({
                        field: 'ordine',
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
                modelName: 'video',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },
            'homepage': {
                type: "w-swap",
                modelName: 'video',
                //switchClass: 'form-switch-danger banned',
                //dataSwitched : true,
            },


        },
        orderFields: {
            'titolo_it': 'titolo_it',
            'video_id': 'video_id',
            'attivo': 'attivo',
            'ordine': 'ordine',
            'homepage': 'homepage',

        }

    },
    edit: {
        type: 'v-edit',
        modelName: 'video',
        actions: ['action-save', 'action-back'],
        fields: [
            'titolo_it',
            'descrizione_it',
            'autore',
            'materia_id',
            'video_id',
            'attivo',
            'ordine',
            'homepage',

        ],
        fieldsConfig: {
            'attivo': {
                type: "w-radio",
            },
            'homepage': {
                type: "w-radio",
            },
            'titolo_it': {
                type: "w-input",
                layout: {
                    colClass: 'w-12',
                }
            },
            'ordine': {
                type: "w-select",
            },
            'materia_id': {
                type: "w-select",
                //domainValues : [],
                //domainValuesOrder : [],
            },
            'descrizione_it': {
                type: 'w-texthtml',
                layout: {
                    colClass: 'w-12',
                }

            }

        }

    },
}
