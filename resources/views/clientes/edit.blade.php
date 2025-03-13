@extends('layouts.app')

@section('content')
<div class="d-flex" id="page-top">
    <div class="container">
        <div class="">
            <div class="">
                <div class="">
                    <div class="card-header">
                        <h1 class="h3 mb-2 text-gray-800">Editar Cliente</h1>
                        <h5 class="h6 mb-3 text-gray-800">Cadastros > Clientes > Editar cliente</h5>
                    </div>

                    <!-- Modal de Erros -->
                    @if ($errors->any())
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                $('#errorModal').modal('show');
                            });
                        </script>

                        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="errorModalLabel">Erros no Formulário</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="card-body">
                            <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="card shadow mb-4 border-left-primary">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Dados Gerais</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="nome">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telefone">Telefone</label>
                                                <input type="text" class="form-control telefone" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="documento_type">Tipo de Documento</label><br>
                                            <input type="radio" id="cpf_radio" name="documento_type" value="cpf" {{ old('documento_type', $cliente->cpf ? 'cpf' : '') == 'cpf' ? 'checked' : '' }}>
                                            <label for="cpf_radio">CPF</label>
                                            <input type="radio" id="cnpj_radio" name="documento_type" value="cnpj" {{ old('documento_type', $cliente->cnpj ? 'cnpj' : '') == 'cnpj' ? 'checked' : '' }}>
                                            <label for="cnpj_radio">CNPJ</label>

                                            <div class="form-group" id="cpf_group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" class="form-control cpf" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}">
                                            </div>

                                            <div class="form-group" id="cnpj_group" style="display: none;">
                                                <label for="cnpj">CNPJ</label>
                                                <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="{{ old('cnpj', $cliente->cnpj) }}">
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
                                            <div class="col-md-2">
                                                <label for="cep">CEP</label>
                                                <input type="text" class="form-control cep" id="cep" name="cep" value="{{ old('cep', $cliente->endereco->cep) }}" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="logradouro">Logradouro</label>
                                                <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro', $cliente->endereco->logradouro) }}" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="bairro">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $cliente->endereco->bairro) }}" required>
                                            </div>

                                            <div class="col-md-1">
                                                <label for="numero">Número</label>
                                                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $cliente->endereco->numero) }}" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="cidade">Cidade</label>
                                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade', $cliente->endereco->cidade) }}" required>
                                            </div>

                                            <div class="col-md-1">
                                                <label for="estado">Estado</label>
                                                <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado', $cliente->endereco->estado) }}" required>
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
<!-- CDN do IMask.js -->
<script src="https://cdn.jsdelivr.net/npm/imask@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Aplicar a máscara de telefone
        var telefoneInput = document.getElementById('telefone');
        var telefoneMask = IMask(telefoneInput, {
            mask: '(00) 9 0000-0000'
        });

        // Aplicar a máscara de CPF
        var cpfInput = document.getElementById('cpf');
        var cpfMask = IMask(cpfInput, {
            mask: '000.000.000-00'
        });

        // Aplicar a máscara de CNPJ
        var cnpjInput = document.getElementById('cnpj');
        var cnpjMask = IMask(cnpjInput, {
            mask: '00.000.000/0000-00'
        });

        // Aplicar a máscara de CEP
        var cepInput = document.getElementById('cep');
        var cepMask = IMask(cepInput, {
            mask: '00000-000'
        });

        // Preencher automaticamente os campos do endereço ao preencher o CEP
        cepInput.addEventListener('blur', function () {
            var cep = cepInput.value.replace(/\D/g, '');
            if (cep.length == 8) {
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.hasOwnProperty('erro')) {
                            alert('CEP não encontrado.');
                        } else {
                            document.getElementById('logradouro').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                            document.getElementById('numero').focus();
                        }
                    })
                    .catch(function () {
                        alert('Erro ao consultar o CEP.');
                    });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var cpfRadio = document.getElementById('cpf_radio');
        var cnpjRadio = document.getElementById('cnpj_radio');
        var cpfGroup = document.getElementById('cpf_group');
        var cnpjGroup = document.getElementById('cnpj_group');

        cpfRadio.addEventListener('click', function () {
            cpfGroup.style.display = 'block';
            cnpjGroup.style.display = 'none';
        });

        cnpjRadio.addEventListener('click', function () {
            cnpjGroup.style.display = 'block';
            cpfGroup.style.display = 'none';
        });
        
        // Exibir modal de erro automaticamente caso existam erros
        @if ($errors->any())
            $('#errorModal').modal('show');
        @endif
    });
</script>
@endsection
