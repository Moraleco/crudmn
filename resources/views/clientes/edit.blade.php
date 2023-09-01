<!-- resources/views/clientes/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="d-flex">
    @section('sidebar')
    <div class="container">
        <h1>Editar Cliente</h1>
        <form action="{{ route('clientes.update', $cliente) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $cliente->telefone }}" required>
            </div>
            <div class="form-group">
                <label for="documento">Documento</label>
                <input type="text" class="form-control" id="documento" name="documento" value="{{ $cliente->documento }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
</div>

