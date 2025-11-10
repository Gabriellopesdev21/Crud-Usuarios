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
       $users = DB::table('users')
       ->join('enderecos', 'users.end_id', '=', 'enderecos.id')
       ->select('users.*',
       'enderecos.*')
       ->get();
        //retorna para a view index, onde 'users' vai receber o valor da variavel $users
        return view('users.index', ['users' => $users]);
    }

   
    public function create()
    {
        //retorna para a view create
       return view('users.create');
    }

   
    public function store(UserRequest $request)
    {
        

      //
        $endereco = Endereco::create ([
            
            'road' => $request -> road,
            'neighborhood' => $request -> neighborhood,
            'number' => $request -> number,
        ]);
       
        
        User::create ([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'email' => $request -> email,
            'age' => $request -> age,
            'password' => $request -> password,
            'end_id' => $endereco->id,
        ]);
       

        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');

          
    }
   

    public function show(User $user)
    
    {
        $user::select('users.*', 'enderecos.*')
        ->where('users.id', '=', $user->id)
        ->join('enderecos', 'enderecos.id', 'users.end_id')
        ->first();
       
        
        return view('users.show', ['user' => $user]);
    }

    
    public function edit(User $user)
    {
      
        return view('users.edit', ['user' => $user]);
        
        
    }

    
    public function update(UserRequest $request, $id)
    {
        
        $user = User::findOrFail($id);
        
        $user -> update ([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'age' => $request -> age,
            'email' => $request -> email,
            'password' => $request -> password,
           
            
        ]);

        $user->endereco->update([
        'road' => $request->road,
        'neighborhood' => $request->neighborhood,
        'number' => $request->number,
    ]);


         return redirect()->route('users.show', ['user' => $user -> id])->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
       

         return redirect()->route('users.index', ['user' => $user -> id])->with('success', 'Usuário deletado com sucesso!');
    }
}
