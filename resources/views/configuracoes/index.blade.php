@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Configurações da Empresa</h1>

    {{-- Mensagens de sucesso e erro --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulário --}}
    <div class="card shadow mb-4 border-left-primary">
        <div class="card-body">
            <form method="POST" action="{{ route('configuracoes.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome_empresa">Nome da Empresa</label>
                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" 
                               value="{{ old('nome_empresa', $configuracao->nome_empresa) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" 
                               value="{{ old('cnpj', $configuracao->cnpj) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" 
                               value="{{ old('telefone', $configuracao->telefone) }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $configuracao->email) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" 
                               value="{{ old('endereco', $configuracao->endereco) }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" 
                               value="{{ old('cidade', $configuracao->cidade) }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado" 
                               value="{{ old('estado', $configuracao->estado) }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" 
                               value="{{ old('cep', $configuracao->cep) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="logo">Logo da Empresa</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                    
                    @if (!empty($configuracao->logo))
                        <br>
                        <img src="{{ asset('img/logo/' . $configuracao->logo) }}" alt="Logo da Empresa" width="150">
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary">Salvar Configurações</button>
            </form>
        </div>
    </div>
</div>
@endsection
