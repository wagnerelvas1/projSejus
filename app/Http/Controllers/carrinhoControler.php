<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Wishlist;
use App\Models\Meus_Jogos;
use App\Models\Jogos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class carrinhoControler extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carrinhoModel = new Carrinho();
        $jogosNoCarrinho = $carrinhoModel->getJogosByUserId($user->user_id);


        $jogosNoCarrinho->map(function ($jogo) {
            if ($jogo->image_path) {
                $jogo->imagem = Storage::disk('s3')->temporaryUrl($jogo->image_path, Carbon::now()->add(5, 'minutes'));
            } else {
                $jogo->imagem = asset('assets/images/defaultGame.jpg');
            }
            return $jogo;
        });

        $subtotal = $jogosNoCarrinho->sum('valor');

        $totalFinal = 0;
        foreach ($jogosNoCarrinho as $jogo) {
            $totalFinal += $jogo->final_price;
        }
        $descontoTotal = $subtotal - $totalFinal;

        return view('carrinho', [
            'jogos' =>$jogosNoCarrinho,
            'subtotal' => $subtotal,
            'descontoTotal' =>$descontoTotal,
            'totalFinal' => $totalFinal
        ]);
    }
    public function somaPrecoTotal($jogos)
    {
        $total = 0;
        foreach ($jogos as $jogo) {
            $total += $jogo->final_price;
        }
        return $total;
    }

    public function calcularSubTotal($jogos)
    {
        $subtotal = 0;
        foreach ($jogos as $jogo) {
            $subtotal += $jogo->valor;
        }
        return $subtotal;
    }

    public function calcularDescontoTotal($jogos)
    {
        $descontoTotal = 0;
        foreach ($jogos as $jogo) {
            $descontoTotal += ($jogo->valor - $jogo->final_price);
        }
        return $descontoTotal;
    }

    public function add(Request $request, $id_jogo)
    {
        $user = Auth::user();

        // 1. Verifica se o jogo existe
        $jogo = Jogos::find($id_jogo);
        if (!$jogo) {
            return redirect()->back()->with('error', 'Jogo não encontrado.');
        }

        // 2. Verifica se o usuário já tem o jogo na biblioteca
        if ($user->hasGame($id_jogo)) {
            return redirect()->back()->with('error', 'Você já possui este jogo na sua biblioteca.');
        }

        if ($user->hasInCarrinho($id_jogo)) {
            return redirect()->back()->with('info', 'Este jogo já está no seu carrinho.');
        }
        // 3. Verifica se o jogo JÁ ESTÁ no carrinho
        // $jaNoCarrinho = Carrinho::where('fk_carrinho_to_user', $user->user_id)
        //                         ->where('fk_carrinho_to_jogos', $id_jogo)
        //                         ->exists();

        // if ($jaNoCarrinho) {
        //     return redirect()->back()->with('info', 'Este jogo já está no seu carrinho.');
        // }

        // 4. Adiciona ao Carrinho
        $carrinho = Carrinho::create([
            'fk_carrinho_to_user'  => $user->user_id,
            'fk_carrinho_to_jogos' => $id_jogo
        ]);

        return redirect()->back()->with('success', 'Jogo adicionado ao carrinho!');
    }

    public function remove(Request $request, $id_jogo)
    {
        $user = Auth::user();

        // Remove o jogo do carrinho do usuário autenticado
        $removido = Carrinho::where('fk_carrinho_to_user', $user->user_id)
                            ->where('fk_carrinho_to_jogos', $id_jogo)
                            ->delete();

        if ($removido) {
            return redirect()->back()->with('success', 'Jogo removido do carrinho.');
        } else {
            return redirect()->back()->with('error', 'Jogo não encontrado no carrinho.');
        }
    }

    public function clearCarrinho()
    {
        $user = Auth::user();

        $removidos = Carrinho::where('fk_carrinho_to_user', $user->user_id)->delete();

        if ($removidos)
        {
            return redirect()->back()->with('success', $removidos . ' Carrinho esvaziado com sucesso.');
        } else {
            return redirect()->back()->with('info', 'Seu carrinho já está vazio.');
        }
    }


    public function confirmCompra()
    {
        $user = Auth::user();

        // 1. Busca todos os itens do carrinho deste usuário
        $itensCarrinho = Carrinho::where('fk_carrinho_to_user', $user->user_id)->get();

        if ($itensCarrinho->isEmpty()) {
            return redirect()->back()->with('error', 'Seu carrinho está vazio.');
        }

        // Usamos Transaction para garantir que tudo aconteça ou nada aconteça (segurança de dados)
        DB::transaction(function () use ($user, $itensCarrinho) {

            foreach ($itensCarrinho as $item) {
                $id_jogo = $item->fk_carrinho_to_jogos;

                // A. Adiciona à Biblioteca (se ainda não tiver)
                if (!$user->hasGame($id_jogo)) {
                    Meus_Jogos::create([
                        'fk_meus_jogos_to_user'  => $user->user_id,
                        'fk_meus_jogos_to_jogos' => $id_jogo
                    ]);
                }

                // B. Remove da Wishlist (se estiver lá)
                // Usamos delete direto para otimizar
                Wishlist::where('fk_wishlist_to_user', $user->user_id)
                        ->where('fk_wishlist_to_jogos', $id_jogo)
                        ->delete();
            }

            // C. ESVAZIAR O CARRINHO após a compra
            Carrinho::where('fk_carrinho_to_user', $user->user_id)->delete();
        });

        return redirect()->route('biblioteca')->with('success', 'Compra realizada com sucesso! Todos os jogos foram adicionados à sua biblioteca.');
    }
}
