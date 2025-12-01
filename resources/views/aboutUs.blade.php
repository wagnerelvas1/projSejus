@extends('navbar')

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sobre Nós</title>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

@section('content')
<body>

    <section id="banner">
        <div class="container">
            <div class="banner_headline">
                <h1>Sobre Nós</h1>
                <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc aliquet ligula in eros pharetra porttitor. In suscipit, lacus et fringilla feugiat, ante erat ultricies diam, vitae congue dolor nulla nec tellus.</h2>
            </div>
        </div>
    </section>

    <section class="main_content">
        <div class="container">
            <h2>Nosso Propósito</h2>
            <p>ullam justo tellus, interdum id aliquam et, aliquet eget massa. Curabitur nec massa porta, ullamcorper urna lacinia, auctor nisi.</p>
        </div>
    </section>

    <footer class="footer">
        <div class="footer_container">
            <div class="footer_column">
                <h4>Loja</h4>
                <p>Sobre nós</p>
                <p>Produtos</p>
                <p>Contato</p>
            </div>
            <div class="footer_column">
                <h4>Ajuda</h4>
                <p>FAQ</p>
                <p>Suporte</p>
                <p>Política de Privacidade</p>
            </div>
            <div class="footer_column">
                <h4>Redes Sociais</h4>
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instragram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com" target="_blank"><i class="fab fa-x"></i></a>
                    <a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>


        <div class="footer_copy">
                ©Copyright - <a href=""> SejusPlay Template </a> by <a href="">RJ</a>
        </div>
    </footer>


  {{-- <i class="fa-solid fa-circle-user"></i> --}}
</body>
</html>
@endsection
