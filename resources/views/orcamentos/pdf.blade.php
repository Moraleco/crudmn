<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento #{{ $orcamento->id }}</title>

    <!-- Estilo Moderno e Profissional -->
    <style>
        /* ======= Reset Global ======= */
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

        /* ======= Cabeçalho ======= */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #007bff;
        }

        .header p {
            font-size: 16px;
            color: #555;
        }

        /* ======= Informações ======= */
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: black;
            border-radius: 5px;
        }

        .info div {
            text-align: left;
        }

        .info div p {
            margin: 5px 0;
            font-size: 14px;
        }

        /* ======= Tabelas ======= */
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

        /* Alternância de cores */
        .table tr:nth-child(even) {
            background: #f8f9fa;
        }

        /* ======= Total ======= */
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        /* ======= Rodapé ======= */
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
        <!-- Cabeçalho -->
        <div class="header">
            <h1>Orçamento #{{ $orcamento->id }}</h1>
            <p>Emitido em: {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Informações do Cliente -->
        <div class="info">
            <div>
                <p><strong>Cliente:</strong> {{ $orcamento->cliente->nome ?? 'Não informado' }}</p>
                <p><strong>Telefone:</strong> {{ $orcamento->cliente->telefone ?? '-' }}</p>
            </div>
            <div>
                <p><strong>Forma de Pagamento:</strong> {{ $orcamento->forma_pagamento }}</p>
                <p><strong>Situação do Pagamento:</strong> {{ $orcamento->situacao_pagamento }}</p>
                <p><strong>Status:</strong> {{ $orcamento->status }}</p>
            </div>
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
            <p>© {{ date('Y') }} - Orça Facil</p>
        </div>
    </div>

</body>
</html>
