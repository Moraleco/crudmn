@extends('layouts.app')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Relatórios de Ordens de Serviço</h1>

                    {{-- Formulário de Filtros --}}
                    <div class="card shadow mb-4 border-left-primary">
                        <div class="card-body">
                            <form method="GET" action="{{ route('relatorios.index') }}">
                                <div class="row">
                                    {{-- Data de Criação --}}
                                    <div class="col-md-3">
                                        <label for="data_inicio">Data de Criação (Início)</label>
                                        <input type="date" name="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="data_fim">Data de Criação (Fim)</label>
                                        <input type="date" name="data_fim" class="form-control" value="{{ request('data_fim') }}">
                                    </div>

                                    {{-- Cliente --}}
                                    <div class="col-md-3">
                                        <label for="cliente_id">Cliente</label>
                                        <select name="cliente_id" class="form-control">
                                            <option value="">Todos</option>
                                            @foreach($clientesDisponiveis as $cliente)
                                                <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Forma de Pagamento --}}
                                    <div class="col-md-3">
                                        <label for="forma_pagamento">Forma de Pagamento</label>
                                        <select name="forma_pagamento" class="form-control">
                                            <option value="">Todas</option>
                                            <option value="Pix" {{ request('forma_pagamento') == 'Pix' ? 'selected' : '' }}>Pix</option>
                                            <option value="Dinheiro" {{ request('forma_pagamento') == 'Dinheiro' ? 'selected' : '' }}>Dinheiro</option>
                                            <option value="Cartão de Crédito" {{ request('forma_pagamento') == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                            <option value="Boleto Bancário" {{ request('forma_pagamento') == 'Boleto Bancário' ? 'selected' : '' }}>Boleto Bancário</option>
                                            <option value="Transferência Bancária" {{ request('forma_pagamento') == 'Transferência Bancária' ? 'selected' : '' }}>Transferência Bancária</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    {{-- Serviço --}}
                                    <div class="col-md-3">
                                        <label for="servico">Serviço</label>
                                        <input type="text" name="servico" class="form-control" value="{{ request('servico') }}">
                                    </div>

                                    {{-- Status da O.S. --}}
                                    <div class="col-md-3">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Todos</option>
                                            <option value="Aguardando Autorização" {{ request('status') == 'Aguardando Autorização' ? 'selected' : '' }}>Aguardando Autorização</option>
                                            <option value="Autorizado" {{ request('status') == 'Autorizado' ? 'selected' : '' }}>Autorizado</option>
                                            <option value="Recusado" {{ request('status') == 'Recusado' ? 'selected' : '' }}>Recusado</option>
                                            <option value="Finalizado" {{ request('status') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                        </select>
                                    </div>

                                    {{-- Situação de Pagamento --}}
                                    <div class="col-md-3">
                                        <label for="situacao_pagamento">Situação de Pagamento</label>
                                        <select name="situacao_pagamento" class="form-control">
                                            <option value="">Todas</option>
                                            <option value="A Pagar" {{ request('situacao_pagamento') == 'A Pagar' ? 'selected' : '' }}>A Pagar</option>
                                            <option value="Pago" {{ request('situacao_pagamento') == 'Pago' ? 'selected' : '' }}>Pago</option>
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </form>
                        </div>
                    </div>

                    {{-- Seção de Resumo --}}
                    <div class="card shadow mb-4 border-left-success">
                        <div class="card-body">
                            <h4>Resumo</h4>
                            <p><strong>Total de Clientes Cadastrados:</strong> {{ $totalClientes ?? 0 }}</p>
                            <p><strong>Total de O.S Criadas:</strong> {{ $totalOrcamentos ?? 0 }}</p>
                            <p><strong>Valor Total das O.S:</strong> R$ {{ number_format($valorTotalOrcamentos ?? 0, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Lista de Ordens de Serviço com DataTables --}}
                    @if(isset($listaOrcamentos) && $listaOrcamentos->isNotEmpty())
                        <div class="card shadow mb-4 table-container border-left-warning">
                            <div class="card-body">
                                <h4>Ordens de Serviço</h4>
                                <div class="table-responsive">
                                    <table class="table hover compact" id="orcamentosTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Cliente</th>
                                                <th>Serviço</th>
                                                <th>Status</th>
                                                <th>Forma de Pagamento</th>
                                                <th>Situação Pagamento</th>
                                                <th>Valor Final</th>
                                                <th>Data de Criação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listaOrcamentos as $orcamento)
                                            <tr>
                                                <td>{{ $orcamento->id }}</td>
                                                <td>{{ $orcamento->cliente->nome ?? 'Não informado' }}</td>
                                                <td>{{ $orcamento->servicos }}</td>
                                                <td>{{ $orcamento->status }}</td>
                                                <td>{{ $orcamento->forma_pagamento }}</td>
                                                <td>{{ $orcamento->situacao_pagamento }}</td>
                                                <td>R$ {{ number_format($orcamento->valor_final, 2, ',', '.') }}</td>
                                                <td>{{ $orcamento->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Scripts do DataTables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#orcamentosTable').DataTable({
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    paginate: { previous: "Anterior", next: "Próximo" }
                }
            });
        });
    </script>
@endsection
