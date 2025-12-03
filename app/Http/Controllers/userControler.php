<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // Ajuste no namespace base
use App\Models\Enderecos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userControler extends Controller
{
    public function store(Request $request){

        // 1. Validação dos Dados
        // Se falhar aqui, o Laravel redireciona automaticamente de volta com os erros.
        $request->validate([
            // Dados do Usuário
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', // Garante que o email é único na tabela users
            'cpf'      => 'required|string|max:14|unique:users,cpf', // Garante CPF único (ajuste max se usar pontuação)
            'password' => 'required|string|min:8', // Mínimo de 8 caracteres para segurança
            'idade'    => 'required|date', // Valida se é uma data válida

            // Dados do Endereço
            'rua'    => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|size:2', // Ex: RO, SP (2 letras)
            'cep'    => 'required|string|max:9',
            'bairro' => 'required|string|max:255',
        ], [
            // (Opcional) Mensagens personalizadas
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.unique'   => 'Este CPF já está em uso.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'required'     => 'O campo :attribute é obrigatório.'
        ]);

        // 2. Lógica de Salvamento (só executa se passar na validação acima)

        $endereco = new Enderecos();
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->cep = $request->cep;
        $endereco->bairro = $request->bairro;
        $endereco->save();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->password = Hash::make($request->password);
        $user->data_nascimento = $request->idade;
        $user->id_endereco = $endereco->id;

        $user->save();

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function authenticate(Request $request) {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credenciais)){
            $request->session()->regenerate();
            // return view('myprofile'); // Recomendado usar redirect para evitar reenvio de form
            return redirect()->route('myprofile'); // Supondo que exista uma rota nomeada assim
        } else {
            // Ajustei o withErrors para o formato padrão do Laravel
            return back()->withErrors([
                'email' => 'As credenciais fornecidas estão incorretas.',
            ])->onlyInput('email');
        }
    }
}
// class userControler extends Controller
// {
//     public function myprofile()
//     {
//     return view('myprofile');
//     }
//     // Função Página de Registro
//     public function registerPage(){
//         return view('registerPage');
//     }

//     // Função Registrar Usuario
//     public function store(Request $request){

//         // Função de Validação dos Campos
//         $validatedData = $request->validate([
//             // Usuario
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'cpf' => 'required|string|max:14|unique:users',
//             'password' => 'required|string|min:3|confirmed',
//             'data_nascimento' => 'required|date',
//             // Endereço
//             'rua' => 'required|string|max:255',
//             'numero' => 'required|string|max:10',
//             'cidade' => 'required|string|max:150',
//             'estado' => 'required|string|max:150',
//             'cep' => 'required|string|max:20',
//             'bairro' => 'required|string|max:150',
//         ]);

//         // Sanitização dos Dados
//         $nameLimpo = strip_tags($validatedData['name']);
//         $ruaLimpo = strip_tags($validatedData['rua']);
//         $cidadeLimpo = strip_tags($validatedData['cidade']);
//         $estadoLimpo = strip_tags($validatedData['estado']);
//         $bairroLimpo = strip_tags($validatedData['bairro']);

//         $cpfLimpo = preg_replace('/[^0-9]/', '', $validatedData['cpf']);
//         $cepLimpo = preg_replace('/[^0-9]/', '', $validatedData['cep']);

//         // Salva Endereço
//         $endereco= new Enderecos();
//         $endereco->rua = $ruaLimpo;
//         $endereco->numero = $validatedData['numero'];
//         $endereco->cidade = $cidadeLimpo;
//         $endereco->estado = $estadoLimpo;
//         $endereco->cep = $cepLimpo;
//         $endereco->bairro = $bairroLimpo;
//         $endereco->save();

//         // Salva Usuario
//         $user = new user();
//         $user->name = $nameLimpo;
//         $user->email = $validatedData['email'];
//         $user->cpf = $cpfLimpo;
//         $user->password = Hash::make($validatedData['password']);
//         $user->data_nascimento = $validatedData['data_nascimento'];
//         $user->id_endereco = $endereco->id;

//         $user->save();
//         return redirect()->route('login');
//     }
//     // Função Autenticar Usuario
//     public function authenticate(Request $request) {
//         $credenciais = $request->validate([
//             'email' => ['required','email'],
//             'password' => ['required']
//         ]);

//         if (Auth::attempt($credenciais)){
//             $request->session()->regenerate();
//             return redirect('/myprofile');
//         } else {
//             return redirect()->back()->withErrors('error', 'Login ou Senha Incorretos');
//         }
//     }
// }

