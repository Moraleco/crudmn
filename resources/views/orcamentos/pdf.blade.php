<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento #{{ $orcamento->id }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f5f5f5;
            color: #333;
            font-size: 14px;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            background: #fff;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #007bff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo-container img {
            max-width: 150px;
            max-height: 150px;
        }

        .header h1 {
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #007bff;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 16px;
            color: #555;
        }

        .info-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            background: #f8f9fa;
        }

        .info-box h3 {
            margin-bottom: 10px;
            font-size: 16px;
            text-transform: uppercase;
            color: #007bff;
        }

        .info-box p {
            margin: 3px 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th {
            background: #007bff;
            color: white;
            text-align: left;
            padding: 10px;
            border-radius: 3px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table tr:nth-child(even) {
            background: #f8f9fa;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Logo e Título -->
        <div class="header">
            <div class="logo-container">
                @if(isset($logoBase64))
                    <img src="{{ $logoBase64 }}" alt="Logo da Empresa">
                @endif
            </div>
            <h1>Orçamento #{{ $orcamento->id }}</h1>
            <p>Emitido em: {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Informações da Empresa -->
        <div class="info-box">
            <h3>Dados da Empresa</h3>
            <p><strong>Empresa:</strong> {{ $configuracao->nome_empresa ?? 'Não Informado' }}</p>
            <p><strong>CNPJ:</strong> {{ $configuracao->cnpj ?? '-' }}</p>
            <p><strong>Telefone:</strong> {{ $configuracao->telefone ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $configuracao->email ?? '-' }}</p>
            <p><strong>Endereço:</strong> {{ $configuracao->endereco ?? '-' }}, {{ $configuracao->cidade ?? '-' }} - {{ $configuracao->estado ?? '-' }}</p>
        </div>

        <!-- Informações do Cliente -->
        <div class="info-box">
            <h3>Dados do Cliente</h3>
            <p><strong>Nome:</strong> {{ $orcamento->cliente->nome ?? 'Não informado' }}</p>
            <p><strong>Telefone:</strong> {{ $orcamento->cliente->telefone ?? '-' }}</p>
            <p><strong>Forma de Pagamento:</strong> {{ $orcamento->forma_pagamento }}</p>
            <p><strong>Situação do Pagamento:</strong> {{ $orcamento->situacao_pagamento }}</p>
            <p><strong>Status:</strong> {{ $orcamento->status }}</p>
        </div>

        <!-- Tabela de Serviços -->
        <table class="table">
            <thead>
                <tr>
                    <th>Descrição do Serviço</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $orcamento->servicos }}</td>
                    <td>R$ {{ number_format($orcamento->valor_do_servico, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Valores -->
        <table class="table">
            <tr>
                <td><strong>Desconto</strong></td>
                <td>R$ {{ number_format($orcamento->desconto, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Frete</strong></td>
                <td>R$ {{ number_format($orcamento->frete, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Outras Taxas</strong></td>
                <td>R$ {{ number_format($orcamento->outras_taxas, 2, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Total a Pagar:</td>
                <td>R$ {{ number_format($orcamento->valor_final, 2, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Observações -->
        <p><strong>Observações:</strong> {{ $orcamento->observacoes ?? 'Nenhuma observação adicional.' }}</p>

        <!-- Rodapé -->
        <div class="footer">
            <p>Este orçamento foi gerado automaticamente.</p>
            <p>© {{ date('Y') }} - {{ $configuracao->nome_empresa ?? 'Orça Fácil' }}</p>
        </div>
    </div>

</body>

</html>
