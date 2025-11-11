<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User; 
use Illuminate\Support\Facades\DB; 
use App\Models\Endereco; 

class UserController extends Controller
{
   
    public function index()
    {
        //consulta com join das tabelas users e enderecos, e seleciona todos dados das tabelas users e enderecos 
       $user = DB::table('users')
       ->join('enderecos', 'users.end_id', '=', 'enderecos.id')
       ->select('users.*',
       'enderecos.*')
       ->get();
        //retorna para a view index, onde 'users' vai receber o valor da variavel $users
        return view('users.index', ['user' => $user]);
    }

   
    public function create()
    {
        //retorna para a view create
       return view('users.create');
    }

   
    public function store(UserRequest $request)
    {
        

        //Acessa o model endereco e cria os campos referente a tabela enderecos e utiliza a variavel $request para validação
        $endereco = Endereco::create ([
            
            'road' => $request -> road,
            'neighborhood' => $request -> neighborhood,
            'number' => $request -> number,
        ]);
       
         //Acessa o model user e cria os campos referente a tabela users e utiliza a variavel $request para validação
        User::create ([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'email' => $request -> email,
            'age' => $request -> age,
            'password' => $request -> password,
            'end_id' => $endereco->id,
        ]);
       
        //redireciona para a rota index, e apresenta a mensagem de sucesso 
        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');

          
    }
   

    public function show(User $user)
    
    {
        //seleciona todos dados das tabelas users e enderecos, onde users.id for igual ao id da variavel $user
        $user::select('users.*', 'enderecos.*')
        ->where('users.id', '=', $user->id)
        ->join('enderecos', 'enderecos.id', 'users.end_id')
        ->first();
       
        //retornar para a view show, onde 'user' vai receber o valor dos dados da variavel '$user'
        return view('users.show', ['user' => $user]);
    }

    
    public function edit(User $user)
    {
      //retorna para a view edit
        return view('users.edit', ['user' => $user]);
        
        
    }

    
    public function update(UserRequest $request, $id)
    {
        //busca o id caso não encontrar da erro
        $user = User::findOrFail($id);

        //atualiza os dados da tabela users
        $user -> update ([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'age' => $request -> age,
            'email' => $request -> email,
            'password' => $request -> password,
           
            
        ]);

        //atualiza os dados da tabela enderecos
        $user->endereco->update([
        'road' => $request->road,
        'neighborhood' => $request->neighborhood,
        'number' => $request->number,
    ]);

        //redireciona para a rota show, preenche o 'user' com o id da variavel $user, e apresenta uma mensagem de sucesso
         return redirect()->route('users.show', ['user' => $user -> id])->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        // Deleta o endereço associado ao usuário antes de deletar o próprio usuário
        if ($user->endereco) {
            $user->endereco->delete();
        }
        
        // Agora deleta o usuário
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
