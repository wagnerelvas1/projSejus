@extends('layout')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/styleHome.css') }}">
@endsection

@section('content')
<body>
    {{-- Banner --}}
    <section class="banner">
        <div class="banner-overlay"></div>
        <img src="{{ asset('assets/images/bannerHome.png') }}" alt="Banner promocional" class="banner-img">
    </section>

    <h1>HOME</h1>
    <p> In eget pharetra elit, non placerat leo. Ut malesuada lectus at augue commodo lobortis. Phasellus tempus, lorem porttitor tincidunt euismod, arcu neque aliquet enim, nec consectetur tellus nulla quis sem.</p>

    {{-- Exibição dos Jogos em Carrossel --}}
    <section class="container my-5">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($promocoes as $index => $jogo)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row g-5">
                            {{-- Banner Principal --}}
                            <div class="col-md-8 ">
                                <div class="rounded-5">
                                    <img src="{{ $jogo->imagem }}" class="img-fluid rounded-3 w-100 h-100 object-fit-cover" alt="{{ $jogo->nome_jogo }}">
                                </div>
                                <div class="carousel-caption  bg-opacity-100 rounded p-3">
                                    <h5 class="text-white fw-bold">{{ $jogo->nome_jogo }}</h5>

                                    <div class="d-flex align-items-center gap-2">
                                        {{-- Caixa Vemelha % desconto --}}
                                        <span class="badge bg-danger fs-6 shadow-sm">-{{ $jogo->discount }}%</span>

                                        {{-- Preços empilhados --}}
                                        <div class="d-flex flex-column">
                                            <span class="text-white text-decoration-line-through small">R$ {{ number_format($jogo->valor, 2, ',', '.') }}</span>
                                            <span class="fw-bold text-white fs-5">R$ {{ number_format($jogo->final_price, 2, ',', '.') }}</span>
                                        </div>
                                        <a href="{{ route('homePage') }}" class="btn btn-primary">Ver promoção</a>
                                    </div>

                                </div>
                            </div>

                            {{-- Dois banners menores à direita --}}
                            <div class="col-md-4 d-flex flex-column gap-4">
                                <img src="{{ $jogo->imagem }}" class="img-fluid rounded object-fit-cover flex-fill" alt="Promo extra 1">
                                <img src="{{ $jogo->imagem }}" class="img-fluid rounded object-fit-cover flex-fill" alt="Promo extra 2">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

          {{-- Botões voltar e avançar --}}
          <button class="carousel-control-prev ms-2" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon me-3" class="icon icon-left"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
    </section>


    {{-- Exibição dos Jogos em Cards --}}
    <section class="container my-5">
        <div class="row">
            @foreach ($jogos as $jogo)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <x-game-card
                        :id="$jogo->id_jogo"
                        :title="$jogo->nome_jogo"
                        :platform="$jogo->plataforma"
                        :price="$jogo->final_price"
                        :original_price="$jogo->valor"
                        :discount="$jogo->discount"
                        :img="$jogo->imagem ?? asset('assets/images/defaultGame.jpg')"
                    />
                </div>
            @endforeach
        </div>
    </section>
</body>

@endsection
