import axios from "axios";
//import mitt from 'mitt'
import VueAxios from 'vue-axios'
import jQuery from 'jquery'
//import ModelConfs from "../ModelConfs";
import ModelConfs from '@/data/modelsConfs/app/'
import appLang from './it-translations.json';
import cupparisPrimevue from 'cupparis-primevue';
import router from "../router";

import PrimeVue from 'primevue/config';
import AutoComplete from 'primevue/autocomplete';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Avatar from 'primevue/avatar';
import AvatarGroup from 'primevue/avatargroup';
import Badge from 'primevue/badge';
import BadgeDirective from 'primevue/badgedirective';
import Button from 'primevue/button';
import Breadcrumb from 'primevue/breadcrumb';
import Calendar from 'primevue/calendar';
import Card from 'primevue/card';
import Carousel from 'primevue/carousel';
import Chart from 'primevue/chart';
import Checkbox from 'primevue/checkbox';
import Chip from 'primevue/chip';
import Chips from 'primevue/chips';
import ColorPicker from 'primevue/colorpicker';
import Column from 'primevue/column';
import ConfirmDialog from 'primevue/confirmdialog';
import ConfirmPopup from 'primevue/confirmpopup';
import ConfirmationService from 'primevue/confirmationservice';
import ContextMenu from 'primevue/contextmenu';
import DataTable from 'primevue/datatable';
import DataView from 'primevue/dataview';
import DataViewLayoutOptions from 'primevue/dataviewlayoutoptions';
import Dialog from 'primevue/dialog';
import Divider from 'primevue/divider';
import Dropdown from 'primevue/dropdown';
import Editor from'primevue/editor';
import Fieldset from 'primevue/fieldset';
import FileUpload from 'primevue/fileupload';
import Galleria from 'primevue/galleria';
import Image from 'primevue/image';
import InlineMessage from 'primevue/inlinemessage';
import Inplace from 'primevue/inplace';
import InputMask from 'primevue/inputmask';
import InputNumber from 'primevue/inputnumber';
import InputSwitch from 'primevue/inputswitch';
import InputText from 'primevue/inputtext';
import Knob from 'primevue/knob';
import Listbox from 'primevue/listbox';
import MegaMenu from 'primevue/megamenu';
import Menu from 'primevue/menu';
import Menubar from 'primevue/menubar';
import Message from 'primevue/message';
import MultiSelect from 'primevue/multiselect';
import OrderList from 'primevue/orderlist';
import OrganizationChart from 'primevue/organizationchart';
import OverlayPanel from 'primevue/overlaypanel';
import Paginator from 'primevue/paginator';
import Panel from 'primevue/panel';
import PanelMenu from 'primevue/panelmenu';
import Password from 'primevue/password';
import PickList from 'primevue/picklist';
import ProgressBar from 'primevue/progressbar';
import Rating from 'primevue/rating';
import RadioButton from 'primevue/radiobutton';
import Ripple from 'primevue/ripple';
import SelectButton from 'primevue/selectbutton';
import ScrollPanel from 'primevue/scrollpanel';
import ScrollTop from 'primevue/scrolltop';
import Slider from 'primevue/slider';
import Sidebar from 'primevue/sidebar';
import Skeleton from 'primevue/skeleton';
import SpeedDial from 'primevue/speeddial';
import SplitButton from 'primevue/splitbutton';
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import Steps from 'primevue/steps';
import StyleClass from 'primevue/styleclass';
import TabMenu from 'primevue/tabmenu';
import Tag from 'primevue/tag';
import TieredMenu from 'primevue/tieredmenu';
import Textarea from 'primevue/textarea';
import Timeline from 'primevue/timeline';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Toolbar from 'primevue/toolbar';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Tooltip from 'primevue/tooltip';
import ToggleButton from 'primevue/togglebutton';
import Tree from 'primevue/tree';
import TreeSelect from 'primevue/treeselect';
import TreeTable from 'primevue/treetable';
import TriStateCheckbox from 'primevue/tristatecheckbox';

import CodeHighlight from '@/components/AppCodeHighlight';
import BlockViewer from '@/components/BlockViewer.vue';

import '@/assets/styles.scss';

import RoutesConfs from "./RoutesConfs";
import crudVars from "cupparis-primevue/src/lib/CrudVars";

export default {
    install(app) {
        let that = this;
        return new Promise(function(resolve, reject) {
            // do a thing, possibly async, then…
            try {
                cupparisPrimevue.CrudVars.lang = Object.assign(cupparisPrimevue.CrudVars.lang, appLang);
                cupparisPrimevue.CrudVars.useApi = import.meta.env.VITE_APP_USE_API?true:false;
                app.provide('store', cupparisPrimevue.CrudVars)
                app.config.globalProperties.$app = app;
                app.use(VueAxios, axios);

// --- configurazioni iniziali ----
                ModelConfs.install(app);
                //crudSakai.install(app);
                RoutesConfs.install(app);
                //ViewConfs.install();

                console.log('appLang', appLang);

                window.app = app;
                window.$ = jQuery;
                window.jQuery = jQuery;

                crudVars.viewConfs.listView.recordActionsPosition = 'left';
                axios.get(import.meta.env.VITE_APP_DINAMIC_CONF,{}).then((response) => {
                    console.log('response', response);
                    that.setEnv(response.data.result);
                    resolve("Stuff worked!");
                }).catch((error) => {
                    console.log('error', error);
                    resolve("Stuff worked!");
                })
            } catch (e) {
                console.error(e);
                reject(Error("It broke"));
            }
        });
    },

    setEnv(env) {
        // for (let k in env) {
        //     crudSakai.crudVars.env[k] = env[k];
        // }
        for (let k in env) {
            cupparisPrimevue.CrudVars.env[k] = env[k];
        }
    },

    sakaiInit(app) {
        cupparisPrimevue.CrudCore.useItems = Object.assign(cupparisPrimevue.CrudCore.useItems,{
            'PrimeVue' : {
                obj : PrimeVue,
                param : { ripple: true, inputStyle: 'outlined' }
            },
            'ConfirmationService' : {
                obj : ConfirmationService,
                param : null
            },
            // 'DialogService': {
            //     obj : DialogService,
            // },
            'ToastService' : {
                obj : ToastService,
                param : null,
            },
            'router' : {
                obj : router,
                param : null,
            },
        });

        cupparisPrimevue.CrudCore.directiveItems = Object.assign(cupparisPrimevue.CrudCore.directiveItems,{
            'tooltip': Tooltip,
            'ripple' :  Ripple,
            //'code' :  CodeHighlight,
            'badge' :  BadgeDirective,
            'styleclass' :  StyleClass,
        });

        cupparisPrimevue.CrudCore.componentItems = Object.assign(cupparisPrimevue.CrudCore.componentItems,{
            'CodeHighlight' : CodeHighlight,
            'BlockViewer' : BlockViewer,

            'Accordion' : Accordion,
            'AccordionTab' : AccordionTab,
            'AutoComplete' : AutoComplete,
            'Avatar' : Avatar,
            'AvatarGroup' : AvatarGroup,
            'Badge' : Badge,
            //'BlockUI' : BlockUI,
            'Breadcrumb' : Breadcrumb,
            'Button' : Button,
            'Calendar' : Calendar,
            'Card' : Card,
            'Chart' : Chart,
            'Carousel' : Carousel,
            //'CascadeSelect' : CascadeSelect,
            'Checkbox' : Checkbox,
            'Chip' : Chip,
            'Chips' : Chips,
            'ColorPicker' : ColorPicker,
            'Column' : Column,
            //'ColumnGroup' : ColumnGroup,
            'ConfirmDialog' : ConfirmDialog,
            'ConfirmPopup' : ConfirmPopup,
            'ContextMenu' : ContextMenu,
            'DataTable' : DataTable,
            'DataView' : DataView,
            'DataViewLayoutOptions' : DataViewLayoutOptions,
            //'DeferredContent' : DeferredContent,
            'Dialog' : Dialog,
            'Divider' : Divider,
            //'Dock' : Dock,
            'Dropdown' : Dropdown,
            //'DynamicDialog' : DynamicDialog,
            'Editor' : Editor,
            'Fieldset' : Fieldset,
            'FileUpload' : FileUpload,
            'Galleria' : Galleria,
            'Image' : Image,
            'InlineMessage' : InlineMessage,
            'Inplace' : Inplace,
            'InputMask' : InputMask,
            'InputNumber' : InputNumber,
            'InputSwitch' : InputSwitch,
            'InputText' : InputText,
            'Knob' : Knob,
            'Listbox' : Listbox,
            'MegaMenu' : MegaMenu,
            'Menu' : Menu,
            'Menubar' : Menubar,
            'Message' : Message,
            'MultiSelect' : MultiSelect,
            'OrderList' : OrderList,
            'OrganizationChart' : OrganizationChart,
            'OverlayPanel' : OverlayPanel,
            'Paginator' : Paginator,
            'Panel' : Panel,
            'PanelMenu' : PanelMenu,
            'Password' : Password,
            'PickList' : PickList,
            'ProgressBar' : ProgressBar,
            //'ProgressSpinner' : ProgressSpinner,
            'RadioButton' : RadioButton,
            'Rating' : Rating,
            //'Row' : Row,
            'SelectButton' : SelectButton,
            'ScrollPanel' : ScrollPanel,
            'ScrollTop' : ScrollTop,
            'Slider' : Slider,
            'Sidebar' : Sidebar,
            'Skeleton' : Skeleton,
            'SpeedDial' : SpeedDial,
            'SplitButton' : SplitButton,
            'Splitter' : Splitter,
            'SplitterPanel' : SplitterPanel,
            'Steps' : Steps,
            'TabMenu' : TabMenu,
            'TabView' : TabView,
            'TabPanel' : TabPanel,
            'Tag' : Tag,
            'Textarea' : Textarea,
            //'Terminal' : Terminal,
            'TieredMenu' : TieredMenu,
            'Timeline' : Timeline,
            'Toast' : Toast,
            'Toolbar' : Toolbar,
            'ToggleButton' : ToggleButton,
            'Tree' : Tree,
            'TreeSelect' : TreeSelect,
            'TreeTable' : TreeTable,
            'TriStateCheckbox' : TriStateCheckbox,
            //'VirtualScroller' : VirtualScroller,
        });

        app.config.globalProperties.$toast = ToastService;
        cupparisPrimevue.CrudCore.setupApp(app);
    },
    loadMenu() {
        let that = this;
        return new Promise(function(resolve, reject) {
            cupparisPrimevue.Server.get(import.meta.env.VITE_API_MENU,{},function(response) {
                if (response.error) {
                    that.setEnv({appMenu : []});
                    resolve(response.msg);
                    return ;
                }
                that.setEnv({appMenu : response});
                resolve("Stuff worked!");
            })
        })
    },
}
