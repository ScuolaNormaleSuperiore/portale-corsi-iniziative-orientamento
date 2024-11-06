<template>
    <ProgressSpinner />
</template>
<script>
import cupparis from 'cupparis-primevue'
import router from '@/router';

if (import.meta.env.VITE_MODE == 'dev') {
    
    cupparis.Server.post('/api/logout',{},function(json) {
        cupparis.CrudCore.setCache('token','');
        document.location.href='/';
    })
} else {
    document.location.href='/logout';
}
</script>