@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-lg mb-5 border-left-primary">
            <div class="card-header py-4">
                <h1 class="display-4 text-center">Editar Orçamento</h1>
            </div>
            <div class="card-body pb-5">
                <form action="{{ route('orcamentos.update', $orcamento) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Primeira Linha: Cliente e Status -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card shadow-lg mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cliente</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="cliente_id">Selecione o Cliente:</label>
                                        <select name="cliente_id" id="cliente_id" class="form-control js-example-basic-single" required>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->id }}" {{ $cliente->id == $orcamento->cliente_id ? 'selected' : '' }}>
                                                    {{ $cliente->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow-lg mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="status">Situação do Orçamento:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach ($status as $situacao)
                                                <option value="{{ $situacao }}" {{ $orcamento->status == $situacao ? 'selected' : '' }}>
                                                    {{ $situacao }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="situacao_pagamento">Situação do Pagamento:</label>
                                        <select name="situacao_pagamento" id="situacao_pagamento" class="form-control" required>
                                            @foreach ($situacao_pagamento as $pagamento)
                                                <option value="{{ $pagamento }}" {{ $orcamento->situacao_pagamento == $pagamento ? 'selected' : '' }}>
                                                    {{ $pagamento }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda Linha: Serviços -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-lg mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Serviços</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="servicos">Descrição dos Serviços:</label>
                                            <textarea name="servicos" id="servicos" class="form-control" rows="4" required>{{ $orcamento->servicos }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="informacoes_adicionais">Informações Adicionais (Opcional):</label>
                                            <textarea name="informacoes_adicionais" id="informacoes_adicionais" class="form-control" rows="4">{{ $orcamento->informacoes_adicionais }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terceira Linha: Pagamento -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-lg mb-4 border-left-primary">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Pagamento</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="valor_do_servico">Valor do Serviço:</label>
                                            <input type="number" name="valor_do_servico" id="valor_do_servico" class="form-control" step="0.01" value="{{ $orcamento->valor_do_servico ?? 0.00 }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="outras_taxas">Outras Taxas:</label>
                                            <input type="number" name="outras_taxas" id="outras_taxas" class="form-control" step="0.01" value="{{ $orcamento->outras_taxas ?? 0.00 }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="frete">Valor do Frete:</label>
                                            <input type="number" name="frete" id="frete" class="form-control" step="0.01" value="{{ $orcamento->frete ?? 0.00 }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="desconto">Desconto:</label>
                                            <input type="number" name="desconto" id="desconto" class="form-control" step="0.01" value="{{ $orcamento->desconto ?? 0.00 }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="forma_pagamento">Forma de Pagamento:</label>
                                            <select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
                                                @foreach ($forma_pagamento as $forma)
                                                    <option value="{{ $forma }}" {{ $orcamento->forma_pagamento == $forma ? 'selected' : '' }}>
                                                        {{ $forma }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="valor_final">Valor Final:</label>
                                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="valor_final" value="{{ $orcamento->valor_final ?? 0.00 }}">
                                        <input type="hidden" name="valor_final" id="valor_final_hidden" value="{{ $orcamento->valor_final ?? 0.00 }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="row">
                        <button type="submit" class="btn btn-success col-md-4 offset-md-8 py-3">Salvar Alterações</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });

    document.addEventListener('DOMContentLoaded', function () {
        const descontoInput = document.getElementById('desconto');
        const freteInput = document.getElementById('frete');
        const outrasTaxasInput = document.getElementById('outras_taxas');
        const valorDoServicoInput = document.getElementById('valor_do_servico');
        const valorFinalInput = document.getElementById('valor_final');
        const valorFinalHiddenInput = document.getElementById('valor_final_hidden');

        function calcularValorFinal() {
            const desconto = parseFloat(descontoInput.value) || 0;
            const frete = parseFloat(freteInput.value) || 0;
            const outrasTaxas = parseFloat(outrasTaxasInput.value) || 0;
            const valorDoServico = parseFloat(valorDoServicoInput.value) || 0;
            const valorFinal = valorDoServico + frete + outrasTaxas - desconto;
            valorFinalInput.value = valorFinal.toFixed(2);
            valorFinalHiddenInput.value = valorFinal.toFixed(2);
        }

        [descontoInput, freteInput, outrasTaxasInput, valorDoServicoInput].forEach(input => {
            input.addEventListener('input', calcularValorFinal);
        });

        calcularValorFinal();
    });
</script>
@endsection
