<template>
    <AppSubmenu class="layout-menu" :items="model" :layoutMode="layoutMode" :menuActive="active" :mobileMenuActive="mobileMenuActive" :root="true" :parentMenuItemActive="true" />
</template>

<script>
import AppSubmenu from './AppSubmenu.vue';

export default {
    props: {
        model: Array,
        layoutMode: String,
        active: Boolean,
        mobileMenuActive: Boolean,
    },
    components: {
        AppSubmenu: AppSubmenu,
    },
};
</script>

<style scoped></style>
