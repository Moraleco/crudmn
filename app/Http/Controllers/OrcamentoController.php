<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::with('cliente')->get();
        return view('orcamentos.index', compact('orcamentos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $forma_pagamento = ['Pix', 'Dinheiro', 'Cartão de Crédito', 'Boleto Bancário', 'Transferência Bancária'];
        $situacao_pagamento = ['A Pagar', 'Pago'];
        $status = ['Aguardando Autorização', 'Autorizado', 'Recusado', 'Finalizado'];

        return view('orcamentos.create', compact('clientes', 'forma_pagamento', 'situacao_pagamento', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'desconto' => 'required|numeric|min:0',
            'frete' => 'required|numeric|min:0',
            'status' => 'required',
            'situacao_pagamento' => 'required',
            'outras_taxas' => 'required|numeric|min:0',
            'forma_pagamento' => 'required',
            'servicos' => 'required|array|min:1',
            'servicos.*.descricao' => 'required|string|max:200',
            'servicos.*.valor' => 'required|numeric|min:0',
        ]);

        $orcamento = Orcamento::create($request->except('servicos'));

        foreach ($request->servicos as $servico) {
            $orcamento->servicos()->create($servico);
        }

        session()->push('notificacoes', [
            'mensagem' => "Novo orçamento criado: #" . $orcamento->id,
            'link' => route('orcamentos.show', $orcamento->id),
            'data' => now()->format('d/m/Y H:i')
        ]);

        return redirect()->route('orcamentos.index')->with('success', 'Orçamento criado com sucesso.');
    }

    public function show(Orcamento $orcamento)
    {
        $orcamento->load('servicos');
        return view('orcamentos.show', compact('orcamento'));
    }

    public function edit(Orcamento $orcamento)
    {
        $clientes = Cliente::all();
        $forma_pagamento = ['Pix', 'Dinheiro', 'Cartão de Crédito', 'Boleto Bancário', 'Transferência Bancária'];
        $situacao_pagamento = ['A Pagar', 'Pago'];
        $status = ['Aguardando Autorização', 'Autorizado', 'Recusado', 'Finalizado'];

        $orcamento->load('servicos');

        return view('orcamentos.edit', compact('orcamento', 'clientes', 'forma_pagamento', 'situacao_pagamento', 'status',));
        
    }

    public function update(Request $request, Orcamento $orcamento)
{
    $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'desconto' => 'required|numeric|min:0',
        'frete' => 'required|numeric|min:0',
        'status' => 'required',
        'situacao_pagamento' => 'required',
        'outras_taxas' => 'required|numeric|min:0',
        'forma_pagamento' => 'required',
        'servicos' => 'required|array|min:1',
        'servicos.*.descricao' => 'required|string|max:200',
        'servicos.*.valor' => 'required|numeric|min:0',
    ]);

    // Atualiza os dados básicos do orçamento
    $orcamento->update($request->except('servicos'));

    // Deleta os serviços antigos
    $orcamento->servicos()->delete();

    // Insere os novos serviços e soma os valores
    $totalServicos = 0;
    foreach ($request->servicos as $servico) {
        $novoServico = $orcamento->servicos()->create([
            'descricao' => $servico['descricao'],
            'valor' => $servico['valor'],
        ]);
        $totalServicos += $novoServico->valor;
    }

    // Recalcula o valor final do orçamento
    $valorFinal = $totalServicos + $orcamento->frete + $orcamento->outras_taxas - $orcamento->desconto;
    $orcamento->update(['valor_final' => $valorFinal]);

    session()->push('notificacoes', [
        'mensagem' => "Orçamento atualizado: #" . $orcamento->id,
        'link' => route('orcamentos.show', $orcamento->id),
        'data' => now()->format('d/m/Y H:i')
    ]);

    return redirect()->route('orcamentos.index')->with('success', 'Orçamento atualizado com sucesso.');
}

    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();

        session()->push('notificacoes', [
            'mensagem' => "O orçamento #{$orcamento->id} foi excluído",
            'link' => route('orcamentos.index'),
            'data' => now()->format('d/m/Y H:i')
        ]);

        return redirect()->route('orcamentos.index')->with('success', 'Orçamento excluído com sucesso.');
    }

    public function generatePDF(Orcamento $orcamento)
    {
        $orcamento->load('servicos');
        $configuracao = \App\Models\Configuracao::first();
        $logoPath = $configuracao && $configuracao->logo ? public_path('img/logo/' . $configuracao->logo) : null;
        $logoBase64 = null;

        if ($logoPath && file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($logoData);
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('orcamentos.pdf', compact('orcamento', 'configuracao', 'logoBase64'))->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream("orcamento_{$orcamento->id}.pdf");
    }
}
