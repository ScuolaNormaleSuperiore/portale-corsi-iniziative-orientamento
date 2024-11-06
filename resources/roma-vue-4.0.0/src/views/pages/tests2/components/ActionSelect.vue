<template>
    <!-- <button class="p-button p-button-outlined" @click="_execute($event)"
        :title="translate(title)" :class="css + icon?'p-button-icon':''" :disabled="_disabled()">
        <i class="m-1" v-show="icon" :class="icon"></i>
        <span>{{ translate(text) }}</span>
    </button> -->
    <div>
        <Dropdown class="w-full" :name="name" v-model="value" :options="mapOptions()"
                option-label="label" option-value="id" :placeholder="placeholder || translate('app.seleziona')"
                v-bind="extraBind" @change="_change">
                <template #option="slotProps">
                    <div
                        :class="'select-button-option select-button-option-'+name+ ' select-button-option-'+name+'-'+slotProps.option.id"
                        v-html="slotProps.option.label">
                    </div>
                </template>
        </Dropdown>
    </div>
    
</template>

<script>

import cupparisPrimevue from "cupparis-primevue"
const aBase = cupparisPrimevue.aBase;
cupparisPrimevue.CrudVars.actionConfs.ActionSelect = {
    type : 'global',
    controlType : 'ActionSelect',
    text : 'prova',
    domainValues : {},
    domainValuesOrder : null,
    value : null,
    placeholder : '',
    execute() {
        this.alertInfo('valore selezionato ' + this.value,3000)
    }
}

export default {
    name: "ActionSelect",
    extends:aBase,
    // data() {
    //     console.debug('aaaa',this);
    //     this.conf.type = 'record';
    //     this.conf.controlType = 'ActionSelect'
    //     // this.conf.execute = () => {
    //     //     alert('pippo')
    //     // }
    //     return this.conf;
    // },
    methods : {
        execute() {
            alert('aooo')
        },
        mapOptions() {
            let options = [];
            if (this.domainValuesOrder) {
                for (let i in this.domainValuesOrder) {
                    let opt = {
                        id : this.domainValuesOrder[i],
                        label : this.domainValues[this.domainValuesOrder[i]],
                    }
                    options.push(opt);
                }
            } else {
                for (let k in this.domainValues) {
                    let opt = {
                        id : k,
                        label : this.domainValues[k],
                    }
                    options.push(opt);
                }
            }
            //console.log('options',options);
            return options;
        },
        _change() {
            this.execute();
        }
    }
}
</script>

<style scoped>

</style>
