@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('sidebar')
    <div class="container">
        <h1>Detalhes do Orçamento</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Cliente: {{ $orcamento->cliente->nome }}</h5>
                <p class="card-text">Serviços: {{ $orcamento->servicos }}</p>
                <p class="card-text">Desconto: {{ $orcamento->desconto }}</p>
                <p class="card-text">Frete: {{ $orcamento->frete }}</p>
                <p class="card-text">Outras Taxas: {{ $orcamento->outras_taxas }}</p>
                <p class="card-text">Forma de Pagamento: {{ $orcamento->forma_pagamento }}</p>
                <p class="card-text">Informações Adicionais: {{ $orcamento->informacoes_adicionais }}</p>
                <p class="card-text">Valor Final: {{ $orcamento->valor_final }}</p>
            </div>
        </div>

        <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
