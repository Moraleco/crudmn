@extends('layouts.app')

@section('content')
<div class="d-flex" id="page-top">
    @include('sidebar')
    <div class="container">
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-header ">
                        <h1 class="display-4">Editar Cliente</h1>
                    </div>
                    <div class="row">
                        <div class="card-body">
                            <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                                @csrf
                                @method('PUT') <!-- Adicione este método para indicar que é um formulário de atualização -->

                                <!-- Aqui deve incluir os campos que deseja editar, preenchidos com os valores atuais do cliente -->
                                <div class="card shadow mb-4 border-left-primary">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dados Gerais</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{ $cliente->telefone }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="documento_type">Tipo de Documento</label><br>
                                            <input type="radio" id="cpf_radio" name="documento_type" value="cpf" {{ $cliente->cpf ? 'checked' : '' }}>
                                            <label for="cpf_radio">CPF</label>
                                            <input type="radio" id="cnpj_radio" name="documento_type" value="cnpj" {{ $cliente->cnpj ? 'checked' : '' }}>

                                            <label for="cnpj_radio">CNPJ</label>

                                            <!-- Adicione os campos de CPF e CNPJ aqui, preenchidos com os valores atuais do cliente -->
                                            <div class="form-group" id="cpf_group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" class="form-control cpf" id="cpf" name="cpf" value="{{ $cliente->cpf }}">
                                            </div>

                                            <div class="form-group" id="cnpj_group" style="display: none;">
                                                <label for="cnpj">CNPJ</label>
                                                <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{ $cliente->cnpj }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow mb-4 border-left-primary">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Endereço</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class=" col-md-2">
                                                <label for="cep">CEP</label>
                                                <input type="text" class="form-control cep" id="cep" name="cep" value="{{ $cliente->endereco->cep }}" required>
                                            </div>

                                            <div class=" col-md-4">
                                                <label for="logradouro">Logradouro</label>
                                                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ $cliente->endereco->logradouro }}" required>
                                            </div>

                                            <div class=" col-md-4">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $cliente->endereco->bairro }}" required>
                                            </div>

                                            <div class=" col-md-1">
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" id="numero" name="numero" value="{{ $cliente->endereco->numero }}" required>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="cidade">Cidade</label>
                                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $cliente->endereco->cidade }}" required>
                                            </div>

                                            <div class="form-group col-md-1">
                                                <label for="estado">Estado</label>
                                                <input type="text" class="form-control" id="estado" name="estado" value="{{ $cliente->endereco->estado }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-success col-md-4 offset-md-8">Atualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var cpfRadio = document.getElementById('cpf_radio');
            var cnpjRadio = document.getElementById('cnpj_radio');
            var cpfGroup = document.getElementById('cpf_group');
            var cnpjGroup = document.getElementById('cnpj_group');

            // Função para verificar o tipo de documento selecionado
            function verificarDocumento() {
                if (cpfRadio.checked) {
                    cpfGroup.style.display = 'block';
                    cnpjGroup.style.display = 'none';
                } else if (cnpjRadio.checked) {
                    cnpjGroup.style.display = 'block';
                    cpfGroup.style.display = 'none';
                }
            }

            // Adicionar eventos de clique para os botões de opção
            cpfRadio.addEventListener('click', verificarDocumento);
            cnpjRadio.addEventListener('click', verificarDocumento);

            // Chamar a função inicialmente para verificar o valor padrão selecionado
            verificarDocumento();
        });
</script>

@endsection