<script setup>
import { ref, computed } from 'vue';
import AppConfig from '@/layout/AppConfig.vue';
import cupparisPrimevue from 'cupparis-primevue';
import { useRouter } from 'vue-router'
import CrudInit from '@/crud/CrudInit.js';

const email = ref('');
const password = ref('');
const error = ref(false);
const errorMsg = ref('');
const router = useRouter();
const checked = ref(false);
// const logoUrl = computed(() => {
//     return `${contextPath}layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
// });

const logoUrl = computed(() => {
    return `/assets/images/logo.svg`;
    //return `${contextPath}layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});

function login() {
    error.value = false;
    console.log('login',email.value,password.value)
    cupparisPrimevue.Server.post('/api/login',{
        email : email.value,
        password : password.value,
    },function(json) {
        console.log('json respons',json);
        if (json.error) {
            error.value = true;
            errorMsg.value = json.msg;
            return ;
        }
        if (json.access_token) {
            window.localStorage.setItem('token',json.access_token);
            CrudInit.loadMenu().then(() => {
                router.push('/');
            })

        }
    })
}
</script>

<template>
    <div class="login-body">
        <div class="card login-panel p-fluid">
            <div class="login-panel-content">
                <div class="grid">
                    <div v-if="error" class="text-red-500">
                        <div>{{ errorMsg }}</div>
                    </div>
                    <div class="col-12 sm:col-6 md:col-6 logo-container">
                        <img class="h-5rem" src="/layout/images/cupparis/logo-sns@2x_0_bg.png" alt="SNS orientamento" />
                       <div><h5 class="text-primary">SNS Orientamento</h5></div>
                        <span class="guest-sign-in">Benvenuto nell'area amministrativa.</span>
                    </div>
                    <div class="col-12 username-container">
                        <label>Username</label>
                        <div class="login-input">
                            <InputText id="input" type="text" v-model="email"/>
                        </div>
                    </div>
                    <div class="col-12 password-container">
                        <label>Password</label>
                        <div class="login-input">
                            <InputText type="password" v-model="password" />
                        </div>
                    </div>
                    <div class="col-6 rememberme-container">
                        <Checkbox v-model="checked" :binary="true" />
                        <label> Remember me</label>
                    </div>

                    <div class="col-6 mt-1 forgetpassword-container">
                        <a href="#" class="forget-password">Forget Password</a>
                    </div>

                    <div class="col-12 sm:col-6">
                        <Button label="Sign In" icon="pi pi-check" @click="login" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--<script>-->
<!--export default {-->
<!--    data() {-->
<!--        return {-->
<!--            checked: false,-->
<!--        };-->
<!--    },-->
<!--    methods: {-->
<!--        goDashboard() {-->
<!--            this.$router.push({ path: '/' });-->
<!--        },-->
<!--    },-->
<!--};-->
<!--</script>-->

<style scoped></style>
