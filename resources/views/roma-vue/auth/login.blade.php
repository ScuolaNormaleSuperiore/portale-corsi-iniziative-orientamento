@extends('app')
@section('content')
    <div class="login-body">
        <div class="card login-panel p-fluid">
            <div class="login-panel-content">
                <div class="grid">
                    <div v-if="error" class="text-red-500">
{{--                        <div>{{ $errorMsg }}</div>--}}
                    </div>
                    <div class="col-12 sm:col-6 md:col-6 logo-container">
                        <img src="/layout/images/logo-roma.svg" alt="roma" />
                        <span class="guest-sign-in">Welcome, please use the form to sign-in Roma network</span>
                    </div>
                    <form class="col-12" action="/login" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-12 username-container">
                            <label>Username</label>
                            <div class="login-input">
                                <input id="input" type="text" name="email"/>
                            </div>
                        </div>
                        <div class="col-12 password-container">
                            <label>Password</label>
                            <div class="login-input">
                                <input type="password" name="password" />
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
                            <input label="Sign In" icon="pi pi-check" type="submit" value="login"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', (event) => {

        });


    </script>
@endsection
