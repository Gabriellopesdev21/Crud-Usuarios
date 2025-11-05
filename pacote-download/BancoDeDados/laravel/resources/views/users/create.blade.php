@extends('layouts.master')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="container mt-4" >
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Cadastrar Usuário</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary"> Voltar</a>
    </div>

    {{-- Mensagens de erro --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <h5 class="alert-heading">Erros encontrados:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de cadastro --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control" 
                        placeholder="Digite seu primeiro nome"
                        value="{{ old('name') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label"> Sobrenome</label>
                    <input 
                        type="text" 
                        name="surname" 
                        id="surname" 
                        class="form-control" 
                        placeholder="Digite seu sobrenome"
                        value="{{ old('surname') }}"
                        required>
                </div>

                 <div class="mb-3">
                    <label for="age" class="form-label">Idade</label>
                    <input 
                        type="int" 
                        name="age" 
                        id="age" 
                        class="form-control" 
                        placeholder="Digite sua idade"
                        value="{{ old('age') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        placeholder="Digite seu melhor e-mail"
                        value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="road" class="form-label">Rua</label>
                    <input 
                        type="string" 
                        name="road" 
                        id="road" 
                        class="form-control" 
                        placeholder="Digite o nome da sua rua"
                        value="{{ old('road') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input 
                        type="string" 
                        name="neighborhood" 
                        id="neighborhood" 
                        class="form-control" 
                        placeholder="Digite o nome do seu bairro"
                        value="{{ old('neighborhood') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Número</label>
                    <input 
                        type="int" 
                        name="number" 
                        id="number" 
                        class="form-control" 
                        placeholder="Digite o número de sua casa"
                        value="{{ old('number') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control" 
                        placeholder="Digite sua senha"
                        required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
