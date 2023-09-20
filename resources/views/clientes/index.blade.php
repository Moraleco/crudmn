@extends('layouts.app')

@section('content')

<div class="d-flex">
    @include('sidebar')
    <div class="container">
        <h1>Lista de Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary col-md-4 offset-md-8">Novo Cliente</a>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabela-clientes" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Documento</th>
                                <th>Endereço</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->telefone }}</td>
                                    <td>
                                        @if ($cliente->cpf)
                                            {{ $cliente->cpf }}
                                        @elseif ($cliente->cnpj)
                                            {{ $cliente->cnpj }}
                                        @endif
                                    </td>
                                    <td>{{ $cliente->endereco->cidade}} - {{ $cliente->endereco->estado}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <!-- Three-dots icon -->
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('clientes.show', $cliente) }}">Detalhes</a>
                                                <a class="dropdown-item" href="{{ route('clientes.edit', $cliente) }}">Editar</a>
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tabela-clientes').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese.json"
        }
    });
});
</script>
<style>
    /* Reduce padding inside table cells */
    table.table td {
        padding: 5px; /* You can adjust the padding value as needed */
    }
</style>

@endsection
