@props([
    'title' => 'Título do jogo',
    'platform' => 'Plataforma',
    'price' => 0.00,
    'original_price' => null,
    'discount' => null,
    'image' => asset('assets/images/defaultGame.jpg'),
])

<div class="game-card">
    <img src="{{ $image }}" alt="{{ $title }}">
    <h3>{{ $title ?: 'Título do jogo' }}</h3>
    <p class="platform">{{ $platform ?: 'Plataforma'}}</p>

    <!-- Forma que o preço vai parecer no card -->
    <div class="price">
        @if($discount)
        <div class="price-box">
            <span class="price-original">R$ {{ number_format((float)$original_price, 2, ',', '.') }}</span>
            <div class="price-line">
                <span class="price-final">R$ {{ number_format((float)$price, 2, ',', '.') }}</span>
                <span class="discount">-{{ $discount }}%</span>
            </div>
        </div>
        @else
        <span class="price-final">
            R$ {{ number_format($price, 2, ',', '.') }}
        </span>
        @endif
    </div>
    <button>Comprar</button>
</div>
