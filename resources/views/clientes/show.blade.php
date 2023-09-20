<!-- resources/views/clientes/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Cliente</h1>
        <div class="card">
            <div class="card-header">{{ $cliente->nome }}</div>
            <div class="card-body">
                <p>Telefone: {{ $cliente->telefone }}</p>
                <p>Documento: {{ $cliente->documento }}</p>
                <p>Endereço: {{ $cliente->endereco->cep }}</p>
            </div>
        </div>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
