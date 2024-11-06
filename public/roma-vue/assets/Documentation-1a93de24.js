import{_ as d,x as c,o as s,c as o,a as e,y as n,d as r,p,f as m,e as t}from"./index-caadb339.js";const h={},a=l=>(p("data-v-e4ef9aae"),l=l(),m(),l),u={class:"grid"},f={class:"col-12"},y={class:"card docs"},v=a(()=>e("h2",null,"Getting Started",-1)),_=a(()=>e("p",null,[t(" Roma is an application template for Vue 3 based on "),e("a",{href:"https://github.com/vuejs/create-vue",class:"font-medium text-primary hover:underline"},"create-vue"),t(", the recommended way to start a "),e("strong",null,"Vite-powered"),t(" Vue projects. To get started, extract the contents of the zip file, cd to the directory and install the dependencies with npm or yarn. ")],-1)),g=a(()=>e("code",null,`
npm install

`,-1)),x=[g],b=a(()=>e("p",null,[t("Next step is running the application using the serve script and navigate to "),e("i",null,"http://localhost:5173/"),t(" to view the application. That is it, you may now start with the development using the Roma template.")],-1)),w=a(()=>e("code",null,`
npm run dev

`,-1)),$=[w],C=r('<h4 data-v-e4ef9aae>Structure</h4><p data-v-e4ef9aae>Roma consists of a couple folders, demos and layout have been separated so that you can easily remove what is not necessary for your application.</p><ul class="line-height-3" data-v-e4ef9aae><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>src/layout</span>: Main layout components</li><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>src/views</span>: Demo pages</li><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>public/demo</span>: Assets used in demos</li><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>public/layout</span>: Assets used in layout</li><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>src/assets/demo</span>: Styles used in demos</li><li class="line-height-4" data-v-e4ef9aae><span class="text-primary font-medium" data-v-e4ef9aae>src/assets/sass</span>: SCSS files of the main layout and PrimeVue components</li></ul><h4 data-v-e4ef9aae>Menu</h4><p data-v-e4ef9aae> Main menu is located at <span class="text-primary font-medium" data-v-e4ef9aae>src/layout/AppLayout.vue</span> file. Update the <span class="text-primary font-medium" data-v-e4ef9aae>model</span> property to define the menu of your application using PrimeVue MenuModel API. </p>',5),D=a(()=>e("code",null,`
data() {
    return {
        menu : [
            {
				label: 'Favorites', icon: 'pi pi-fw pi-home',
				items: [
					{label: 'Dashboard', icon: 'pi pi-fw pi-home', to:'/'},
				]				
			},
    },
    //...

`,-1)),S=[D],A=r('<h4 data-v-e4ef9aae>Integration with Existing Vite Applications</h4><p data-v-e4ef9aae>Only the folders that are related to the layout needs to move in to your project.</p><ol data-v-e4ef9aae><li class="line-height-4" data-v-e4ef9aae>Move <span class="text-primary font-medium" data-v-e4ef9aae>public/layout</span> and <span class="text-primary font-medium" data-v-e4ef9aae>public/theme</span> to your <span class="text-primary font-medium" data-v-e4ef9aae>public</span> folder.</li><li class="line-height-4" data-v-e4ef9aae>Move <span class="text-primary font-medium" data-v-e4ef9aae>src/assets/sass</span> to your <span class="text-primary font-medium" data-v-e4ef9aae>src/assets</span> folder.</li><li class="line-height-4" data-v-e4ef9aae>Move <span class="text-primary font-medium" data-v-e4ef9aae>src/layout</span> to your <span class="text-primary font-medium" data-v-e4ef9aae>src</span> folder.</li><li class="line-height-4" data-v-e4ef9aae> Update your <span class="text-primary font-medium" data-v-e4ef9aae>router/index.js</span> so that the <span class="text-primary font-medium" data-v-e4ef9aae>/</span> path refers to <span class="text-primary font-medium" data-v-e4ef9aae>AppLayout</span></li></ol>',3),V=a(()=>e("code",null,`
import { createRouter, createWebHistory } from 'vue-router';
import AppLayout from '@/layout/AppLayout.vue';
const routes = [
    {
        path: '/',
        component: AppLayout,
        children: [
            /* your pages */
        ],
    },
];

const router = createRouter({
    history: createWebHistory(`/roma-vue/`),
    routes
});

export default router;

`,-1)),k=[V],I=r('<h4 data-v-e4ef9aae>PrimeVue Theme</h4><p data-v-e4ef9aae> Roma provides 16 PrimeVue themes out of the box. Setup of a theme is simple by including the css of theme to your bundle that are located inside <span class="text-primary font-medium" data-v-e4ef9aae>public/theme/</span> folder such as <span class="text-primary font-medium" data-v-e4ef9aae>public/theme/theme-light/indigo/theme.css</span>. </p><p data-v-e4ef9aae>A custom theme can be developed by the following steps.</p><ul data-v-e4ef9aae><li class="line-height-4" data-v-e4ef9aae>Choose a custom theme name such as &quot;mytheme&quot;.</li><li class="line-height-4" data-v-e4ef9aae>Create a folder named &quot;mytheme&quot; under <span class="font-semibold" data-v-e4ef9aae>public/theme/</span> folder.</li><li class="line-height-4" data-v-e4ef9aae>Create a file such as theme-light.scss inside your &quot;mytheme&quot; folder.</li><li class="line-height-4" data-v-e4ef9aae>Define the variables listed below in your file and import the dependencies.</li><li class="line-height-4" data-v-e4ef9aae> Include the theme.scss in your application via an import in <i data-v-e4ef9aae>src/assets/styles.scss</i>or simply refer to the compiled css with a link tag. Note that if you choose the former, the theme will be bundled with the rest of your app. </li></ul><p data-v-e4ef9aae>Here are the variables required to create a light theme.</p>',5),M=a(()=>e("code",null,`
$primaryColor: #6366f1 !default;
$primaryColor: #0F8BFD;
$primaryLightColor: scale-color($primaryColor, $lightness: 60%) !default;
$primaryDarkColor: scale-color($primaryColor, $lightness: -10%) !default;
$primaryDarkerColor: scale-color($primaryColor, $lightness: -20%) !default;
$primaryTextColor: #ffffff;

@import '../../../src/assets/sass/theme/_theme_light';

`,-1)),L=[M],T=a(()=>e("p",null,"For a dark theme, filename should be theme-dark.scss and the imported file needs to change to use the dark version.",-1)),q=a(()=>e("code",null,`
$primaryColor: #6366f1 !default;
$primaryColor: #0F8BFD;
$primaryLightColor: scale-color($primaryColor, $lightness: 60%) !default;
$primaryDarkColor: scale-color($primaryColor, $lightness: -10%) !default;
$primaryDarkerColor: scale-color($primaryColor, $lightness: -20%) !default;
$primaryTextColor: #ffffff;

@import '../../../src/assets/sass/theme/_theme_dark';

`,-1)),N=[q],R=a(()=>e("h4",null,"Theme Switcher",-1)),F=a(()=>e("p",null," Dynamic theming is built-in to the template and implemented by including the theme via a link tag instead of bundling the theme along with a configurator component to switch it. In order to switch your theme dynamically as well, it needs to be compiled to css. An example sass command to compile the css would be; ",-1)),P={class:"app-code"},B=a(()=>e("code",null,"sass --update public/theme:public/theme",-1)),j=[B],E=a(()=>e("p",{class:"text-sm"},"*Note: The sass command above is supported by Dart Sass. Please use Dart Sass instead of Ruby Sass.",-1)),H=a(()=>e("h4",null,"Migration",-1)),G=a(()=>e("p",null,[t(" Initial integration with an existing Vite application and the migration process is similar. During an update, only the "),e("span",{class:"text-primary font-medium"},"src/layout"),t(" folder, "),e("span",{class:"text-primary font-medium"},"public/layout"),t(" and "),e("span",{class:"text-primary font-medium"},"public/theme"),t(' folders need to be updated, see the "Integration with Existing Vite Applications" section for more information. Important changes are also documented at CHANGELOG.md file. ')],-1));function O(l,U){const i=c("code");return s(),o("div",u,[e("div",f,[e("div",y,[v,_,n((s(),o("pre",null,x)),[[i]]),b,n((s(),o("pre",null,$)),[[i]]),C,n((s(),o("pre",null,S)),[[i]]),A,n((s(),o("pre",null,k)),[[i]]),I,n((s(),o("pre",null,L)),[[i]]),T,n((s(),o("pre",null,N)),[[i]]),R,F,n((s(),o("pre",P,j)),[[i]]),E,H,G])])])}const z=d(h,[["render",O],["__scopeId","data-v-e4ef9aae"]]);export{z as default};
