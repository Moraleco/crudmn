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
            
            <div class="card shadow mb-4 table-container border-left-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table hover compact" id="tabela-orcamentos" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Serviços</th>
                                    <th>Valor Final</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orcamentos as $orcamento)
                                    <tr>
                                        <td>{{ $orcamento->id }}</td>
                                        <td class="wider">{{ $orcamento->cliente->nome }}</td>
                                        <td>{{ $orcamento->servicos }}</td>
                                        <td>{{ $orcamento->valor_final }}</td>
                                        <td>
                                            @php
                                                // Normaliza o nome do status para corresponder às classes CSS
                                                $statusFormatado = strtolower(trim(str_replace([' ', 'ã', 'ç'], ['-', 'a', 'c'], $orcamento->status)));
                                            @endphp
                                        
                                            <span class="status-dot {{ $statusFormatado }}"></span>
                                            {{ $orcamento->status }}
                                        </td>
                                        
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu animated--fade-in"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('orcamentos.show', $orcamento) }}">Detalhes</a>
                                                    <a class="dropdown-item" href="{{ route('orcamentos.edit', $orcamento) }}">Editar</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmDeleteModal-{{ $orcamento->id }}">Excluir</a>
                                                    <a class="dropdown-item" href="{{ route('orcamentos.pdf', $orcamento) }}">Gerar PDF</a>
                                                </div>
                                            </div>

                                            <!-- Modal de Confirmação de Exclusão -->
                                            <div class="modal fade" id="confirmDeleteModal-{{ $orcamento->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tem certeza que deseja excluir este orçamento?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('orcamentos.destroy', $orcamento) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Excluir</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim do Modal -->
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
            last:'Último',
        }
    }
});
</script>

<style>
    /* Estilizando a tabela */
    table.table td {
        padding: 5px;
    }

/* Estilo da bolinha de status */
.status-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 5px;
}

/* Cores baseadas no status */
.aguardando-autorizacao { background-color: yellow; }
.autorizado { background-color: green; }
.recusado { background-color: red; }
.finalizado { background-color: blue; }


  
</style>

@endsection
