<!-- resources/views/orcamentos/index.blade.php -->
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('sidebar')
    <div class="flex-grow-1">
        @include('topbar')
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2 text-gray-800">Lista de Orçamentos</h1>
                    <h5 class="h6 mb-3 text-gray-800">Ordem de serviço > Orçamentos</h5>
                </div>
                <a href="{{ route('orcamentos.create') }}" class="btn btn-primary col-md-4">Criar Novo Orçamento</a>
            </div>
            <div class="card shadow mb-4">
                <div class="table-responsive">
                    <div class="card-body">
                        <table class="table" id="tabela-orcamentos">
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
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ações
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('orcamentos.show', $orcamento) }}" class="dropdown-item">Ver</a>
                                                    <a href="{{ route('orcamentos.edit', $orcamento) }}" class="dropdown-item">Editar</a>
                                                    <form action="{{ route('orcamentos.destroy', $orcamento) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                                    </form>
                                                    <a href="{{ route('orcamentos.pdf', $orcamento) }}" class="dropdown-item">Gerar PDF</a>
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
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$('#tabela-orcamentos').DataTable({
    language: {
        info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
        infoEmpty: 'Nenhum registro disponível',
        infoFiltered: '(filtrado de _MAX_ registros no total)',
        lengthMenu: 'Mostrar _MENU_ registros por página',
        zeroRecords: 'Nenhum registro encontrado',
        search: 'Buscar',
        paginate:{
            next: 'Próximo',
            previous:'Anterior',
            first:'Primeiro',
            last:'Last',
        }
        
    }
});

</script>
<style>
    /* Reduce padding inside table cells */
    table.table td {
        padding: 5px; /* You can adjust the padding value as needed */
    }
</style>

@endsection
