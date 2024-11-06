import crudSakai from 'crud-vue-sakai'
export default {
    install() {
        let store = crudSakai.crudVars;
        store.conf['v-list'].fieldsConfig = {
            id : {
                type : 'w-input',
                inputType : 'hidden'
            }
        }
    }
}
