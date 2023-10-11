<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento em PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f2f2f2;
        }
        .header img {
            max-height: 80px; /* Ajuste o tamanho da imagem conforme necessário */
        }
        .company-info {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px; /* Ajuste o tamanho da fonte conforme necessário */
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .no-border td {
            border: none;
        }
        .subtable {
            width: 100%;
        }
        .subtable th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/png;base64, {{ $logo }}" alt="" width="350px" height="200px" />
        {{-- <img src='{{storage_path("app/public/img/logo.png")}}' style="width: 40px"> --}}
        {{-- <img src='C:/Users/GabrielMoraleco/Documents/IFMS/crudmn/public/img/ifms.png' alt=""> --}}
        <div class="company-info">
            <p>Nome da Empresa</p>
            <p>Endereço da Empresa</p>
            <p>Telefone: (123) 456-7890</p>
            <!-- Adicione outras informações da empresa aqui -->
        </div>
    </div>

    <h1>Orçamento</h1>

    <!-- Informações do Cliente -->
    <h2>Informações do Cliente</h2>
    <table>
        <tr>
            <th>Cliente</th>
            <td>{{ $orcamento->cliente->nome }}</td>
        </tr>
        <!-- ... Conteúdo da tabela ... -->
    </table>

    <!-- Serviços -->
    <h2>Serviços</h2>
    <table>
        <tr>
            <th>Serviços</th>
            <td>{{ $orcamento->servicos }}</td>
        </tr>
        <!-- ... Conteúdo da tabela ... -->
    </table>

    <!-- Informações Adicionais -->
    <h2>Informações Adicionais</h2>
    <table>
        <tr>
            <th>Informações Adicionais</th>
            <td>{{ $orcamento->informacoes_adicionais }}</td>
        </tr>
        <!-- ... Conteúdo da tabela ... -->
    </table>

    <!-- Transporte -->
    <h2>Transporte</h2>
    <table>
        <tr>
            <th>Frete</th>
            <td>{{ $orcamento->frete }}</td>
        </tr>
        <!-- ... Conteúdo da tabela ... -->
    </table>

    <!-- Pagamento -->
    <h2>Pagamento</h2>
    <table>
        <tr>
            <th>Valor do Serviço</th>
            <td>{{ $orcamento->valor_do_servico }}</td>
        </tr>
        <tr>
            <th>Outras Taxas</th>
            <td>{{ $orcamento->outras_taxas }}</td>
        </tr>
        <tr>
            <th>Forma de Pagamento</th>
            <td>{{ $orcamento->forma_pagamento }}</td>
        </tr>
        <tr>
            <th>Desconto</th>
            <td>{{ $orcamento->desconto }}</td>
        </tr>
        <tr class="no-border">
            <th>Total</th>
            <td>{{ $orcamento->valor_final }}</td>
        </tr>
    </table>
</body>
</html>
