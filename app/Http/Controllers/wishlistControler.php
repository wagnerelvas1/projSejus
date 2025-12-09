<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class wishlistControler extends Controller
{
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
