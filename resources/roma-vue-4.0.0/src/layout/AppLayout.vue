<template>
    <div :class="containerClass" @click="onDocumentClick">
        <AppTopBar
            :topbarMenuActive="topbarMenuActive"
            :activeTopbarItem="activeTopbarItem"
            :inlineUser="inlineUser"
            :orizzontal-menu="layoutMode==='horizontal'"
            @right-menubutton-click="onRightMenuButtonClick"
            @menubutton-click="onMenuButtonClick"
            @topbar-menubutton-click="onTopbarMenuButtonClick"
            @topbar-item-click="onTopbarItemClick"
        ></AppTopBar>

        <AppRightMenu :rightPanelMenuActive="rightPanelMenuActive" @rightmenu-click="onRightMenuClick"></AppRightMenu>

        <transition name="layout-menu-container">
            <div class="layout-menu-container" @click="onMenuClick" v-show="isMenuVisible()">
                <div class="menu-scroll-content">
                    <div class="layout-profile" v-if="inlineUser">
                        <button class="p-link layout-profile-button" @click="onInlineUserClick">
                            <img src="/layout/images/avatar.png" alt="roma-layout" />
                            <span class="layout-profile-userinfo">
                                <span class="layout-profile-name">Arlene Welch</span>
                                <span class="layout-profile-role">Design Ops</span>
                            </span>
                        </button>
                        <transition name="layout-profile-menu">
                            <ul :class="['layout-profile-menu', { 'profile-menu-active': inlineUserMenuActive }]" v-show="inlineUserMenuActive">
                                <li>
                                    <button class="p-link"><i class="pi pi-fw pi-user"></i><span>Profile</span></button>
                                </li>
                                <li>
                                    <button class="p-link"><i class="pi pi-fw pi-cog"></i><span>Settings</span></button>
                                </li>
                                <li>
                                    <button class="p-link"><i class="pi pi-fw pi-envelope"></i><span>Messages</span></button>
                                </li>
                                <li>
                                    <button class="p-link"><i class="pi pi-fw pi-bell"></i><span>Notifications</span></button>
                                </li>
                            </ul>
                        </transition>
                    </div>
                    <AppMenu :model="menu" :layoutMode="layoutMode" :active="menuActive" :mobileMenuActive="staticMenuMobileActive" @menuitem-click="onMenuItemClick" @root-menuitem-click="onRootMenuItemClick"></AppMenu>
                </div>
            </div>
        </transition>

        <div class="layout-main">
            <div class="layout-content">
                <router-view :key="$route.fullPath"/>
            </div>

<!--            <AppConfig-->
<!--                :layoutMode="layoutMode"-->
<!--                @layout-change="onLayoutChange"-->
<!--                :lightMenu="lightMenu"-->
<!--                @menu-color-change="onMenuColorChange"-->
<!--                :inlineUser="inlineUser"-->
<!--                @profile-mode-change="onProfileModeChange"-->
<!--                :isRTL="isRTL"-->
<!--                @orientation-change="onChangeOrientation"-->
<!--                :topbarColor="topbarColor"-->
<!--                :topbarColors="topbarColors"-->
<!--                @topbar-color-change="onTopbarColorChange"-->
<!--                :theme="theme"-->
<!--                :themes="themeColors"-->
<!--                @theme-change="onThemeChange"-->
<!--            ></AppConfig>-->

            <AppFooter />
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
import cs from 'cupparis-primevue';
import templateConfig from '@/data/template-config.json';
import Utility from "../service/Utility";

export default {
  mounted() {
      console.debug('theme',this.theme)
      this.changeStyleSheetUrl('layout-css', this.theme, 'layout');
      this.changeStyleSheetUrl('theme-css', this.theme, 'theme');
    console.debug('menu',this.menu);
  },
  data() {

    let suMenu = {
      label : 'Superadmin',
      icon : 'fa fa-gears',
      items :[
        {
          'label' : 'Ruoli',
          'icon' : 'fa fa-gear',
          'to' : '/admin/ruoli'
        },
        {
          'label' : 'Models Configuration',
          'icon': 'fa fa-gear',
          'to': '/admin/models-confs'
        },
        {
          'label': 'Deploy',
          'icon': 'fa fa-gear',
          'to': '/admin/deploy'
        },
      ]
    };
    let devMenu = {
      label: 'Tests2',
      icon : 'fa fa-gear',
      items:
          [
            {
              label: 'Manage Constraint', icon: 'pi pi-fw pi-home', to: '/test2-manage-constraint/1'
            },
            {
              label: 'Test2 Widgets', icon: 'pi pi-fw pi-home', to: '/test2-widgets'
            },
          {
              label: 'Test2 Actions', icon: 'fa-brands fa-artstation', to: '/test2-actions'
          },
            {
              label: 'Test2 Views', icon: 'pi pi-fw pi-home', to: '/test2-views'
            },
            // {
            //     label : 'Test Templates', icon : 'pi pi-fw pi-home', to: '/test-templates'
            // },
            {
              label: 'Test2 Manage', icon: 'pi pi-fw pi-home', to: '/test2-manage'
            },
            {
              label: 'Test2 Import', icon: 'pi pi-fw pi-home', to: '/test2-import'
            },
            {
              label: 'Test Dialogs', icon: 'pi pi-fw pi-home', to: '/test2-dialogs'
            },
            {
              label: 'Esperimenti', icon: 'pi pi-fw pi-home', to: '/test2-esperimenti'
            },
              {
                  label: 'Nuovi widgets', icon: 'pi pi-fw pi-home', to: '/nuovi-widgets'
              },
              {
                  label: 'Nuovi views', icon: 'pi pi-fw pi-home', to: '/nuove-views'
              },
          ]
    };
    let originalMenu = [
        { separator: true },
        { separator: true },
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
        ];
    let menu = [];
    console.debug('mode',import.meta.env.VITE_MODE)
    if (import.meta.env.VITE_MODE == 'dev') {
      menu.push(suMenu)
    }
    menu = menu.concat(cs.CrudVars.env.appMenu);

    if (import.meta.env.VITE_MODE == 'dev') {
      menu = menu.concat(devMenu);
      menu = menu.concat(originalMenu)
    }
    let dt = templateConfig;
    dt.menu = menu;
    console.debug('CONFIG Menu',dt)
    return dt;

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
        // saveConfig() {
        //     templateConfig.layoutMode = this.layoutMode;
        //     templateConfig.staticMenuDesktopInactive = this.staticMenuDesktopInactive;
        //     templateConfig.overlayMenuActive = this.overlayMenuActive;
        //     templateConfig.inlineUser = this.inlineUser;
        //     templateConfig.inlineUserMenuActive = this.inlineUserMenuActive;
        //     templateConfig.lightMenu = this.lightMenu;
        //     templateConfig.isRTL = this.isRTL;
        //     templateConfig.inlineUser = this.inlineUser;
        //     templateConfig.topbarMenuActive = this.topbarMenuActive;
        //     templateConfig.activeTopbarItem = this.activeTopbarItem;
        //     templateConfig.rightPanelMenuActive = this.rightPanelMenuActive;
        //     templateConfig.inlineUserMenuActive = this.inlineUserMenuActive;
        //     templateConfig.menuActive = this.menuActive;
        //     templateConfig.topbarColor = this.topbarColor;
        //     templateConfig.theme = this.theme;
        //     console.debug('TEMPLATECONFIG',templateConfig);
        //     Utility.connectToServer().then( (ws) => {
        //         let json = {
        //             action : 'save-config',
        //             data : templateConfig
        //         }
        //         ws.send(JSON.stringify(json));
        //     }).catch((e) => {
        //         console.error(e);
        //         cs.CrudCore.alertError(e);
        //     })
        // }
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
