@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="display-4">Cadastrar Cliente</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control telefone" id="telefone" name="telefone" required>
                        </div>

                        <div class="form-group">
                            <label for="documento_type">Tipo de Documento</label><br>
                            <input type="radio" id="cpf_radio" name="documento_type" value="cpf" checked>
                            <label for="cpf_radio">CPF</label>
                            <input type="radio" id="cnpj_radio" name="documento_type" value="cnpj">
                            <label for="cnpj_radio">CNPJ</label>
                        </div>

                        <div class="form-group" id="cpf_group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control cpf" id="cpf" name="cpf">
                        </div>

                        <div class="form-group" id="cnpj_group" style="display: none;">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control cnpj" id="cnpj" name="cnpj">
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control cep" id="cep" name="cep" required>
                        </div>

                        <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                        </div>

                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required value="cidade">
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>

                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CDN do IMask.js -->
<script src="https://cdn.jsdelivr.net/npm/imask@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
        cepInput.addEventListener('blur', function() {
            var cep = cepInput.value.replace(/\D/g, '');
            if (cep.length == 8) {
                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
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
                    .catch(function() {
                        alert('Erro ao consultar o CEP.');
                    });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var cpfRadio = document.getElementById('cpf_radio');
        var cnpjRadio = document.getElementById('cnpj_radio');
        var cpfGroup = document.getElementById('cpf_group');
        var cnpjGroup = document.getElementById('cnpj_group');

        cpfRadio.addEventListener('click', function() {
            cpfGroup.style.display = 'block';
            cnpjGroup.style.display = 'none';
        });

        cnpjRadio.addEventListener('click', function() {
            cnpjGroup.style.display = 'block';
            cpfGroup.style.display = 'none';
        });
    });

</script>
@endsection
