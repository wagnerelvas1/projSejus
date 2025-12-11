@extends('layout')

@section('title', 'Catálogo')

@section('styles')

@endsection

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Catálogo</h1>

            <section>
                <div class="row row-cols-md-3 g-3">
                    @foreach ($jogos as $jogo)
                    <div class="col-6 mb-3">
                        <x-card-catalogo
                        :id="$jogo->id_jogo"
                        :title="$jogo->nome_jogo"
                        :plataform="$jogo->plataforma"
                        :price="$jogo->final_price"
                        :original_price="$jogo->valor"
                        :discount="$jogo->discount"
                        :img="$jogo->imagem ?? asset('assets/images/defaultGame.jpg')"
                        />

                    </div>
                    @endforeach
                </div>
            </section>
</div>

@endsection
