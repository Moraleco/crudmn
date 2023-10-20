<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
@extends('layouts.app')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('topbar')
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
                            <h5 class="h6 mb-3 text-gray-800">Cadastros > Clientes</h5>
                        </div>
                        <a href="{{ route('clientes.create') }}" class="btn btn-primary col-md-4"
                            style="margin: 10px !important">Novo Cliente</a>
                    </div>
                    <div class="card shadow mb-4 table-container">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table hover compact" id="myTable" width="100%" cellspacing="0">
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
                                        @foreach ($clientes as $cliente)
                                            <tr>
                                                <td>{{ $cliente->id }}</td>
                                                <td class="wider">{{ $cliente->nome }}</td>
                                                <td>{{ $cliente->telefone }}</td>
                                                <td>
                                                    @if ($cliente->cpf)
                                                        {{ $cliente->cpf }}
                                                    @elseif ($cliente->cnpj)
                                                        {{ $cliente->cnpj }}
                                                    @endif
                                                </td>
                                                <td>{{ $cliente->endereco->cidade }} - {{ $cliente->endereco->estado }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-link dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('clientes.show', $cliente) }}">Detalhes</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('clientes.edit', $cliente) }}">Editar</a>
                                                            <form action="{{ route('clientes.destroy', $cliente) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
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
            {{-- @include('footer') --}}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('#myTable').DataTable({
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
                
            },
            // lengthMenu: [5 , 10 , 25 , 50, 100],

        });
        
    </script>
    <style>
        .small-font {
            font-size: 14px;
            /* Tamanho da fonte menor */
        }

        .table-container {
            max-width: 100%;
            /* Ajuste a largura máxima conforme necessário */
            margin: 0 auto;
            /* Centraliza a tabela na página */
        }

        .wider {
            width: 300px;
            /* Largura personalizada para as colunas desejadas */
        }
    </style>
@endsection
