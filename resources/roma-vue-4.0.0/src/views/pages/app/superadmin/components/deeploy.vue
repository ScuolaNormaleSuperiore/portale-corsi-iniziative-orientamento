<template>
    <Card>
        <template #content>
            <AppConfigFlat
                :layoutMode="layoutMode"
                @layout-change="onLayoutChange"
                :lightMenu="lightMenu"
                @menu-color-change="onMenuColorChange"
                :inlineUser="inlineUser"
                @profile-mode-change="onProfileModeChange"
                :isRTL="isRTL"
                @orientation-change="onChangeOrientation"
                :topbarColor="topbarColor"
                :topbarColors="topbarColors"
                @topbar-color-change="onTopbarColorChange"
                :theme="theme"
                :themes="themeColors"
                @theme-change="onThemeChange"
            ></AppConfigFlat>
            <h4>
                Deploy applicazione
            </h4>
            <div class="flex gap-2">
                <Button label="Publish" @click="publish"></Button>
                <Button label="Aggiorna traduzioni" @click="translate"></Button>
                <Button label="Aggiorna importazioni" @click="generateImport"></Button>
                <Button label="Aggiorna Templates" @click="generateTemplates"></Button>
                <Button label="Test Spawn" @click="testSpawn"></Button>
                <Button label="Test Exec" @click="testExec"></Button>
                <label class="flex-grow-1 text-right p-1 pt-3 mr-2">WebSocket Server</label>
                <div v-if="serverStatus" class="blob green"></div>
                <div v-else class="fa fa-circle text-red-500 text-2xl m-2"></div>
            </div>

            <div class="w-full overflow-auto h-30rem min-h-30rem">
                <pre>
                    {{bufferOut}}
                </pre>
                <pre class="text-red-500">
                    {{bufferErr}}
                </pre>
            </div>
        </template>

    </Card>
</template>

<script>
import cs from 'cupparis-primevue'
import Utility from "@/service/Utility.js";
import AppConfigFlat from "@/layout/AppConfigFlat.vue";
import templateConfig from '@/data/template-config.json';
import moment from "moment";

var connection = null;
export default {
    name: "DeployPage",
    components: {AppConfigFlat},
    mounted() {
        let that = this;
        cs.CrudCore.waitStart('connecting websocket...');
        Utility.connectToServer().then((ws) => {
            connection = ws;
            console.log('connection', connection)
            connection.onopen = function (event) {
                console.log('event on open', event)
                console.log('Successfully')
            }
            connection.onmessage = function (event) {
                console.log('onmessage', event.data);
                let json = JSON.parse(event.data);
                var str = "\n"+moment().format('HH:mm:ss') + "\n";
                switch (json.action) {
                    case 'stdout':
                        str += json.data.split("\r\n").reverse().join("\r\n");
                        that.bufferOut= str + that.bufferOut;
                        break;
                    case 'stderr':
                        str += json.data.split("\r\n").reverse().join("\r\n");
                        that.bufferErr= str + that.bufferErr;
                        break;
                    case 'error':
                        str += json.data.split("\r\n").reverse().join("\r\n");
                        // JSON.stringify(json,'','\t')
                        that.bufferErr =  str + that.bufferErr;
                        break;
                    default:
                        if (json.error) {
                            cs.CrudCore.alertError(json.msg);
                        } else {
                            if (json.resultCommand) {
                                cs.CrudCore.alertSuccess(json.resultCommand)
                            }
                        }
                        break;
                }
                that.serverStatus = json.number;
            }
            cs.CrudCore.waitEnd();
        }).catch((e) => {
            console.error(e);
            cs.CrudCore.alertError(e);
        })
    },
    unmounted() {
        if (connection) {
            connection.close();
            connection = null;
        }
    },
    data() {
        let dt =  Object.assign(templateConfig,{
            serverStatus : '',
            bufferOut : '',
            bufferErr : '',
        });
        console.debug('dt',dt);
        return dt;
    },
    methods : {
        testSpawn() {
            let json = {
                action : 'test-spawn',
            }
            connection.send(JSON.stringify(json));
        },
        generateTemplates() {
            let json = {
                action : 'genera-templates',
            }
            connection.send(JSON.stringify(json));
        },

        testExec() {
            let json = {
                action : 'test-exec',
            }
            connection.send(JSON.stringify(json));
        },
        generaTemplate() {
            //sass --update public/theme:public/theme
            let json = {
                action : 'generate-templates',
            }
            connection.send(JSON.stringify(json));
        },
        publish() {
            this.bufferErr = "";
            this.bufferOut = "";
            this._publish();
        },
        translate() {
            this.bufferErr = "";
            this.bufferOut = "";
            this._translate();
        },
        generateImport() {
            let json = {
                action : 'generate-import',
            }
            connection.send(JSON.stringify(json));
        },
        _publish() {
            let that = this;
            let json = {
                action : 'publish',
            }
            connection.send(JSON.stringify(json));
        },
        _translate() {
            let that = this;
            let json = {
                language: 'it',
                action : 'translate',
            }
            connection.send(JSON.stringify(json));
        },
        onLayoutChange(layoutMode) {
            this.layoutMode = layoutMode;
            this.staticMenuDesktopInactive = false;
            this.overlayMenuActive = false;

            if (this.isSlim() || this.isHorizontal()) {
                this.inlineUser = false;
                this.inlineUserMenuActive = false;
            }
            this.saveConfig();
        },
        onMenuColorChange(menuColor) {
            this.lightMenu = menuColor;
            this.saveConfig();
        },
        onProfileModeChange(profileMode) {
            this.inlineUser = profileMode;
            this.saveConfig();
        },
        onChangeOrientation(orientation) {
            this.isRTL = orientation;
            this.saveConfig();
        },
        onTopbarColorChange(topbarColor, logo) {
            this.topbarColor = topbarColor;
            const topbarLogoLink = document.getElementById('topbar-logo');
            topbarLogoLink.src = '/layout/images/' + logo + '.svg';
            this.saveConfig();
        },
        onThemeChange(theme) {
            this.theme = theme;
            this.changeStyleSheetUrl('layout-css', theme, 'layout');
            this.changeStyleSheetUrl('theme-css', theme, 'theme');
            this.saveConfig();
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
        isSlim() {
            return this.layoutMode === 'slim';
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
        saveConfig() {
            templateConfig.layoutMode = this.layoutMode;
            templateConfig.staticMenuDesktopInactive = this.staticMenuDesktopInactive;
            templateConfig.overlayMenuActive = this.overlayMenuActive;
            templateConfig.inlineUser = this.inlineUser;
            templateConfig.inlineUserMenuActive = this.inlineUserMenuActive;
            templateConfig.lightMenu = this.lightMenu;
            templateConfig.isRTL = this.isRTL;
            templateConfig.inlineUser = this.inlineUser;
            templateConfig.topbarMenuActive = this.topbarMenuActive;
            templateConfig.activeTopbarItem = this.activeTopbarItem;
            templateConfig.rightPanelMenuActive = this.rightPanelMenuActive;
            templateConfig.inlineUserMenuActive = this.inlineUserMenuActive;
            templateConfig.menuActive = this.menuActive;
            templateConfig.topbarColor = this.topbarColor;
            templateConfig.theme = this.theme;
            console.debug('TEMPLATECONFIG',templateConfig);
            let json = {
                action : 'save-config',
                data : templateConfig
            }
            connection.send(JSON.stringify(json));
            setTimeout(function () {
                document.location.reload();
            },200)
        }
    }
}




</script>

<style scoped>
.blob {
    background: black;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);
    margin: 10px;
    height: 20px;
    width: 20px;
    transform: scale(1);
    animation: pulse-black 2s infinite;
}
.blob.green {
    background: rgba(51, 217, 178, 1);
    box-shadow: 0 0 0 0 rgba(51, 217, 178, 1);
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(51, 217, 178, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0);
    }
}

</style>

