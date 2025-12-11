@props([
    'id',
    'title' => 'Título do jogo',
    'plataform' => 'Plataforma',
    'price' => 0.00,
    'original_price' => null,
    'discount' => null,
    'img' => asset('assets/images/defaultGame.jpg'),
])
@php
    $isInWishlist = false;

    if (Auth::check() && isset($id)) {
        $user = Auth::user();
        $isInWishlist = $user->hasInWishlist($id);
    }
@endphp

<div class="card mb-3 shadow-sm">
    <div class="d-flex align-items-center p-3">

        <img class="rounded me-3" style="width: 90px; height: 150px; object-fit: cover;"src="{{$img}}" alt="{{$title}}">

        <div class="flex-grow-1">

            <h3 class="">{{$title ?: 'Titulo do jogo'}}</h3>
            <p class="">{{$plataform ?:'Plataforma'}}</p>

            <p class="">
                @if($discount)
                <span class="text-muted small me-2" style="text-decoration: line-through">
                    R$ {{ number_format((float)$original_price, 2, ',', '.') }}
                </span>

                <span class="fw-bold text-danger me-2">
                    R$ {{ number_format((float)$price, 2, ',', '.') }}
                </span>

                <span class="fw-bold text-primary">-{{ $discount }}%</span>
                @else
                R$ {{ number_format($price, 2, ',', '.') }}
                @endif
            </p>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <button type="button" class="btn btn-outline-success me-2">Comprar</button>

            @if ($isInWishlist)
                <form action="{{ route('wishlist.remove', $id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger" title="Remover da Lista de Desejos">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                        </svg>
                    </button>
                </form>
            @else
                <form action="{{ route('wishlist.add', $id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger" title="Adicionar à Lista de Desejos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
