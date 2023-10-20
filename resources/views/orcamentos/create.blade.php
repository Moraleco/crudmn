@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('sidebar')
        <div class="container">
            <h1>Criar Novo Orçamento</h1>

            <form action="{{ route('orcamentos.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="cliente_id">Cliente:</label>
                    <select name="cliente_id" id="cliente_id" class="form-control">
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="servicos">Serviços:</label>
                    <input type="text" name="servicos" id="servicos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="informacoes_adicionais">Informações Adicionais:</label>
                    <textarea name="informacoes_adicionais" id="informacoes_adicionais" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <textarea name="status" id="status" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="situacao_pagamento">Sitaução do Pagamento:</label>
                    <select name="situacao_pagamento" id="situacao_pagamento" class="form-control" required>
                        @foreach ($situacao_pagamento as $pagamento)
                        <option value="{{ $pagamento }}">{{ $pagamento }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Transporte</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse " id="collapseCardExample">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="frete">Frete:</label>
                                <input type="number" name="frete" id="frete" class="form-control" step="0.01"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card shadow mb-4 border-left-primary">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pagamento</h6>
                    </div>
                    <div class="card-body">


                        <div class="form-group">
                            <label for="valor_do_servico">Valor do Serviço:</label>
                            <input type="number" name="valor_do_servico" id="valor_do_servico" class="form-control"
                                step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="outras_taxas">Outras Taxas:</label>
                            <input type="number" name="outras_taxas" id="outras_taxas" class="form-control" step="0.01"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento:</label>
                            <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                                @foreach ($forma_pagamento as $forma)
                                    <option value="{{ $forma }}">{{ $forma }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="desconto">Desconto:</label>
                            <input type="number" name="desconto" id="desconto" class="form-control" step="0.01"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="valor_final">Valor Final:</label>
                            <input type="number" name="valor_final" id="valor_final" class="form-control" step="0.01"
                                required>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descontoInput = document.getElementById('desconto');
            const freteInput = document.getElementById('frete');
            const outrasTaxasInput = document.getElementById('outras_taxas');
            const valorDoServicoInput = document.getElementById('valor_do_servico');
            const valorFinalInput = document.getElementById('valor_final');

            [descontoInput, freteInput, outrasTaxasInput, valorDoServicoInput].forEach(function(input) {
                input.addEventListener('input', calcularValorFinal);
            });

            function calcularValorFinal() {
                const desconto = parseFloat(descontoInput.value) || 0;
                const frete = parseFloat(freteInput.value) || 0;
                const outrasTaxas = parseFloat(outrasTaxasInput.value) || 0;
                const valorDoServico = parseFloat(valorDoServicoInput.value) || 0;
                const valorFinal = valorDoServico + frete + outrasTaxas - desconto;
                valorFinalInput.value = valorFinal.toFixed(2);
            }

            // Calcular o valor final inicialmente
            calcularValorFinal();
        });
    </script>
@endsection
