@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('sidebar')
        <div class="container">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="card-header ">
                            <h1 class="display-4">Cadastrar Cliente</h1>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <form method="POST" action="{{ route('clientes.store') }}">
                                    @csrf
                                    <div class="card shadow mb-4 border-left-primary">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Dados Gerais</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control" id="nome" name="nome"
                                                        required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="telefone">Telefone</label>
                                                    <input type="text" class="form-control telefone" id="telefone"
                                                        name="telefone" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="documento_type">Tipo de Documento</label><br>
                                                <input type="radio" id="cpf_radio" name="documento_type" value="cpf"
                                                    checked>
                                                <label for="cpf_radio">CPF</label>
                                                <input type="radio" id="cnpj_radio" name="documento_type" value="cnpj">
                                                <label for="cnpj_radio">CNPJ</label>

                                                <div class="form-group" id="cpf_group">
                                                    <label for="cpf">CPF</label>
                                                    <input type="text" class="form-control cpf" id="cpf"
                                                        name="cpf">
                                                </div>

                                                <div class="form-group" id="cnpj_group" style="display: none;">
                                                    <label for="cnpj">CNPJ</label>
                                                    <input type="text" class="form-control cnpj" id="cnpj"
                                                        name="cnpj">
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
                                                    <input type="text" class="form-control cep" id="cep"
                                                        name="cep" required>
                                                </div>

                                                <div class=" col-md-4">
                                                    <label for="logradouro">Logradouro</label>
                                                    <input type="text" class="form-control" id="logradouro"
                                                        name="logradouro" required>
                                                </div>

                                                <div class=" col-md-4">
                                                    <label for="bairro">Bairro</label>
                                                    <input type="text" class="form-control" id="bairro" name="bairro"
                                                        required>
                                                </div>

                                                <div class=" col-md-1">
                                                    <label for="numero">Número</label>
                                                    <input type="text" class="form-control" id="numero" name="numero"
                                                        required>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="cidade">Cidade</label>
                                                    <input type="text" class="form-control" id="cidade" name="cidade"
                                                        required>
                                                </div>

                                                <div class="form-group col-md-1">
                                                    <label for="estado">Estado</label>
                                                    <input type="text" class="form-control" id="estado" name="estado"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit"
                                            class="btn btn-success col-md-4 offset-md-8">Cadastrar</button>
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
    <!-- Adicione este script à sua página Blade -->
<script>
    // Função para validar CPF
    function isCPFValid(cpf) {
        // Remove qualquer caractere que não seja dígito
        cpf = cpf.replace(/\D/g, '');

        // Verifica se o CPF não está vazio e tem 11 dígitos
        if (cpf.length !== 11) {
            return false;
        }

        // Verifica se todos os dígitos são iguais (CPF inválido)
        if (/^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let remainder = sum % 11;
        let digit1 = remainder < 2 ? 0 : 11 - remainder;

        // Calcula o segundo dígito verificador
        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }
        remainder = sum % 11;
        let digit2 = remainder < 2 ? 0 : 11 - remainder;

        // Verifica se os dígitos verificadores coincidem
        return parseInt(cpf.charAt(9)) === digit1 && parseInt(cpf.charAt(10)) === digit2;
    }

    // Função para validar CNPJ
    function isCNPJValid(cnpj) {
        // Remove qualquer caractere que não seja dígito
        cnpj = cnpj.replace(/\D/g, '');

        // Verifica se o CNPJ não está vazio e tem 14 dígitos
        if (cnpj.length !== 14) {
            return false;
        }

        // Calcula o primeiro dígito verificador
        let sum = 0;
        let weight = 5;
        for (let i = 0; i < 12; i++) {
            sum += parseInt(cnpj.charAt(i)) * weight;
            weight = (weight === 2) ? 9 : weight - 1;
        }
        let remainder = sum % 11;
        let digit1 = remainder < 2 ? 0 : 11 - remainder;

        // Calcula o segundo dígito verificador
        sum = 0;
        weight = 6;
        for (let i = 0; i < 13; i++) {
            sum += parseInt(cnpj.charAt(i)) * weight;
            weight = (weight === 2) ? 9 : weight - 1;
        }
        remainder = sum % 11;
        let digit2 = remainder < 2 ? 0 : 11 - remainder;

        // Verifica se os dígitos verificadores coincidem
        return parseInt(cnpj.charAt(12)) === digit1 && parseInt(cnpj.charAt(13)) === digit2;
    }

    // Anexa um ouvinte de evento à submissão do formulário
    document.querySelector('form').addEventListener('submit', function(event) {
        // Obtém o tipo de documento selecionado
        const cpfRadio = document.getElementById('cpf_radio');
        const cnpjRadio = document.getElementById('cnpj_radio');
        
        if (cpfRadio.checked) {
            // Obtém o valor do campo CPF
            const cpfInput = document.getElementById('cpf');
            const cpfValue = cpfInput.value;
            
            // Verifica se o CPF inserido é válido
            if (!isCPFValid(cpfValue)) {
                // Impede o envio do formulário
                event.preventDefault();
                
                // Exibe uma mensagem de erro
                alert('CPF inválido. Por favor, insira um CPF válido.');
            }
        } else if (cnpjRadio.checked) {
            // Obtém o valor do campo CNPJ
            const cnpjInput = document.getElementById('cnpj');
            const cnpjValue = cnpjInput.value;
            
            // Verifica se o CNPJ inserido é válido
            if (!isCNPJValid(cnpjValue)) {
                // Impede o envio do formulário
                event.preventDefault();
                
                // Exibe uma mensagem de erro
                alert('CNPJ inválido. Por favor, insira um CNPJ válido.');
            }
        }
    });
</script>





    
@endsection
