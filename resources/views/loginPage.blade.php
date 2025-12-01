<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}?v={{ file_exists(public_path('css/styleLogin.css')) ? filemtime(public_path('css/styleLogin.css')) : time() }}">
    <title>Login</title>
</head>

<body>
    <section class="login-box">
        <div class="content">
            <a class="link-logo" href="{{Route('homePage')}}"><img src="{{asset('images/logoNova.png')}}" alt="" width="50px" height="50px"></a>
            <h2>Login</h2>
            <div class="form-box">
                <form action="{{route('authenticate')}}" method="POST">
                    @csrf
                    <div for="inp" class="email-box">
                        <label for="email">
                            <input type="email" name="email" id="email" placeholder="&nbsp;">
                            <span class="label">Email</span>
                            <span class="focus-bg"></span>
                        </label>
                    </div>
                    <div class="password-box">
                        <label for="password">
                            <input type="password" name="password" id="password" placeholder="&nbsp;">
                            <span class="label">Senha</span>
                            <span class="focus-bg"></span>
                        </label>
                    </div>
                    <button class="submit-btn">Login</button>
                    {{-- @if (@session('status'))
                    <span class="error-mensage">{{@session('status')}} </span>
                    @endif --}}
                </form>
                @if (session('status'))
                    <span class="error-mensage">{{ session('status') }}</span>
                @endif
                <p>Ainda não tem conta? <a href="{{Route('registerPage')}}">Cadastre-se</a></p>
            </div>
        </div>
    </section>
</body>

</html>
