@extends('layout')

@section('content')
<div class="container">
    <div class="row">

        <header class="head">
            <div class="nvm-grid">
                <div>

                    <h1 class="head_title">Meu Carrinho</h1>
                </div>
                <div class="">
                    <a href="{{Route('gamesPage')}}">Continuar comprando</a>
                </div>
            </div>
        </header>
        <section class="offset-1 col-4 bg-blue p-5">
            <div class="text-dark bg-white">
                Produto
            </div>
            <div class="bg-white mb-1">
                {{-- jogos --}}
                dasda
            </div>
            <div class="bg-white rounded">
                <p class="text-dark">Informações Importantes:</p>
                <ul class="text-dark">
                    <li>Todos os itens são entregues apenas de forma digital por download ou créditos direto na conta e estão sujeitos à política de reembolso.</li>
                    <li>Verifique os requisitos de sistema na página de cada jogo e os Termos de Uso antes de realizar a compra.</li>
                    <li>Alguns itens possuem limite temporário de compra e podem levar em torno de 2 dias para poder fazer uma nova compra do mesmo item.</li>
                    <li>Inserir produtos ou cupons no carrinho não garante a reserva das promoções ativas.</li>
                </ul>
            </div>
        </section>
        <section class="offset-1 col-4 rounded ">

            <div>
                Forma de Pagamento
            </div>
            <div>
                {{-- formas de pagamento --}}
            </div>
            <div>
                <span>Economia</span>
            </div>
            <div>
                <p>Total</p>
                <span>value</span>
            </div>
        </section>
    </div>
</div>
@endsection
