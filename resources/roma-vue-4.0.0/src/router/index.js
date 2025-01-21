import {createRouter, createWebHashHistory} from 'vue-router';
import AppLayout from '@/layout/AppLayout.vue';
import cs from 'cupparis-primevue'
import cupparisPrimevue from "cupparis-primevue";
import AppLogin from "../layout/AppLogin.vue";

const devChildren = [
    // {
    //     path: '/',
    //     component: AppLayout,
    //     children: [
    {
        path: '/',
        name: 'dashboard',
        exact: true,
        component: () => import('@/views/Dashboard.vue'),
    },
    {
        path: "/iniziativa/:iniziativaId",
        name: "iniziativa (view)",
        component: () => import('@/views/pages/app/Iniziativa.vue'),
    },
    {
        path: "/candidatov/:candidatoId",
        name: "candidato (view)",
        component: () => import('@/views/pages/app/Candidato.vue'),
    },
    {
        path: '/formlayout',
        name: 'formlayout',
        component: () => import('@/views/uikit/FormLayoutDemo.vue'),
    },
    {
        path: '/invalidstate',
        name: 'invalidstate',
        component: () => import('@/views/uikit/InvalidStateDemo.vue'),
    },
    {
        path: '/input',
        name: 'input',
        component: () => import('@/views/uikit/InputDemo.vue'),
    },
    {
        path: '/floatlabel',
        name: 'floatlabel',
        component: () => import('@/views/uikit/FloatLabelDemo.vue'),
    },
    {
        path: '/button',
        name: 'button',
        component: () => import('@/views/uikit/ButtonDemo.vue'),
    },
    {
        path: '/table',
        name: 'table',
        component: () => import('@/views/uikit/TableDemo.vue'),
    },
    {
        path: '/list',
        name: 'list',
        component: () => import('@/views/uikit/ListDemo.vue'),
    },
    {
        path: '/timeline',
        name: 'timeline',
        component: () => import('@/views/pages/TimelineDemo.vue'),
    },
    {
        path: '/tree',
        name: 'tree',
        component: () => import('@/views/uikit/TreeDemo.vue'),
    },
    {
        path: '/panel',
        name: 'panel',
        component: () => import('@/views/uikit/PanelsDemo.vue'),
    },
    {
        path: '/overlay',
        name: 'overlay',
        component: () => import('@/views/uikit/OverlayDemo.vue'),
    },
    {
        path: '/media',
        name: 'media',
        component: () => import('@/views/uikit/MediaDemo.vue'),
    },
    {
        path: '/menu',
        component: () => import('@/views/uikit/MenuDemo.vue'),
        children: [
            {
                path: '',
                component: () => import('@/views/uikit/menu/PersonalDemo.vue'),
            },
            {
                path: '/menu/seat',
                component: () => import('@/views/uikit/menu/SeatDemo.vue'),
            },
            {
                path: '/menu/payment',
                component: () => import('@/views/uikit/menu/PaymentDemo.vue'),
            },
            {
                path: '/menu/confirmation',
                component: () => import('@/views/uikit/menu/ConfirmationDemo.vue'),
            },
        ],
    },
    {
        path: '/messages',
        name: 'messages',
        component: () => import('@/views/uikit/MessagesDemo.vue'),
    },
    {
        path: '/file',
        name: 'file',
        component: () => import('@/views/uikit/FileDemo.vue'),
    },
    {
        path: '/chart',
        name: 'chart',
        component: () => import('@/views/uikit/ChartDemo.vue'),
    },
    {
        path: '/misc',
        name: 'misc',
        component: () => import('@/views/uikit/MiscDemo.vue'),
    },
    {
        path: '/icons',
        name: 'icons',
        component: () => import('@/views/utilities/Icons.vue'),
    },
    {
        path: '/crud',
        name: 'crud',
        component: () => import('@/views/pages/CrudDemo.vue'),
    },
    {
        path: '/calendar',
        name: 'calendar',
        component: () => import('@/views/pages/CalendarDemo.vue'),
    },
    {
        path: '/invoice',
        name: 'invoice',
        component: () => import('@/views/pages/Invoice.vue'),
    },
    {
        path: '/help',
        name: 'help',
        component: () => import('@/views/pages/Help.vue'),
    },
    {
        path: '/empty',
        name: 'empty',
        component: () => import('@/views/pages/EmptyPage.vue'),
    },
    {
        path: '/documentation',
        name: 'documentation',
        component: () => import('@/views/utilities/Documentation.vue'),
    },

    {
        path: '/blocks',
        name: 'blocks',
        component: () => import('@/views/utilities/BlocksDemo.vue'),
    },
    //    ],
    //},
    // {
    //     path: '/login2',
    //     name: 'login2',
    //     component: () => import('@/views/pages/Login.vue'),
    // },
    // {
    //     path: '/error',
    //     name: 'error',
    //     component: () => import('@/views/pages/Error.vue'),
    // },
    {
        path: '/notfound',
        name: 'notfound',
        component: () => import('@/views/pages/NotFound.vue'),
    },
    // {
    //     path: '/access',
    //     name: 'access',
    //     component: () => import('@/views/pages/Access.vue'),
    // },
];

const devPages = [
    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '/pages/notfound',
                name: 'notfound',
                component: () => import('@/views/pages/NotFound.vue')
            },
            {
                path: '/test2-manage-constraint/:created_by',
                name: 'test2-manage-constraint',
                component: () => import('@/views/pages/tests2/ManageConstraint.vue')
            },
            {
                path: '/test2-widgets/:case*',
                name: 'test2-widgets',
                component: () => import('@/views/pages/tests2/TestWidgets.vue')
            },
            {
                path: '/test2-actions',
                name: 'test2-actions',
                component: () => import('@/views/pages/tests2/TestActions.vue')
            },
            {
                path: '/test2-views/:case*',
                name: 'test2-views',
                component: () => import('@/views/pages/tests2/TestViews.vue')
            },
            {
                path: '/test2-manage',
                name: 'test2-manage',
                component: () => import('@/views/pages/tests2/TestManage.vue')
            },
            {
                path: '/test2-import',
                name: 'test2-import',
                component: () => import('@/views/pages/tests2/TestImport.vue')
            },
            {
                path: '/test2-esperimenti',
                name: 'test2-esperimenti',
                component: () => import('@/views/pages/tests2/Esperimenti.vue')
            },
            {
                path: '/test2-dialogs',
                name: 'test2-dialogs',
                component: () => import('@/views/pages/tests2/TestDialogs.vue')
            },
            {
                path: '/test2-dt',
                name: 'test2-dt',
                component: () => import('@/views/pages/tests2/DynamicTemplate.vue')
            },
        ]
    }
]

const appRoutes = [
    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: () => import('@/views/Dashboard.vue')
            },
            // {
            //     path: "geoitalia/",
            //     name: "geoitalia",
            //     component: () => import('@/views/pages/app/GeoItalia.vue')
            // },
            // {
            //     path: "geomondo/",
            //     name: "geomondo",
            //     component: () => import('@/views/pages/app/GeoMondo.vue'),
            // },
            // {
            //     path: "anagtipologie/",
            //     name: "anagtipologie",
            //     component: () => import('@/views/pages/app/AnagTipologie.vue'),
            // },
            // {
            //     path: "anagmisc/",
            //     name: "anagmisc",
            //     component: () => import('@/views/pages/app/AnagMisc.vue'),
            // },
            {
                path: "tabelle/",
                name: "tabelle",
                component: () => import('@/views/pages/app/SupportTablesPage.vue'),
            },
            {
                path: '/layoutConfig',
                name: 'layoutConfig',
                component: () => import('@/views/pages/app/ConfigPage.vue')
            },
            {
                path: '/logout',
                name: 'logout',
                component: () => import('@/views/Logout.vue')
            },
            {
                path: '/profilo',
                name: 'profilo',
                component: () => import('@/views/pages/auth/Profilo.vue')
            },
        ]
    },
    {
        path: "/:catchAll(.*)",
        component: () => import('@/views/pages/NotFound.vue'),
    },
    {
        path: '/auth',
        component: AppLogin,
        children: [
            {
                path: '/auth/login',
                name: 'login',
                component: () => import('@/views/pages/auth/Login.vue')
            },
            {
                path: '/access',
                name: 'accessDenied',
                component: () => import('@/views/pages/auth/Access.vue')
            },
            {
                path: '/error',
                name: 'error',
                component: () => import('@/views/pages/auth/Error.vue')
            },
        ]
    }
]

const superAdminPages = [
    {
        path: '/admin/ruoli',
        name: 'ruoli',
        component: () => import('@/views/pages/app/superadmin/RuoliPage.vue')
    },
    {
        path: '/admin/models-confs',
        name: 'model-confs',
        component: () => import('@/views/pages/app/superadmin/ModelsConfiguration.vue')
    },
    {
        path: '/admin/deploy',
        name: 'deploy',
        component: () => import('@/views/pages/app/superadmin/DeployPage.vue')
    },
]

appRoutes[0].children = appRoutes[0].children.concat(cupparisPrimevue.routerConf);
if (parseInt(import.meta.env.VITE_APP_DEV_MENU)) {
    appRoutes[0].children = appRoutes[0].children.concat(devChildren);
    for (let i in devPages) {
        appRoutes.push(devPages[i]);
    }
}
if (import.meta.env.VITE_MODE == 'dev') {
    for (let i in superAdminPages) {
        appRoutes[0].children.push(superAdminPages[i]);
    }
}
console.debug('appRoutes', appRoutes)
const router = createRouter({
    history: createWebHashHistory(),
    routes: appRoutes,
    scrollBehavior() {
        return {left: 0, top: 0};
    },
});

export default router;
