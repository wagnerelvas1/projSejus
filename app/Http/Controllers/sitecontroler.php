<?php

namespace App\Http\Controllers;

use App\Models\Enderecos;
use App\Models\User;
use App\Models\Usuarios;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class sitecontroler extends Controller
{
    public function home()
    {
        return view('homePage');
    }
    public function about()
    {
        return view('aboutUs');
    }
    public function games()
    {
        return view('gamesPage');
    }
    public function login()
    {
        return view('loginPage');
    }
    public function register()
    {
        return view('registerPage');
    }
    public function navbar()
    {
        return view('navbar');
    }
    public function myprofile()
    {
        return view('myprofile');
    }
    // Função Cadastrar Usuario
    public function registerPage(){
        return view('registerPage');
    }
    public function store(Request $request){

        $user = new User();
        $endereco= new Enderecos();

        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->cep = $request->cep;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->password = Hash::make($request->password);
        $user->data_nascimento = $request->idade;
        $user->id_endereco = $endereco->id;
        // Preenchendo Parte tabela endereços

        $user->save();
        return redirect()->route('login');
    }

    public function authenticate(Request $request) {
        $credenciais = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return view('myprofile');
        } else {
            return redirect()->back()->withErrors('error', 'Login ou Senha Incorretos');
        }
    }
}
