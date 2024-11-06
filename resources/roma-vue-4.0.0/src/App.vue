<script setup>
import { onMounted } from 'vue';
import { useRouter } from 'vue-router'
import cs from 'cupparis-primevue'
const Wait = cs.Wait;
onMounted(() => {
  let router = useRouter();
  if ((import.meta.env.VITE_MODE == 'dev') && (!window.localStorage.getItem('token'))){
    router.push('/auth/login')
  }
});
</script>
<template>
    <Wait></Wait>
    <router-view :key="$route.fullPath"/>
    <Toast position="top-right" group="tr" />
    <ConfirmDialog ref="confirmDialog"></ConfirmDialog>
</template>
