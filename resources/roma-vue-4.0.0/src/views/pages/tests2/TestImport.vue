<template>
    <div class="grid">
        <div class="col-12">
            <c-import :conf="importConf" v-if="!reload">
                <!-- <template #title>
                    diao
                </template> -->
                <!-- <template #description>
                    aaa
                </template> -->
            </c-import>
        </div>
        <div class="col-12">
            <Button class="p-button w-4 mt-1" label="Run" @click="updateCode"></Button>
            <hr />
            <div class="grid">
                <div class="col-6">
                    <h6>Configurazione View {{ wSelected }}</h6>
                    <div class="font-italic">Iniziare il codice sempre con var conf = </div>
                    <div id='example' class="h-20rem w-full">

                    </div>
                </div>
                <div class="col-6">
                    <h6>Configurazione di default {{ viewType }}</h6>
                    <div id="defaultCode" class="h-20rem w-full">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DCupGeoComune from './DCupGeoComune.js';
import cupparisPrimevue from "cupparis-primevue";
const cImport = cupparisPrimevue.cImport;
import JsToCode from "@/service/JsToCode";
const jsc = new JsToCode();

export default {
  name: "TestImport",
    components: {cImport},
    mounted() {
        let that = this;
        setTimeout(function() {
            jsc.loadVisLib(function () {
                console.debug('OK',document.getElementById('example'));
                that.dynamicCode =  jsc.getSourceCode(that.importConf);
                that.editor = ace.edit("example", {
                    theme: "ace/theme/textmate",
                    mode: "ace/mode/javascript",
                    value: 'var conf = ' + that.dynamicCode,
                });
                that.editorDefault = ace.edit("defaultCode", {
                    theme: "ace/theme/textmate",
                    mode: "ace/mode/javascript",
                    value: 'var conf = {}',
                });
            })
        },200)

    },
    data() {
      console.log('configuration',DCupGeoComune)
      return {
          importConf : DCupGeoComune,
          dynamicCode : '',
          editor : null,
          editorDefault : null,
          reload : false,
      }
    },
    methods : {
        updateCode() {
            let that = this;
            let s = that.editor.getValue();
            let fName = jsc.updateCode(s);
            that.reload = true;
            setTimeout(function () {
                try {
                    that.importConf = window[fName]();
                    that.reload = false;
                } catch(e) {
                    that.errorDialog(e);
                    throw e;
                }

            },20)
        }
    }
}
</script>

<style scoped>

</style>
