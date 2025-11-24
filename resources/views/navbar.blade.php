<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Sejus Play</a>
    <a href="{{Route('homePage')}}">Home</a>
    <a href="{{Route('gamesPage')}}">Catalogo</a>
    <a href="{{Route('aboutUs')}}">Sobre Nós</a>
    <a href="{{Route('myProfile')}}"><i class="fa-solid fa-circle-user"></i></a>
    <form class="d-flex" role="search">
      {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/> --}}
        <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
    </form>
  </div>
</nav>
<main>
    @yield('content')
</main>

</body>
</html>
