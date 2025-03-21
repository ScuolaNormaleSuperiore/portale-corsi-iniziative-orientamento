@extends('app')
@section('content')
    <div class="surface-0 flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="grid justify-content-center p-2 lg:p-0" style="min-width:80%">
            <div class="col-12 mt-5 xl:mt-0 text-center">
                <img src="{{Theme::url('layout/images/logo-blue.svg')}}" alt="Sakai logo" class="mb-5" style="width:81px; height:60px;">
            </div>
            <div class="col-12 xl:col-6" style="border-radius:56px; padding:0.3rem; background: linear-gradient(180deg, var(--primary-color), rgba(33, 150, 243, 0) 30%);">
                <div class="h-full w-full m-0 py-7 px-4" style="border-radius:53px; background: linear-gradient(180deg, var(--surface-50) 38.9%, var(--surface-0));">
                    <div class="text-center mb-5">
                        <span class="text-600 font-medium">Sign in to continue</span>
                    </div>
                    <div class="w-full md:w-10 mx-auto">
                        <form action="/login" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <label for="email1" class="block text-900 text-xl font-medium mb-2">Email</label>
                            <input class="p-component p-inputtext w-full mb-3" name="email" placeholder="Email">

                            <label for="password1" class="block text-900 font-medium text-xl mb-2">Password</label>
                            <input class="p-component p-inputtext w-full mb-3" name="password" placeholder="Email" type="password">

                            <div class="flex align-items-center justify-content-between mb-5">
                                <div class="flex align-items-center">
                                    <input type="checkbox" name="remember">
                                    <label for="rememberme1">Remember me</label>
                                </div>
                                <a href="#" class="font-medium no-underline ml-2 text-right cursor-pointer" >Forgot password?</a>
                            </div>
                            <button type="submit" class="w-full p-3 text-xl p-button">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', (event) => {

        });


    </script>
@endsection
