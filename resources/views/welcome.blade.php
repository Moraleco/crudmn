@extends('layouts.app')

@section('content')

<div class="d-flex" id="page-top">  
    <div class="flex-grow-1">
        <div class="container-fluid">
            <div class="jumbotron">
                <h1 class="display-4">Bem-vindo ao Sistema de Gestão de Orçamentos</h1>
                <p class="lead">Gerencie seus orçamentos, clientes e pagamentos de forma rápida e eficiente.</p>
                <hr class="my-4">
                <p>Crie, edite e acompanhe seus orçamentos de maneira prática. Tenha controle total sobre seus serviços, clientes e situação de pagamento.</p>
                <a class="btn btn-secondary btn-lg" href="{{ route('clientes.index') }}" role="button">Gerenciar Clientes</a>
                <a class="btn btn-primary btn-lg" href="{{ route('orcamentos.index') }}" role="button">Ver Orçamentos</a>
                <br>
                <br>
                <br>
                <h4 style="color: #4e73df">Atenção! Para o cadastro de um orçamento é necessario que já tenha cadastrado um cliente primeiro</h4>
                
            </div>
        </div>
    </div>
</div>


@endsection
