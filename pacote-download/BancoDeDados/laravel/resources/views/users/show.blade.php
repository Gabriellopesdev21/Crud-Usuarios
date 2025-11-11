@extends('layouts.master')

@section('title', 'Visualizar Usuário')

@section('content')
<div class="container mt-4" >
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Visualizar Usuário</h2>

        <div class="btn-group" role="group" aria-label="Ações">
            <a href="{{ route('users.index') }}" class="btn btn-secondary me-1"> Voltar</a>
            
            <a href="{{ route('users.edit', $user->id ) }}" class="btn btn-warning me-1">Editar</a>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger me-1"
                        onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                    Apagar
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Dados do usuário</h5>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">ID</div>
                <div class="col-sm-9">{{ $user->id }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Nome</div>
                <div class="col-sm-9">{{ $user->name }}</div>
            </div>


            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Sobrenome</div>
                <div class="col-sm-9">{{ $user->surname }}</div>
            </div>

            

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Idade</div>
                <div class="col-sm-9"> {{ $user->age }}</div>
            </div>
           
            <div class="row mb-2">
                <div class="col-sm-3 text-muted">E-mail</div>
                <div class="col-sm-9">{{ $user->email }}</div>
            </div>


            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Rua</div>
                <div class="col-sm-9">{{ $user->endereco->road }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Bairro</div>
                <div class="col-sm-9">{{ $user->endereco->neighborhood }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Número</div>
                <div class="col-sm-9">{{ $user->endereco->number }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Cadastrado</div>
                <div class="col-sm-9">
                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Atualizado</div>
                <div class="col-sm-9">
                    {{ $user->updated_at ? $user->updated_at->format('d/m/Y') : '-' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
