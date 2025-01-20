<script setup>

import CrudHelpers from "cupparis-primevue/src/lib/CrudHelpers";
import Server from "cupparis-primevue/src/lib/Server";

import {onMounted, ref} from "vue";

import {useRoute} from 'vue-router';
import CrudCore from "cupparis-primevue/src/lib/CrudCore.js"
import {defineProps} from "vue";

const props = defineProps({
    url: String,
    label: String,
    cssClass: String,
    method: String,
})

const url = ref(props.url);
const label = ref(props.label);
const cssClass = ref(props.cssClass);
const method = ref(props.method);


function download(url, params, method) {

    if (method === 'post') {
        Server.post(url, params, function (json) {
            CrudCore.waitEnd()
            if (json.error) {
                CrudCore.errorDialog(json.msg)
                return
            }
            let filename = json.result['name'] ? json.result['name'] : 'file.pdf';
            CrudHelpers.createRuntimeDownload(json.result['content'], json.result['mime'], filename);
        })

    } else {

        Server.get(url, params, function (json) {
            CrudCore.waitEnd()
            if (json.error) {
                CrudCore.errorDialog(json.msg)
                return
            }
            let filename = json.result['name'] ? json.result['name'] : 'file.pdf';
            CrudHelpers.createRuntimeDownload(json.result['content'], json.result['mime'], filename);
        })
    }
}

</script>

<template>


    <div class="flex flex-wrap justify-content-start align-items-center gap-2">

        <Button severity="primary"

                icon="fa fa-download"
                :class="cssClass"
                @click="download(url,{},method)"
        >
        </Button>
        <div>
            {{ label }}
        </div>
    </div>

</template>

