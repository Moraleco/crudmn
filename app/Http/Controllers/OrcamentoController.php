<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::all();
        return view('orcamentos.index', compact('orcamentos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $forma_pagamento = ['Pix', 'Dinheiro', 'Cartão de Crédito', 'Boleto Bancário', 'Transferência Bancária'];
        $situacao_pagamento = ['A Pagar','Pago'];
        $status = ['Aguardando Autorização','Autorizado','Recusado','Finalizado'];
        return view('orcamentos.create', compact('clientes', 'forma_pagamento', 'situacao_pagamento','status'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicos' => 'required',
            'desconto' => 'required|numeric|min:0',
            'frete' => 'required|numeric|min:0',
            'status' => 'required',
            'situacao_pagamento' => 'required',
            'outras_taxas' => 'required|numeric|min:0',
            'forma_pagamento' => 'required',
            'valor_do_servico' => 'required|numeric|min:0',
            'valor_final' => 'required|numeric|min:0',
        ]);
    
        $orcamento = Orcamento::create($request->all());
    
        // Criar ou atualizar a lista de notificações na sessão
        $notificacoes = session()->get('notificacoes', []);
        $notificacoes[] = [
            'mensagem' => "Novo orçamento criado: #" . $orcamento->id,
            'link' => route('orcamentos.show', $orcamento->id),
            'data' => now()->format('d/m/Y H:i')
        ];
    
        session()->put('notificacoes', $notificacoes);
    
        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento criado com sucesso.');
    }
    

    public function show(Orcamento $orcamento)
    {
        return view('orcamentos.show', compact('orcamento'));
    }

    public function edit(Orcamento $orcamento)
    {
        $clientes = Cliente::all();
        $forma_pagamento = ['Pix', 'Dinheiro', 'Cartão de Crédito', 'Boleto Bancário', 'Transferência Bancária'];
        $situacao_pagamento = ['A Pagar', 'Pago'];
        $status = ['Aguardando Autorização', 'Autorizado', 'Recusado', 'Finalizado'];
    
        return view('orcamentos.edit', compact('orcamento', 'clientes', 'forma_pagamento', 'situacao_pagamento', 'status'));
    }
    
    public function update(Request $request, Orcamento $orcamento)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicos' => 'required',
            'desconto' => 'required|numeric|min:0',
            'frete' => 'required|numeric|min:0',
            'status' => 'required',
            'situacao_pagamento' => 'required',
            'outras_taxas' => 'required|numeric|min:0',
            'forma_pagamento' => 'required',
            'valor_do_servico' => 'required|numeric|min:0',
            'valor_final' => 'required|numeric|min:0',
        ]);
    
        // Criar ou atualizar a lista de notificações na sessão
        $notificacoes = session()->get('notificacoes', []);
    
        // Verifica mudanças nos campos e adiciona notificações apropriadas
        if ($orcamento->status !== $request->status) {
            $notificacoes[] = [
                'tipo' => 'status',
                'mensagem' => "Status do orçamento #{$orcamento->id} alterado para '{$request->status}'",
                'link' => route('orcamentos.show', $orcamento->id),
                'data' => now()->format('d/m/Y H:i')
            ];
        }
    
        if ($orcamento->situacao_pagamento !== $request->situacao_pagamento) {
            $notificacoes[] = [
                'tipo' => 'pagamento',
                'mensagem' => "Situação de pagamento do orçamento #{$orcamento->id} alterada para '{$request->situacao_pagamento}'",
                'link' => route('orcamentos.show', $orcamento->id),
                'data' => now()->format('d/m/Y H:i')
            ];
        }
    
        if ($orcamento->valor_do_servico != $request->valor_do_servico) {
            $notificacoes[] = [
                'tipo' => 'valor',
                'mensagem' => "Valor do serviço do orçamento #{$orcamento->id} alterado para R$ {$request->valor_do_servico}",
                'link' => route('orcamentos.show', $orcamento->id),
                'data' => now()->format('d/m/Y H:i')
            ];
        }
    
        if ($orcamento->servicos !== $request->servicos) {
            $notificacoes[] = [
                'tipo' => 'servico',
                'mensagem' => "Serviços do orçamento #{$orcamento->id} foram atualizados",
                'link' => route('orcamentos.show', $orcamento->id),
                'data' => now()->format('d/m/Y H:i')
            ];
        }
    
        session()->put('notificacoes', $notificacoes);
    
        // Atualiza o orçamento
        $orcamento->update($request->all());
    
        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento atualizado com sucesso.');
    }
    
    

    public function destroy(Orcamento $orcamento)
    {
        // Criar ou atualizar a lista de notificações na sessão
        $notificacoes = session()->get('notificacoes', []);
        $notificacoes[] = [
            'tipo' => 'exclusao',
            'mensagem' => "O orçamento #{$orcamento->id} foi excluído",
            'link' => route('orcamentos.index'),
            'data' => now()->format('d/m/Y H:i')
        ];
    
        session()->put('notificacoes', $notificacoes);
    
        // Exclui o orçamento
        $orcamento->delete();
    
        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento excluído com sucesso.');
    }
    
    public function generatePDF(Orcamento $orcamento)
    {
        // Busca a configuração da empresa para obter a logo
        $configuracao = \App\Models\Configuracao::first();
    
        // Caminho correto da logo (se existir)
        $logoPath = $configuracao && $configuracao->logo ? public_path('img/logo/' . $configuracao->logo) : null;
        $logoBase64 = null;
    
        // Se a logo existir, converte para base64
        if ($logoPath && file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($logoData);
        }
    
        // Criar uma instância do Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        $dompdf = new Dompdf($options);
    
        // Carregar a visão do PDF com os dados do orçamento e a logo em base64
        $html = view('orcamentos.pdf', compact('orcamento', 'configuracao', 'logoBase64'))->render();
    
        // Carregar o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);
    
        // Definir o formato do papel (A4 retrato)
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderizar o PDF
        $dompdf->render();
    
        // Nome do arquivo PDF gerado
        $filename = 'orcamento_' . $orcamento->id . '.pdf';
    
        // Enviar o PDF para download
        return $dompdf->stream($filename);
    }
    
    
    

}
