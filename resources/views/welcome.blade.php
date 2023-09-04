@extends('layouts.app')

@section('content')

    <div class="d-flex" id="page-top">   
        @include('sidebar')
        
        <div class="jumbotron flex-grow-1">
            <div class="container">
                <h1 class="display-4">Bem-vindo ao Seu Aplicativo!</h1>
                <p class="lead">Este é o seu aplicativo Laravel recém-criado. Use-o como base para criar coisas incríveis.</p>
                <hr class="my-4">
                <p>Este aplicativo vem com rotas de autenticação, migrações e controladores pré-configurados para ajudá-lo a começar rapidamente.</p>
            </div>
        </div>
    </div>
    
@endsection
