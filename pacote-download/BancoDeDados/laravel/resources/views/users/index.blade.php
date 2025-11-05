@extends('layouts.master')

@section('title', 'Listar Usuários')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Listar Usuários</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success"> Cadastrar</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

@if($users->count() > 0)
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Idade</th>
                        <th>Email</th>
                        <th>Endereço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->email }}</td>
                             <td>{{ $user->road . ' ' . $user->neighborhood . ' ' . $user->number }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                        Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-secondary text-center mt-3">
        Nenhum usuário encontrado.
    </div>
@endif
@endsection
