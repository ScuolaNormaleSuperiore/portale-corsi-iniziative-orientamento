<template>
    <div class="grid">
        <div class="col-12">
            <div class="card docs">
                <h2>Getting Started</h2>
                <p>
                    Roma is an application template for Vue 3 based on <a href="https://github.com/vuejs/create-vue" class="font-medium text-primary hover:underline">create-vue</a>, the recommended way to start a <strong>Vite-powered</strong> Vue
                    projects. To get started, extract the contents of the zip file, cd to the directory and install the dependencies with npm or yarn.
                </p>
                <pre v-code><code>
npm install

</code></pre>

                <p>Next step is running the application using the serve script and navigate to <i>http://localhost:5173/</i> to view the application. That is it, you may now start with the development using the Roma template.</p>

                <pre v-code><code>
npm run dev

</code></pre>

                <h4>Structure</h4>
                <p>Roma consists of a couple folders, demos and layout have been separated so that you can easily remove what is not necessary for your application.</p>
                <ul class="line-height-3">
                    <li class="line-height-4"><span class="text-primary font-medium">src/layout</span>: Main layout components</li>
                    <li class="line-height-4"><span class="text-primary font-medium">src/views</span>: Demo pages</li>
                    <li class="line-height-4"><span class="text-primary font-medium">public/demo</span>: Assets used in demos</li>
                    <li class="line-height-4"><span class="text-primary font-medium">public/layout</span>: Assets used in layout</li>
                    <li class="line-height-4"><span class="text-primary font-medium">src/assets/demo</span>: Styles used in demos</li>
                    <li class="line-height-4"><span class="text-primary font-medium">src/assets/sass</span>: SCSS files of the main layout and PrimeVue components</li>
                </ul>

                <h4>Menu</h4>
                <p>
                    Main menu is located at <span class="text-primary font-medium">src/layout/AppLayout.vue</span> file. Update the <span class="text-primary font-medium">model</span> property to define the menu of your application using PrimeVue
                    MenuModel API.
                </p>

                <pre v-code><code>
data() &#123;
    return &#123;
        menu : [
            {
				label: 'Favorites', icon: 'pi pi-fw pi-home',
				items: [
					{label: 'Dashboard', icon: 'pi pi-fw pi-home', to:'/'},
				]				
			},
    &#125;,
    //...

</code></pre>
                <h4>Integration with Existing Vite Applications</h4>
                <p>Only the folders that are related to the layout needs to move in to your project.</p>
                <ol>
                    <li class="line-height-4">Move <span class="text-primary font-medium">public/layout</span> and <span class="text-primary font-medium">public/theme</span> to your <span class="text-primary font-medium">public</span> folder.</li>
                    <li class="line-height-4">Move <span class="text-primary font-medium">src/assets/sass</span> to your <span class="text-primary font-medium">src/assets</span> folder.</li>
                    <li class="line-height-4">Move <span class="text-primary font-medium">src/layout</span> to your <span class="text-primary font-medium">src</span> folder.</li>
                    <li class="line-height-4">
                        Update your <span class="text-primary font-medium">router/index.js</span> so that the <span class="text-primary font-medium">/</span> path refers to <span class="text-primary font-medium">AppLayout</span>
                    </li>
                </ol>

                <pre v-code><code>
import &#123; createRouter, createWebHistory &#125; from 'vue-router';
import AppLayout from '@/layout/AppLayout.vue';
const routes = [
    &#123;
        path: '/',
        component: AppLayout,
        children: [
            /* your pages */
        ],
    &#125;,
];

const router = createRouter(&#123;
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
&#125;);

export default router;

</code></pre>

                <h4>PrimeVue Theme</h4>
                <p>
                    Roma provides 16 PrimeVue themes out of the box. Setup of a theme is simple by including the css of theme to your bundle that are located inside <span class="text-primary font-medium">public/theme/</span> folder such as
                    <span class="text-primary font-medium">public/theme/theme-light/indigo/theme.css</span>.
                </p>

                <p>A custom theme can be developed by the following steps.</p>
                <ul>
                    <li class="line-height-4">Choose a custom theme name such as "mytheme".</li>
                    <li class="line-height-4">Create a folder named "mytheme" under <span class="font-semibold">public/theme/</span> folder.</li>
                    <li class="line-height-4">Create a file such as theme-light.scss inside your "mytheme" folder.</li>
                    <li class="line-height-4">Define the variables listed below in your file and import the dependencies.</li>
                    <li class="line-height-4">
                        Include the theme.scss in your application via an import in <i>src/assets/styles.scss</i>or simply refer to the compiled css with a link tag. Note that if you choose the former, the theme will be bundled with the rest of your
                        app.
                    </li>
                </ul>

                <p>Here are the variables required to create a light theme.</p>
                <pre v-code><code>
$primaryColor: #6366f1 !default;
$primaryColor: #0F8BFD;
$primaryLightColor: scale-color($primaryColor, $lightness: 60%) !default;
$primaryDarkColor: scale-color($primaryColor, $lightness: -10%) !default;
$primaryDarkerColor: scale-color($primaryColor, $lightness: -20%) !default;
$primaryTextColor: #ffffff;

@import '../../../src/assets/sass/theme/_theme_light';

</code></pre>

                <p>For a dark theme, filename should be theme-dark.scss and the imported file needs to change to use the dark version.</p>
                <pre v-code><code>
$primaryColor: #6366f1 !default;
$primaryColor: #0F8BFD;
$primaryLightColor: scale-color($primaryColor, $lightness: 60%) !default;
$primaryDarkColor: scale-color($primaryColor, $lightness: -10%) !default;
$primaryDarkerColor: scale-color($primaryColor, $lightness: -20%) !default;
$primaryTextColor: #ffffff;

@import '../../../src/assets/sass/theme/_theme_dark';

</code></pre>

                <h4>Theme Switcher</h4>
                <p>
                    Dynamic theming is built-in to the template and implemented by including the theme via a link tag instead of bundling the theme along with a configurator component to switch it. In order to switch your theme dynamically as well,
                    it needs to be compiled to css. An example sass command to compile the css would be;
                </p>

                <pre v-code class="app-code"><code>sass --update public/theme:public/theme</code></pre>

                <p class="text-sm">*Note: The sass command above is supported by Dart Sass. Please use Dart Sass instead of Ruby Sass.</p>

                <h4>Migration</h4>
                <p>
                    Initial integration with an existing Vite application and the migration process is similar. During an update, only the <span class="text-primary font-medium">src/layout</span> folder,
                    <span class="text-primary font-medium">public/layout</span> and <span class="text-primary font-medium">public/theme</span> folders need to be updated, see the "Integration with Existing Vite Applications" section for more
                    information. Important changes are also documented at CHANGELOG.md file.
                </p>
            </div>
        </div>
    </div>
</template>

<script></script>

<style scoped lang="scss">
@import '@/assets/demo/styles/documentation.scss';
</style>
