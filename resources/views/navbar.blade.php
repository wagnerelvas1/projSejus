<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layout</title>
    <link rel="stylesheet" href="{{asset('css/styleNavbar.css')}}?v={{ file_exists(public_path('css/styleNavbar.css')) ? filemtime(public_path('css/styleNavbar.css')) : time() }}">
  </head>
  <body>
<nav class="teste">
  <div class="nav-container">
        <a class="logo" href="{{Route('homePage')}}"><img src="{{asset('images/logoNova.png')}}" alt="" width="60px" height="60px" ></a>

        <div class="nav-links">
            <a class="link-navbar" href="{{Route('homePage')}}">Home</a>
            <a class="link-navbar" href="{{Route('gamesPage')}}">Catalogo</a>
            <a class="link-navbar" href="{{Route('aboutUs')}}">Sobre Nós</a>
        </div>
        <a class="link-navbar-img3" href="{{Route('myProfile')}}"><i class=""><img src="{{asset('images/iconProfile.png')}}" alt="" width="40px" height="40px"></i></a>
        <a class="login" href="{{ route('login') }}">Login</a>
</div>
</nav>
<main>
    @yield('content')
</main>

</body>
</html>
