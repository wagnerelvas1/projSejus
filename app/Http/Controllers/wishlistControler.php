<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Jogos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;


class wishlistControler extends Controller
{
    public function add(Request $resquest, $id_jogo)
    {
        $user = Auth::user();
        $jogo = Jogos::find($id_jogo);

        if (!$jogo){
            return redirect()->back()->with('error', 'Jogo não encontrado');
        }

        if($user->hasGame($id_jogo)) {
            return redirect()->back()->with('error', 'Você já possui esse jogo');
        }

        if($user->hasInWishlist($id_jogo)) {
            return redirect()->back()->with('error', 'Este jogo já está na sua lista de desejos');
        }
        Wishlist::create([
            'fk_wishlist_to_user' => $user->user_id,
            'fk_wishlist_to_jogos' => $id_jogo
        ]);

        return redirect()->back()->with('sucess', 'Jogo adicionado à wishlist!');
    }

    public function remove(Request $request, $id_jogo)
    {
        $user = Auth::user();

        Wishlist::where('fk_wishlist_to_user', $user->user_id)
            ->where('fk_wishlist_to_jogos', $id_jogo)
            ->delete();

            return redirect()->back()->with('sucess', 'Jogo removido da wishlist');
    }

    public function wishlist(Request $request){

        $user = Auth::user();

        if($request->ajax()){
            return view('Perfil.content.wishlist_content', compact('dados'));
        }
        $jogosModel = new Wishlist();
        $jogos = $jogosModel->getJogosByUserId($user->user_id);
        $jogos->map(function($jogo){
            if($jogo->image_path){
                $jogo->imagem = Storage::disk('s3')->temporaryUrl($jogo->image_path, Carbon::now()->add(5, 'minutes'));
            }else{
                $jogo->imagem = asset('assets/images/defaultGame.jpg');
            }
            return $jogo;
        });
        // dd($jogo);
        return view('Perfil.wishlist', ['jogos'=>$jogos]);
    }
}
