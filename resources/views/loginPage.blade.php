<!DOCTYPE html>
<html lang="pt-br">

@section('title', 'Login')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/styleLogin.css') }}?v={{ file_exists(public_path('assets/css/styleLogin.css')) ? filemtime(public_path('assets/css/styleLogin.css')) : time() }}">

</head>

<body>
    <section class="login-box">
        <div class="content">
            <a class="link-logo" href="{{Route('homePage')}}"><img src="{{asset('assets/images/logoNova.png')}}" alt="" width="50px" height="50px"></a>
            <h2>Login</h2>
            <div class="form-box">
                <form action="">
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
                    <p>Ainda não tem conta? <a href="{{Route('registerPage')}}">Cadastre-se</a></p>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
