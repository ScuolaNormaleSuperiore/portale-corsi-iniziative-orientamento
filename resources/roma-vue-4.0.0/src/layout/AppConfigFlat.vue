<template>
    <div >


        <div class="layout-config-header">
            <h3>Theme Customization</h3>
            <span>Roma offers different themes for layout, topbar, menu etc.</span>
        </div>

        <div class="flex gap-3 flex-wrap">
            <div class="w-8rem">
                <h6 class="">Menu Mode</h6>
                <div class="">
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="static" name="layoutMode" value="static" v-model="d_layoutMode" @change="changeLayout($event, 'static')" />
                        <label for="static">Static</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="overlay" name="layoutMode" value="overlay" v-model="d_layoutMode" @change="changeLayout($event, 'overlay')" />
                        <label for="overlay">Overlay</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="horizontal" name="layoutMode" value="horizontal" v-model="d_layoutMode" @change="changeLayout($event, 'horizontal')" />
                        <label for="horizontal">Horizontal</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="slim" name="layoutMode" value="slim" v-model="d_layoutMode" @change="changeLayout($event, 'slim')" />
                        <label for="slim">Slim</label>
                    </div>
                </div>
            </div>

            <div class="w-8rem">
                <h6 class="">Menu Color</h6>
                <div class="">
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="dark" name="lightMenu" :value="false" v-model="d_lightMenu" @change="changeMenuColor($event, false)" />
                        <label for="dark">Dark</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="light" name="lightMenu" :value="true" v-model="d_lightMenu" @change="changeMenuColor($event, true)" />
                        <label for="light">Light</label>
                    </div>
                </div>
            </div>

            <div class="w-8rem">
                <h6 class="">User Profile</h6>
                <div class="formgroup-inline grid grid-nogutter">
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="inline" name="inlineUser" :disabled="layoutMode === 'horizontal'" :value="true" v-model="d_inlineUser" @change="changeProfileMode($event, true)" />
                        <label for="inline">Inline</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="overlayUser" name="inlineUser" :disabled="layoutMode === 'horizontal'" :value="false" v-model="d_inlineUser" @change="changeProfileMode($event, false)" />
                        <label for="overlayUser">Overlay</label>
                    </div>
                </div>
            </div>

            <div class="w-8rem">
                <h6 class="">Input Background</h6>
                <div class="formgroup-inline">
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="input_outlined" name="inputstyle" value="outlined" :modelValue="inputStyle" @update:modelValue="changeInputStyle" />
                        <label for="input_outlined">Outlined</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="input_filled" name="inputstyle" value="filled" :modelValue="inputStyle" @update:modelValue="changeInputStyle" />
                        <label for="input_filled">Filled</label>
                    </div>
                </div>
            </div>

            <div class="w-8rem">
                <span class="section-name">Ripple Effect</span>
                <InputSwitch :modelValue="rippleActive" @update:modelValue="changeRipple" />
            </div>

            <div class="w-8rem">
                <span class="section-name">Orientation</span>
                <div class="formgroup-inline grid grid-nogutter">
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="ltr" name="isRTL" :value="false" v-model="d_isRTL" @change="changeOrientation($event, false)" />
                        <label for="ltr">LTR</label>
                    </div>
                    <div class="field-radiobutton md:col-6">
                        <RadioButton id="rtl" name="isRTL" :value="true" v-model="d_isRTL" @change="changeOrientation($event, true)" />
                        <label for="rtl">RTL</label>
                    </div>
                </div>
            </div>

            <div class="w-8rem flex-grow-1">
                <h6 >Topbar Colors</h6>
                <div class="flex flex-wrap">
                    <div v-for="t of topbarColors" :key="t.name">
                        <a class="p-0 m-2 cursor-pointer" @click="changeTopbarColor($event, t.topbarColor, t.logo)" :title="t.name">
                            <i class="fa-solid fa-square fa-2x p-0" :style="{ color: t.color,border: getTopbarBorder(topbarColor,t)}"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-8rem flex-grow-1">
                <h6 >Component Themes</h6>
                <div class="flex flex-wrap">
                    <div v-for="t of themes" :key="t.name">
                        <a class="p-0 m-2 cursor-pointer" @click="changeTheme($event, t.file)" :title="t.name">
                            <i class="fa-solid fa-square fa-2x p-0" :style="{ color: t.color,border: getThemeBorder(theme,t)}"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['layout-change', 'menu-color-change', 'profile-mode-change', 'orientation-change', 'topbar-color-change', 'theme-change'],
    props: {
        layoutMode: {
            type: String,
            default: null,
        },
        lightMenu: {
            type: Boolean,
            default: null,
        },
        inlineUser: {
            type: Boolean,
            default: null,
        },
        isRTL: {
            type: Boolean,
            default: null,
        },
        topbarColor: {
            type: String,
            default: null,
        },
        topbarColors: {
            type: Array,
            default: null,
        },
        theme: {
            type: String,
            default: null,
        },
        themes: {
            type: Array,
            default: null,
        },
    },
    data() {
        console.debug('PRIME Themes',this.themes);
        return {
            active: false,
            d_layoutMode: this.layoutMode,
            d_lightMenu: this.lightMenu,
            d_inlineUser: this.inlineUser,
            d_isRTL: this.isRTL,
        };
    },
    watch: {
        $route() {
            if (this.active) {
                this.active = false;
                this.unbindOutsideClickListener();
            }
        },
        layoutMode(newValue) {
            this.d_layoutMode = newValue;
        },
        lightMenu(newValue) {
            this.d_lightMenu = newValue;
        },
        inlineUser(newValue) {
            this.d_inlineUser = newValue;
        },
        isRTL(newValue) {
            this.d_isRTL = newValue;
        },
    },
    outsideClickListener: null,
    methods: {
        getThemeBorder(theme,t) {

            if (theme === t.file) {
                console.debug('theme',theme,t.file)
                return '3px solid black'
            }
            return '';
            //return '2px solid ' + t.color;
        },
        getTopbarBorder(topbarColor,t) {

            if (topbarColor === t.topbarColor) {
                console.debug('getTopbarBorder',topbarColor,t.topbarColor)
                return '3px solid black'
            }
            return '';
            //return '2px solid ' + t.topbarColor;
        },
        toggleConfigurator(event) {
            this.active = !this.active;
            event.preventDefault();

            if (this.active) this.bindOutsideClickListener();
            else this.unbindOutsideClickListener();
        },
        hideConfigurator(event) {
            this.active = false;
            this.unbindOutsideClickListener();
            event.preventDefault();
        },
        changeInputStyle(value) {
            this.$primevue.config.inputStyle = value;
        },
        changeRipple(value) {
            this.$primevue.config.ripple = value;
        },
        changeLayout(event, layoutMode) {
            this.$emit('layout-change', layoutMode);
            event.preventDefault();
        },
        changeMenuColor(event, menuColor) {
            this.$emit('menu-color-change', menuColor);
            event.preventDefault();
        },
        changeProfileMode(event, profileMode) {
            this.$emit('profile-mode-change', profileMode);
            event.preventDefault();
        },
        changeOrientation(event, orientation) {
            this.$emit('orientation-change', orientation);
            event.preventDefault();
        },
        changeTopbarColor(event, topbarColor, logo) {
            this.$emit('topbar-color-change', topbarColor, logo);
            event.preventDefault();
        },
        changeTheme(event, theme) {
            this.$emit('theme-change', theme);
            event.preventDefault();
        },
        bindOutsideClickListener() {
            if (!this.outsideClickListener) {
                this.outsideClickListener = (event) => {
                    if (this.active && this.isOutsideClicked(event)) {
                        this.active = false;
                    }
                };
                document.addEventListener('click', this.outsideClickListener);
            }
        },
        unbindOutsideClickListener() {
            if (this.outsideClickListener) {
                document.removeEventListener('click', this.outsideClickListener);
                this.outsideClickListener = null;
            }
        },
        isOutsideClicked(event) {
            return !(this.$el.isSameNode(event.target) || this.$el.contains(event.target));
        },
    },
    computed: {
        containerClass() {
            return ['layout-config', { 'layout-config-active': this.active }];
        },
        rippleActive() {
            return this.$primevue.config.ripple;
        },
        inputStyle() {
            return this.$primevue.config.inputStyle;
        },
    },
};
</script>
