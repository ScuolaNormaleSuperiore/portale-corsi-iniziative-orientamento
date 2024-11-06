export default {
    modelName : '[modelName]',
    list : {
        type : 'v-list',
        modelName : '[modelName]'
    },
    search : {
        type : 'v-search',
        modelName : '[modelName]'
    },
    edit : {
        type : 'v-edit',
        modelName : '[modelName]'
    },
    /* --- decommentare se serve avere una form new diversa dall'edit
    edit : {
        type : 'v-edit',
        modelName : '[modelName]'
    },
     */
    /* ---- decommentare se vogliamo la lista con edit inline
    listEdit : {
        type : 'v-list-edit',
        modelName: '[modelName]',
        fieldsConfigEditMode : {
            'id' : 'w-text',
            'email' : 'w-input',
            'banned' : 'w-text'
        },
        fieldsConfig : {
            'email' : 'w-text',
        }
    }
    */
}
