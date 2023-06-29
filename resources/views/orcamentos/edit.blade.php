@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Orçamento</h1>

        <form action="{{ route('orcamentos.update', $orcamento) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" class="form-control">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $cliente->id == $orcamento->cliente_id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="servicos">Serviços:</label>
                <input type="text" name="servicos" id="servicos" class="form-control" value="{{ $orcamento->servicos }}" required>
            </div>

            <div class="form-group">
                <label for="desconto">Desconto:</label>
                <input type="number" name="desconto" id="desconto" class="form-control" step="0.01" value="{{ $orcamento->desconto }}" required>
            </div>

            <div class="form-group">
                <label for="frete">Frete:</label>
                <input type="number" name="frete" id="frete" class="form-control" step="0.01" value="{{ $orcamento->frete }}" required>
            </div>

            <div class="form-group">
                <label for="outras_taxas">Outras Taxas:</label>
                <input type="number" name="outras_taxas" id="outras_taxas" class="form-control" step="0.01" value="{{ $orcamento->outras_taxas }}" required>
            </div>

            <div class="form-group">
                <label for="forma_pagamento">Forma de Pagamento:</label>
                <input type="text" name="forma_pagamento" id="forma_pagamento" class="form-control" value="{{ $orcamento->forma_pagamento }}" required>
            </div>

            <div class="form-group">
                <label for="informacoes_adicionais">Informações Adicionais:</label>
                <textarea name="informacoes_adicionais" id="informacoes_adicionais" class="form-control">{{ $orcamento->informacoes_adicionais }}</textarea>
            </div>

            <div class="form-group">
                <label for="valor_final">Valor Final:</label>
                <input type="number" name="valor_final" id="valor_final" class="form-control" step="0.01" value="{{ $orcamento->valor_final }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
