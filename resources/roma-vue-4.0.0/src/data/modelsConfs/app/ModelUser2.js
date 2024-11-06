export default {
    modelName : 'user',
    list : {
        type : 'v-list',
        modelName : 'user',
        fields: ['email'],
    },
    edit : {
       type : 'v-edit',
        modelName : 'user',
        fields: ['email'],
    },
    search : {
       type : 'v-search',
        searchType : 'basic',
        modelName : 'user',
        fields: ['email'],
    },
}









