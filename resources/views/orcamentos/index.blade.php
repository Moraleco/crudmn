<!-- resources/views/orcamentos/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('sidebar')
    <div class="container">
        <h1>Lista de Orçamentos</h1>
        <a class="btn btn-primary mb-3" href="{{ route('orcamentos.create') }}">Criar Novo Orçamento</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Serviços</th>
                    <th>Valor Final</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orcamentos as $orcamento)
                    <tr>
                        <td>{{ $orcamento->id }}</td>
                        <td>{{ $orcamento->cliente->nome }}</td>
                        <td>{{ $orcamento->servicos }}</td>
                        <td>{{ $orcamento->valor_final }}</td>
                        <td>
                            <a href="{{ route('orcamentos.show', $orcamento) }}" class="btn btn-primary btn-sm">Ver</a>
                            <a href="{{ route('orcamentos.edit', $orcamento) }}" class="btn btn-info btn-sm">Editar</a>
                            <form action="{{ route('orcamentos.destroy', $orcamento) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                            <a href="{{ route('orcamentos.pdf', $orcamento) }}" class="btn btn-success btn-sm">Gerar PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
