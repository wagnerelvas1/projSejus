<?php

namespace App\Http\Controllers;

use App\Models\Meus_Jogos;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class bibliotecaControler extends Controller
{
         public function biblioteca(Request $request){
        $user = Auth::user();

        $dados = [];
        if($request->ajax()){

            return view('Perfil.content.biblioteca_content', compact('dados'));
        }


        $jogosModel = new Meus_Jogos();
        $jogos = $jogosModel->getJogosByUserId($user->user_id);
        $jogos->map(function($jogo){
            if($jogo->image_path){
                $jogo->imagem = Storage::disk('s3')->temporaryUrl($jogo->image_path, Carbon::now()->add(5, 'minutes'));
            }else{
                $jogo->imagem = asset('assets/images/defaultGame.jpg');
            }
            return $jogo;
        });
        // dd($jogos);
        return view('Perfil.biblioteca', ['jogos'=> $jogos]);
    }
}
