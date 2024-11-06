<template>
    <div class="" @click="onDocumentClick">
        <AppRightMenu :rightPanelMenuActive="rightPanelMenuActive" @rightmenu-click="onRightMenuClick"></AppRightMenu>

        <transition name="layout-menu-container">
            <div class="layout-menu-container" @click="onMenuClick" v-show="isMenuVisible()">
                <div class="menu-scroll-content">

                </div>
            </div>
        </transition>
        <div class="layout-main">
            <div class="layout-content">
                <router-view :key="$route.fullPath"/>
            </div>
        </div>
        <div class="layout-content-mask"></div>
    </div>
</template>
<script>
import AppTopBar from './AppTopbar.vue';
import AppRightMenu from './AppRightMenu.vue';
import AppMenu from './AppMenu.vue';
import AppFooter from './AppFooter.vue';
import EventBus from './event-bus';
import AppConfig from './AppConfig.vue';

export default {
    data() {
        return {
            layoutMode: 'slim',
            lightMenu: true,
            overlayMenuActive: false,
            staticMenuMobileActive: false,
            staticMenuDesktopInactive: false,
            isRTL: false,
            inlineUser: false,
            topbarMenuActive: false,
            activeTopbarItem: null,
            rightPanelMenuActive: null,
            inlineUserMenuActive: false,
            menuActive: false,
            topbarColor: 'layout-topbar-blue',
            topbarColors: [
                { name: 'Light', topbarColor: 'layout-topbar-light', logo: 'logo-roma', color: '#ffffff' },
                { name: 'Dark', topbarColor: 'layout-topbar-dark', logo: 'logo-roma-white', color: '#252529' },
                { name: 'Blue', topbarColor: 'layout-topbar-blue', logo: 'logo-roma-white', color: '#0772B3' },
                { name: 'Green', topbarColor: 'layout-topbar-green', logo: 'logo-roma-white', color: '#0F8C50' },
                { name: 'Orange', topbarColor: 'layout-topbar-orange', logo: 'logo-roma-white', color: '#C76D09' },
                {
                    name: 'Magenta',
                    topbarColor: 'layout-topbar-magenta',
                    logo: 'logo-roma-white',
                    color: '#972BB1',
                },
                {
                    name: 'Blue Grey',
                    topbarColor: 'layout-topbar-bluegrey',
                    logo: 'logo-roma-white',
                    color: '#406E7E',
                },
                {
                    name: 'Deep Purple',
                    topbarColor: 'layout-topbar-deeppurple',
                    logo: 'logo-roma-white',
                    color: '#543CD9',
                },
                { name: 'Brown', topbarColor: 'layout-topbar-brown', logo: 'logo-roma-white', color: '#794F36' },
                { name: 'Lime', topbarColor: 'layout-topbar-lime', logo: 'logo-roma-white', color: '#849201' },
                { name: 'Rose', topbarColor: 'layout-topbar-rose', logo: 'logo-roma-white', color: '#8F3939' },
                { name: 'Cyan', topbarColor: 'layout-topbar-cyan', logo: 'logo-roma-white', color: '#0C8990' },
                { name: 'Teal', topbarColor: 'layout-topbar-teal', logo: 'logo-roma-white', color: '#337E59' },
                {
                    name: 'Deep Orange',
                    topbarColor: 'layout-topbar-deeporange',
                    logo: 'logo-roma-white',
                    color: '#D74A1D',
                },
                { name: 'Indigo', topbarColor: 'layout-topbar-indigo', logo: 'logo-roma-white', color: '#3D53C9' },
                { name: 'Pink', topbarColor: 'layout-topbar-pink', logo: 'logo-roma-white', color: '#BF275B' },
                { name: 'Purple', topbarColor: 'layout-topbar-purple', logo: 'logo-roma-white', color: '#7F32DA' },
            ],
            theme: 'blue',
            themeColors: [
                { name: 'Blue', file: 'blue', color: '#0f97c7' },
                { name: 'Blue Grey', file: 'bluegrey', color: '#578697' },
                { name: 'Brown', file: 'brown', color: '#97664A' },
                { name: 'Cyan', file: 'cyan', color: '#1BA7AF' },
                { name: 'Deep Orange', file: 'deeporange', color: '#F96F43' },
                { name: 'Deep Purple', file: 'deeppurple', color: '#6952EC' },
                { name: 'Green', file: 'green', color: '#10B163' },
                { name: 'Teal', file: 'teal', color: '#4EA279' },
                { name: 'Indigo', file: 'indigo', color: '#435AD8' },
                { name: 'Lime', file: 'lime', color: '#A5B600' },
                { name: 'Magenta', file: 'magenta', color: '#B944D6' },
                { name: 'Orange', file: 'orange', color: '#E2841A' },
                { name: 'Pink', file: 'pink', color: '#E93A76' },
                { name: 'Purple', file: 'purple', color: '#9643F9' },
                { name: 'Rose', file: 'rose', color: '#AB5353' },
            ],
            menu: [
                {
                    label: 'Favorites',
                    icon: 'pi pi-fw pi-home',
                    items: [{ label: 'Dashboard', icon: 'pi pi-fw pi-home', to: '/' }],
                },
                { separator: true },
                {
                    label: 'UI Kit',
                    icon: 'pi pi-fw pi-star-fill',
                    items: [
                        { label: 'Form Layout', icon: 'pi pi-fw pi-id-card', to: '/formlayout' },
                        { label: 'Input', icon: 'pi pi-fw pi-check-square', to: '/input' },
                        { label: 'Float Label', icon: 'pi pi-fw pi-bookmark', to: '/floatlabel' },
                        { label: 'Invalid State', icon: 'pi pi-fw pi-exclamation-circle', to: 'invalidstate' },
                        { label: 'Button', icon: 'pi pi-fw pi-mobile', to: '/button', class: 'rotated-icon' },
                        { label: 'Table', icon: 'pi pi-fw pi-table', to: '/table' },
                        { label: 'List', icon: 'pi pi-fw pi-list', to: '/list' },
                        { label: 'Tree', icon: 'pi pi-fw pi-share-alt', to: '/tree' },
                        { label: 'Panel', icon: 'pi pi-fw pi-tablet', to: '/panel' },
                        { label: 'Overlay', icon: 'pi pi-fw pi-clone', to: '/overlay' },
                        { label: 'Media', icon: 'pi pi-fw pi-image', to: '/media' },
                        { label: 'Menu', icon: 'pi pi-fw pi-bars', to: '/menu' },
                        { label: 'Message', icon: 'pi pi-fw pi-comment', to: '/messages' },
                        { label: 'File', icon: 'pi pi-fw pi-file', to: '/file' },
                        { label: 'Chart', icon: 'pi pi-fw pi-chart-bar', to: '/chart' },
                        { label: 'Misc', icon: 'pi pi-fw pi-circle-off', to: '/misc' },
                    ],
                },
                { separator: true },
                {
                    label: 'Utilities',
                    icon: 'pi pi-fw pi-compass',
                    items: [
                        { label: 'PrimeIcons', icon: 'pi pi-fw pi-prime', to: '/icons' },
                        { label: 'PrimeFlex', icon: 'pi pi-fw pi-directions', url: 'https://www.primefaces.org/primeflex/', target: '_blank' },
                    ],
                },
                { separator: true },
                {
                    label: 'Prime Blocks',
                    icon: 'pi pi-prime',
                    items: [
                        { label: 'Free Blocks', icon: 'pi pi-fw pi-eye', to: '/blocks' },
                        { label: 'All Blocks', icon: 'pi pi-fw pi-globe', url: 'https://www.primefaces.org/primeblocks-vue', target: '_blank' },
                    ],
                },
                { separator: true },
                {
                    label: 'Pages',
                    icon: 'pi pi-fw pi-copy',
                    items: [
                        { label: 'Crud', icon: 'pi pi-fw pi-pencil', to: '/crud' },
                        { label: 'Calendar', icon: 'pi pi-fw pi-calendar-plus', to: '/calendar' },
                        { label: 'Timeline', icon: 'pi pi-fw pi-calendar', to: '/timeline' },
                        { label: 'Landing', icon: 'pi pi-fw pi-globe', url: 'pages/landing.html', target: '_blank' },
                        { label: 'Login', icon: 'pi pi-fw pi-sign-in', to: '/login' },
                        { label: 'Error', icon: 'pi pi-fw pi-exclamation-triangle', to: '/error' },
                        { label: '404', icon: 'pi pi-fw pi-times', to: '/notfound' },
                        { label: 'Access Denied', icon: 'pi pi-fw pi-ban', to: '/access' },
                        { label: 'Empty', icon: 'pi pi-fw pi-clone', to: '/empty' },
                    ],
                },
                { separator: true },
                {
                    label: 'Hierarchy',
                    icon: 'pi pi-fw pi-sitemap',
                    items: [
                        {
                            label: 'Submenu 1',
                            icon: 'pi pi-fw pi-sign-in',
                            items: [
                                {
                                    label: 'Submenu 1.1',
                                    icon: 'pi pi-fw pi-sign-in',
                                    items: [
                                        { label: 'Submenu 1.1.1', icon: 'pi pi-fw pi-sign-in' },
                                        { label: 'Submenu 1.1.2', icon: 'pi pi-fw pi-sign-in' },
                                        { label: 'Submenu 1.1.3', icon: 'pi pi-fw pi-sign-in' },
                                    ],
                                },
                                {
                                    label: 'Submenu 1.2',
                                    icon: 'pi pi-fw pi-sign-in',
                                    items: [{ label: 'Submenu 1.2.1', icon: 'pi pi-fw pi-sign-in' }],
                                },
                            ],
                        },
                        {
                            label: 'Submenu 2',
                            icon: 'pi pi-fw pi-sign-in',
                            items: [
                                {
                                    label: 'Submenu 2.1',
                                    icon: 'pi pi-fw pi-sign-in',
                                    items: [
                                        { label: 'Submenu 2.1.1', icon: 'pi pi-fw pi-sign-in' },
                                        { label: 'Submenu 2.1.2', icon: 'pi pi-fw pi-sign-in' },
                                    ],
                                },
                                {
                                    label: 'Submenu 2.2',
                                    icon: 'pi pi-fw pi-sign-in',
                                    items: [{ label: 'Submenu 2.2.1', icon: 'pi pi-fw pi-sign-in' }],
                                },
                            ],
                        },
                    ],
                },
                { separator: true },
                {
                    label: 'Start',
                    icon: 'pi pi-fw pi-download',
                    items: [
                        {
                            label: 'Buy Now',
                            icon: 'pi pi-fw pi-shopping-cart',
                            command: () => window.open('https://www.primefaces.org/store', '_blank'),
                        },
                        { label: 'Documentation', icon: 'pi pi-fw pi-file', to: '/documentation' },
                    ],
                },
            ],
        };
    },
    watch: {
        $route() {
            this.menuActive = false;
            this.$toast.removeAllGroups();
        },
    },
    methods: {
        onDocumentClick() {
            if (!this.topbarItemClick) {
                this.activeTopbarItem = null;
                this.topbarMenuActive = false;
            }

            if (!this.rightMenuClick) {
                this.rightPanelMenuActive = false;
            }

            if (!this.userMenuClick && this.isSlim() && !this.isMobile()) {
                this.inlineUserMenuActive = false;
            }

            if (!this.menuClick) {
                if (this.isHorizontal() || this.isSlim()) {
                    this.menuActive = false;
                }

                if (this.overlayMenuActive || this.staticMenuMobileActive) {
                    this.hideOverlayMenu();
                }

                EventBus.emit('reset-active-index');
                this.unblockBodyScroll();
            }

            if (this.userMenuClick) {
                this.menuActive = false;
                EventBus.emit('reset-active-index');
            }

            this.topbarItemClick = false;
            this.menuClick = false;
            this.rightMenuClick = false;
            this.userMenuClick = false;
        },
        onMenuButtonClick(event) {
            this.menuClick = true;
            this.topbarMenuActive = false;
            this.rightPanelMenuActive = false;

            if (this.layoutMode === 'overlay') {
                this.overlayMenuActive = !this.overlayMenuActive;
            }

            if (this.isDesktop()) this.staticMenuDesktopInactive = !this.staticMenuDesktopInactive;
            else {
                this.staticMenuMobileActive = !this.staticMenuMobileActive;
                if (this.staticMenuMobileActive) {
                    this.blockBodyScroll();
                } else {
                    this.unblockBodyScroll();
                }
            }

            event.preventDefault();
        },
        onTopbarMenuButtonClick(event) {
            this.topbarItemClick = true;
            this.topbarMenuActive = !this.topbarMenuActive;
            this.hideOverlayMenu();
            event.preventDefault();
        },
        onTopbarItemClick(event) {
            this.topbarItemClick = true;

            if (this.activeTopbarItem === event.item) this.activeTopbarItem = null;
            else this.activeTopbarItem = event.item;

            event.originalEvent.preventDefault();
        },
        onMenuClick() {
            this.menuClick = true;
        },
        onInlineUserClick() {
            this.userMenuClick = true;
            this.inlineUserMenuActive = !this.inlineUserMenuActive;
        },
        blockBodyScroll() {
            this.addClass(document.body, 'blocked-scroll');
        },
        unblockBodyScroll() {
            this.removeClass(document.body, 'blocked-scroll');
        },
        onRightMenuButtonClick(event) {
            this.rightMenuClick = true;
            this.rightPanelMenuActive = !this.rightPanelMenuActive;

            this.hideOverlayMenu();

            event.preventDefault();
        },
        onRightMenuClick() {
            this.rightMenuClick = true;
        },
        hideOverlayMenu() {
            this.overlayMenuActive = false;
            this.staticMenuMobileActive = false;
        },
        onMenuItemClick(event) {
            if (!event.item.items) {
                EventBus.emit('reset-active-index');
                this.hideOverlayMenu();
            }
            if (!event.item.items && (this.isHorizontal() || this.isSlim())) {
                this.menuActive = false;
            }
        },
        onRootMenuItemClick() {
            this.menuActive = !this.menuActive;
        },
        isTablet() {
            let width = window.innerWidth;
            return width <= 1024 && width > 640;
        },
        isDesktop() {
            return window.innerWidth > 896;
        },
        isMobile() {
            return window.innerWidth <= 1025;
        },
        isHorizontal() {
            return this.layoutMode === 'horizontal';
        },
        isSlim() {
            return this.layoutMode === 'slim';
        },
        isMenuVisible() {
            if (this.isDesktop()) {
                if (this.layoutMode === 'static') return !this.staticMenuDesktopInactive;
                else if (this.layoutMode === 'overlay') return this.overlayMenuActive;
                else return true;
            } else {
                return true;
            }
        },
        onLayoutChange(layoutMode) {
            this.layoutMode = layoutMode;
            this.staticMenuDesktopInactive = false;
            this.overlayMenuActive = false;

            if (this.isSlim() || this.isHorizontal()) {
                this.inlineUser = false;
                this.inlineUserMenuActive = false;
            }
        },
        onMenuColorChange(menuColor) {
            this.lightMenu = menuColor;
        },
        onProfileModeChange(profileMode) {
            this.inlineUser = profileMode;
        },
        onChangeOrientation(orientation) {
            this.isRTL = orientation;
        },
        onTopbarColorChange(topbarColor, logo) {
            this.topbarColor = topbarColor;
            const topbarLogoLink = document.getElementById('topbar-logo');
            topbarLogoLink.src = '/layout/images/' + logo + '.svg';
        },
        onThemeChange(theme) {
            this.theme = theme;
            this.changeStyleSheetUrl('layout-css', theme, 'layout');
            this.changeStyleSheetUrl('theme-css', theme, 'theme');
        },
        changeStyleSheetUrl(id, value, prefix) {
            let element = document.getElementById(id);
            let urlTokens = element.getAttribute('href').split('/');
            urlTokens[urlTokens.length - 1] = prefix + '-' + value + '.css';
            let newURL = urlTokens.join('/');

            this.replaceLink(element, newURL);
        },
        replaceLink(linkElement, href) {
            const id = linkElement.getAttribute('id');
            const cloneLinkElement = linkElement.cloneNode(true);

            cloneLinkElement.setAttribute('href', href);
            cloneLinkElement.setAttribute('id', id + '-clone');

            linkElement.parentNode.insertBefore(cloneLinkElement, linkElement.nextSibling);

            cloneLinkElement.addEventListener('load', () => {
                linkElement.remove();
                cloneLinkElement.setAttribute('id', id);
            });
        },
        addClass(element, className) {
            if (element.classList) element.classList.add(className);
            else element.className += ' ' + className;
        },
        removeClass(element, className) {
            if (element.classList) element.classList.remove(className);
            else element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        },
    },
    computed: {
        containerClass() {
            return [
                'layout-wrapper',
                {
                    'layout-horizontal': this.layoutMode === 'horizontal',
                    'layout-overlay': this.layoutMode === 'overlay',
                    'layout-static': this.layoutMode === 'static',
                    'layout-slim': this.layoutMode === 'slim',
                    'layout-menu-light': this.lightMenu === true,
                    'layout-menu-dark': this.lightMenu === false,
                    'layout-overlay-active': this.overlayMenuActive,
                    'layout-mobile-active': this.staticMenuMobileActive,
                    'layout-static-inactive': this.staticMenuDesktopInactive,
                    'layout-rtl': this.isRTL,
                    'p-input-filled': this.$primevue.config.inputStyle === 'filled',
                    'p-ripple-disabled': this.$primevue.config.ripple === false,
                },
                this.topbarColor,
            ];
        },
    },
    components: {
        AppTopBar: AppTopBar,
        AppRightMenu: AppRightMenu,
        AppMenu: AppMenu,
        AppConfig: AppConfig,
        AppFooter: AppFooter,
    },
};
</script>
