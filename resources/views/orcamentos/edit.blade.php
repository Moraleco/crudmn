@extends('layouts.app')

@section('content')
    <div class="d-flex">
        <div class="container">
            <div class="">
                <div class="card-body pb-5">
                    <form action="{{ route('orcamentos.update', $orcamento->id) }}" method="POST">
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
                                            <select name="cliente_id" id="cliente_id"
                                                class="form-control js-example-basic-single" required>
                                                @foreach ($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}" 
                                                        {{ $orcamento->cliente_id == $cliente->id ? 'selected' : '' }}>
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
                                                    <option value="{{ $situacao }}" 
                                                        {{ $orcamento->status == $situacao ? 'selected' : '' }}>
                                                        {{ $situacao }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="situacao_pagamento">Situação do Pagamento:</label>
                                            <select name="situacao_pagamento" id="situacao_pagamento" class="form-control"
                                                required>
                                                @foreach ($situacao_pagamento as $pagamento)
                                                    <option value="{{ $pagamento }}" 
                                                        {{ $orcamento->situacao_pagamento == $pagamento ? 'selected' : '' }}>
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
                        <div class="card shadow-lg mb-4 border-left-primary">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Serviços</h6>
                            </div>
                            <div class="card-body">
                                <div id="servicos-container">
                                    @foreach ($orcamento->servicos as $index => $servico)
                                        <div class="row servico-item">
                                            <div class="col-md-6">
                                                <label>Descrição do Serviço:</label>
                                                <input type="text" name="servicos[{{ $index }}][descricao]" 
                                                    class="form-control" 
                                                    value="{{ $servico->descricao }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Valor:</label>
                                                <input type="number" name="servicos[{{ $index }}][valor]" 
                                                    class="form-control" step="0.01"
                                                    value="{{ $servico->valor }}" required>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-servico">X</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary mt-3" id="add-servico">+ Adicionar Serviço</button>
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
                                            <div class="form-group col-md-2">
                                                <label for="valor_do_servico">Valor do Serviço:</label>
                                                <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                                    id="valor_do_servico" value="{{ $orcamento->valor_do_servico }}">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="outras_taxas">Outras Taxas:</label>
                                                <input type="number" name="outras_taxas" id="outras_taxas"
                                                    class="form-control" step="0.01" value="{{ $orcamento->outras_taxas }}">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="frete">Valor do Frete:</label>
                                                <input type="number" name="frete" id="frete" class="form-control"
                                                    step="0.01" value="{{ $orcamento->frete }}">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="desconto">Desconto:</label>
                                                <input type="number" name="desconto" id="desconto" class="form-control"
                                                    step="0.01" value="{{ $orcamento->desconto }}">
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="forma_pagamento">Forma de Pagamento:</label>
                                                <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                                                    @foreach ($forma_pagamento as $forma)
                                                        <option value="{{ $forma }}" 
                                                            {{ $orcamento->forma_pagamento == $forma ? 'selected' : '' }}>
                                                            {{ $forma }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="valor_final">Valor Final:</label>
                                                <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                                    id="valor_final" value="{{ $orcamento->valor_final }}">
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="row">
                            <button type="submit" class="btn btn-success col-md-4 offset-md-8 py-3">Salvar Orçamento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let servicoIndex = 1;

            document.getElementById("add-servico").addEventListener("click", function () {
                const container = document.getElementById("servicos-container");

                const newServico = `
<div class="row servico-item">
    <div class="col-md-6">
        <label>Descrição do Serviço:</label>
        <input type="text" name="servicos[${servicoIndex}][descricao]" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label>Valor:</label>
        <input type="number" name="servicos[${servicoIndex}][valor]" class="form-control" step="0.01" value="0.00"required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button type="button" class="btn btn-danger remove-servico">X</button>
    </div>
</div>
`;

                container.insertAdjacentHTML("beforeend", newServico);
                servicoIndex++;
            });

            document.getElementById("servicos-container").addEventListener("click", function (event) {
                if (event.target.classList.contains("remove-servico")) {
                    event.target.closest(".servico-item").remove();
                }
            });
        });
    </script>
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

        function calcularValorDoServico() {
            let total = 0;
            document.querySelectorAll('input[name^="servicos"][name$="[valor]"]').forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            valorDoServicoInput.value = total.toFixed(2);
            calcularValorFinal(); // Atualiza o valor final
        }

        function calcularValorFinal() {
            const desconto = parseFloat(descontoInput?.value) || 0;
            const frete = parseFloat(freteInput?.value) || 0;
            const outrasTaxas = parseFloat(outrasTaxasInput?.value) || 0;
            const valorDoServico = parseFloat(valorDoServicoInput?.value) || 0;
            const valorFinal = valorDoServico + frete + outrasTaxas - desconto;

            if (valorFinalInput) valorFinalInput.value = valorFinal.toFixed(2);
            if (valorFinalHiddenInput) valorFinalHiddenInput.value = valorFinal.toFixed(2);
        }

        [descontoInput, freteInput, outrasTaxasInput].forEach(input => {
            if (input) {
                input.addEventListener('input', calcularValorFinal);
            }
        });

        const servicosContainer = document.getElementById("servicos-container");
        if (servicosContainer) {
            servicosContainer.addEventListener("input", function (event) {
                if (event.target.name && event.target.name.includes("[valor]")) {
                    calcularValorDoServico();
                }
            });

            servicosContainer.addEventListener("click", function (event) {
                if (event.target.classList.contains("remove-servico")) {
                    event.target.closest(".servico-item").remove();
                    calcularValorDoServico();
                }
            });
        }

        calcularValorDoServico();
        calcularValorFinal();
    });
</script>

@endsection
