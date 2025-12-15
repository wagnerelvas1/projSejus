@extends('layout')

@section('title', $jogo->nome_jogo)

@section('content')

    @php
        $isInWishlist = false;
        $hasGame = false;
        if (Auth::check())
        {
            $user = Auth::user();
            $isInWishlist = $user->hasInWishlist($jogo->id_jogo);
            $hasGame = $user->hasGame($jogo->id_jogo);
        }
    @endphp

    <div class="container mt-4 mb-4" >
        <div class="row justify-content-center ">
            <div class="col-md-7 mb-4">
                <div class="card border-0 shadow-lg overflow-hidden rounded-3 me-2">

                    <img src="{{$jogo->imagem}}" alt="{{$jogo->nome_jogo}}" class="img-fluid mx-auto my-auto w-100 object-fit-cover">
                </div>
            </div>

            <div class="col-md-4 p-4 rounded-3 text-white h-100 d-flex flex-column" style="background: #123a8c">

                @if($jogo->discount > 0)
                <div>

                    <div class="mb-3">
                        <span class="badge bg-danger rounded-sm px-3 py-2 fw-bold" style="color: #fff">-{{ $jogo->discount }}% OFF</span>
                    </div>

                    <div class="d-flex flex-column align-content-start">
                        <div class="mb-0">
                            <sup class="text-white-50 text-decoration-line-through h5" style="color: #fff !important">
                                R$ {{ number_format($jogo->valor, 2, ',', '.') }}
                            </sup>
                        </div>

                        <div class="mb-2">
                            <span class="h2 fw-bold text-success" style="color: #fff !important">
                                R$ {{ number_format($jogo->final_price, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>
                    @else
                    <span class="h2 fw-bold text-success">
                        R$ {{ number_format($jogo->valor, 2, ',', '.') }}
                    </span>
                    @endif
                    <div class="fw-bold rounded-2 bg-body-secondary align-items-center align-content-center p-2" style="background: #0D2C6B !important">

                        {{$jogo->plataforma}}
                    </div>
                    <div class="d-flex gap-2 mt-3" >

                        <button class="border-0 rounded-2 fw-bold fs-5 d-flex align-items-center me-2" style="padding: 7px 14px; background: #57FF71">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABC0lEQVR4nNWUQWrCQBiFv9IWddFF6AEqhUK3gniGpgV7ki49g+QQRRDqCbJ04d4LBFeSdFGli26sCGpK4AUCTdMZSYr94F8kef97M8OfgSMjVlmzzzQPqgjYZpo/gcsDA26BRlGQL4Nejmn8Q6WcAwEQKSiXezXNgVPLgCc9BwrL5QSYSZiEmR7RBfCmb11+oSehbxHg6f0EAxxgBeyAa4OAJrDWJLYxZCAjz0A7knaIBS01vQP1Al1HK092cIUlU4MJSqtva578aEsD42TlL0DNNuBZBmONbqk4ujo2wA0VcAZ8WJx/fMgl+AgsqgyonAfgVTejW4LuG1Fm22EJur8PcNUcAncl6P4xX78RkD47z3P/AAAAAElFTkSuQmCC" alt="cart">Comprar
                        </button>
                        <button class="btn btn-light border-0 rounded-2 fw-bold fs-5 d-flex align-items-center gap-2" style="padding: 8px 15px;" style="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>    Desejo
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


