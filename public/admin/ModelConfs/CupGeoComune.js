var ModelCupGeoComune = {
    modelName : 'cup_geo_comune',
    search : {
        modelName : 'cup_geo_comune',
        fields : ['nome_it','provincia_id'],
        fieldsConfig : {
            'nome_it' : {

            },
            'provincia_id' : 'w-select',
            //codice : 'w-hidden'
        }
    },
    list: {
        modelName : 'cup_geo_comune',
        actions : [
            'action-insert',
            'action-edit',
            'action-delete',
            'action-delete-selected',
            'action-export-csv',
        ],
        actionsConfig : {
            'action-export-csv' : {
                text: 'Csv',
            }
        },

        fields: [
            'id',
            'codice_istat',
            'nome_it',
            'codice_catastale',
            'capoluogo',
            'provincia',
            'provinciasigla',
            'cap',
            'prefisso',
            'attivo',

        ],
        fieldsConfig: {
            'capoluogo' : {
                type : 'w-swap',
                modelName : 'cup_geo_comune',
            },
            'attivo' : {
                type : 'w-swap',
                modelName : 'cup_geo_comune',
            },
            'provincia' : {
                type : "w-belongsto",
                labelFields : [
                    'nome_it',
                ],
            },
            'provinciasigla' : {
                type : "w-custom",
                mounted : function() {
                    var that = this;
                    if (that.modelData)
                        that.value = that.modelData.provincia.sigla;
                    // setTimeout(function () {
                    //     console.log('modelData',that.modelData);
                    //     that.value = that.modelData.provincia.sigla;
                    // },400)

                }
            },

        },
        orderFields : {
            'nome_it' : 'nome_it',
            'codice_istat' : 'codice_istat',
            'codice_catastale' : 'codice_catastale',
        }

    },
    edit: {
        modelName : 'cup_geo_comune',
        fields: [
            'nome_it',
            'codice_istat',
            'codice_catastale',
            'provincia_id',
            'capoluogo',
            'nazione_id',
            'cap',
            'prefisso',
            'mappa'
        ],
        fieldsConfig: {
            mappa : {
                template : 'tpl-full-no',
                type : 'w-map',
                //latName : 'lat',
                //lngName : 'lng',
            },
            'capoluogo' : {
                type : "w-radio",
            },

            'provincia_id' : {
                type : "w-select",
            },

            'nazione_id' : {
                type : "w-select",
            },


        }

    },
}
