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
        return view('orcamentos.create', compact('clientes', 'forma_pagamento', 'situacao_pagamento'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicos' => 'required',
            'desconto' => 'required',
            'frete' => 'required',
            'status' => 'required',
            'situacao_pagamento' => 'required',
            'outras_taxas' => 'required',
            'forma_pagamento' => 'required',
            'valor_do_servico' => 'required',
            'valor_final' => 'required',
        ]);

        Orcamento::create($request->all());
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
        return view('orcamentos.edit', compact('orcamento', 'clientes'));
    }

    public function update(Request $request, Orcamento $orcamento)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicos' => 'required',
            'desconto' => 'required',
            'frete' => 'required',
            'status' => 'required',
            'situacao_pagamento' => 'required',
            'outras_taxas' => 'required',
            'forma_pagamento' => 'required',
            'valor_do_servico' => 'required',
            'valor_final' => 'required',
        ]);

        $orcamento->update($request->all());

        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento atualizado com sucesso.');
    }

    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();

        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento excluído com sucesso.');
    }

    public function generatePDF(Orcamento $orcamento)
    {   
        $logo=base64_encode(file_get_contents(storage_path("app/public/img/logo.png")));
        
        // Crie uma instância do Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        $dompdf = new Dompdf($options);
    
        // Carregue a visão 'orcamentos.pdf' com os dados do orçamento
        $html = view('orcamentos.pdf', compact('orcamento','logo'))->render();
    
        // Carregue o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);
    
        // Defina opções de renderização, se necessário
        $dompdf->setPaper('A4', 'portrait');
    
        // Renderize o PDF
        $dompdf->render();
    
        // O nome do arquivo PDF gerado
        $filename = 'orcamento_' . $orcamento->id . '.pdf';
    
        // Faça o download do PDF para o navegador
        return $dompdf->stream($filename);
    }

}
