@extends('layouts.app')

@section('content')

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
                            <td>
                                @php
                                    $servicosTexto = $orcamento->servicos->map(fn($s) => "{$s->descricao} (R$ ".number_format($s->valor, 2, ',', '.').")")->implode(', ');
                                @endphp
                                {{ strlen($servicosTexto) > 60 ? substr($servicosTexto, 0, 60) . '...' : $servicosTexto }}
                            </td>
                            <td>{{ number_format($orcamento->valor_final, 2, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusFormatado = strtolower(trim(str_replace([' ', 'ã', 'ç'], ['-', 'a', 'c'], $orcamento->status)));
                                @endphp
                                <span class="status-dot {{ $statusFormatado }}"></span>
                                {{ $orcamento->status }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item detalhes-btn"
                                        data-id="{{ $orcamento->id }}"
                                        data-cliente="{{ $orcamento->cliente->nome }}"
                                        data-status="{{ $orcamento->status }}"
                                        data-pagamento="{{ $orcamento->situacao_pagamento }}"
                                        data-servicos='@json($orcamento->servicos)'
                                        data-valor="{{ number_format($orcamento->valor_final, 2, '.', '') }}"
                                        data-outras-taxas="{{ number_format($orcamento->outras_taxas, 2, '.', '') }}"
                                        data-frete="{{ number_format($orcamento->frete, 2, '.', '') }}"
                                        data-desconto="{{ number_format($orcamento->desconto, 2, '.', '') }}"
                                        data-forma-pagamento="{{ $orcamento->forma_pagamento }}"
                                        data-toggle="modal" data-target="#detalhesModal">
                                        Detalhes
                                    </a>
                                    
                                        <a class="dropdown-item" href="{{ route('orcamentos.edit', $orcamento) }}">Editar</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#confirmDeleteModal-{{ $orcamento->id }}">Excluir</a>
                                        <a class="dropdown-item" href="{{ route('orcamentos.pdf', $orcamento) }}">Gerar PDF</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Modal de Confirmação de Exclusão -->
                        <div class="modal fade" id="confirmDeleteModal-{{ $orcamento->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
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
                        @endforeach
                        

    <!-- Modal de Detalhes -->
    <div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes da O.S.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Cliente:</strong> <span id="detalhes-cliente"></span></p>
                    <p><strong>Status:</strong> <span id="detalhes-status"></span></p>
                    <p><strong>Pagamento:</strong> <span id="detalhes-pagamento"></span></p>
                    <hr>
                    <h5>Serviços</h5>
                    <ul id="detalhes-servicos"></ul>
                    <hr>
                    <p><strong>Forma de Pagamento:</strong> <span id="detalhes-forma-pagamento"></span></p>
                    <p><strong>Outras Taxas:</strong> R$ <span id="detalhes-outras-taxas"></span></p>
                    <p><strong>Valor do Frete:</strong> R$ <span id="detalhes-frete"></span></p>
                    <p><strong>Desconto:</strong> R$ <span id="detalhes-desconto"></span></p>
                    <p><strong>Valor Final:</strong> R$ <span id="detalhes-valor"></span></p>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Script para carregar os detalhes no modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".detalhes-btn").forEach(button => {
                button.addEventListener("click", function () {
                    document.getElementById("detalhes-cliente").textContent = this.getAttribute("data-cliente");
                    document.getElementById("detalhes-status").textContent = this.getAttribute("data-status");
                    document.getElementById("detalhes-pagamento").textContent = this.getAttribute("data-pagamento");
                    document.getElementById("detalhes-valor").textContent = parseFloat(this.getAttribute("data-valor")).toFixed(2);
                    document.getElementById("detalhes-outras-taxas").textContent = parseFloat(this.getAttribute("data-outras-taxas")).toFixed(2);
                    document.getElementById("detalhes-frete").textContent = parseFloat(this.getAttribute("data-frete")).toFixed(2);
                    document.getElementById("detalhes-desconto").textContent = parseFloat(this.getAttribute("data-desconto")).toFixed(2);
                    document.getElementById("detalhes-forma-pagamento").textContent = this.getAttribute("data-forma-pagamento");

                    let servicos = JSON.parse(this.getAttribute("data-servicos"));
                    let servicosList = document.getElementById("detalhes-servicos");
                    servicosList.innerHTML = "";
                    servicos.forEach(servico => {
                        let li = document.createElement("li");
                        li.textContent = `${servico.descricao} - R$ ${parseFloat(servico.valor).toFixed(2)}`;
                        servicosList.appendChild(li);
                    });
                });
            });
        });
    </script>

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
                paginate: {
                    next: 'Próximo',
                    previous: 'Anterior',
                    first: 'Primeiro',
                    last: 'Último',
                }
            }
        });
    </script>

    <style>
        table.table td {
            padding: 5px;
        }

        .status-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .aguardando-autorizacao { background-color: yellow; }
        .autorizado { background-color: #1cc88a; }
        .recusado { background-color: #e74a3b; }
        .finalizado { background-color: #4e73df; }
    </style>

@endsection
