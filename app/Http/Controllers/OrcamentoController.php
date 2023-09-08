<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Cliente;
use Illuminate\Http\Request;

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
        return view('orcamentos.create', compact('clientes', 'forma_pagamento'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'servicos' => 'required',
            'desconto' => 'required',
            'frete' => 'required',
            'outras_taxas' => 'required',
            'forma_pagamento' => 'required',
            'valor_final' => 'required',
        ]);
    
        // Obtenha os valores dos campos do formulário
        $cliente_id = $request->input('cliente_id');
        $servicos = $request->input('servicos');
        $desconto = $request->input('desconto');
        $frete = $request->input('frete');
        $outras_taxas = $request->input('outras_taxas');
        $forma_pagamento = $request->input('forma_pagamento');
    
        // Calcule o valor final considerando desconto, frete e outras taxas
        $valor_final = $request->input('valor_final') + $frete + $outras_taxas - $desconto;
    
        // Crie o novo orçamento com os valores calculados
        Orcamento::create([
            'cliente_id' => $cliente_id,
            'servicos' => $servicos,
            'desconto' => $desconto,
            'frete' => $frete,
            'outras_taxas' => $outras_taxas,
            'forma_pagamento' => $forma_pagamento,
            'valor_final' => $valor_final,
        ]);
    
        // Redirecione de volta à página de índice com uma mensagem de sucesso
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
            'outras_taxas' => 'required',
            'forma_pagamento' => 'required',
            'valor_final' => 'required',
        ]);
    
        // Obtenha os valores dos campos do formulário
        $cliente_id = $request->input('cliente_id');
        $servicos = $request->input('servicos');
        $desconto = $request->input('desconto');
        $frete = $request->input('frete');
        $outras_taxas = $request->input('outras_taxas');
        $forma_pagamento = $request->input('forma_pagamento');
    
        // Calcule o valor final considerando desconto, frete e outras taxas
        $valor_final = $request->input('valor_final') + $frete + $outras_taxas - $desconto;
    
        // Atualize os campos do orçamento
        $orcamento->update([
            'cliente_id' => $cliente_id,
            'servicos' => $servicos,
            'desconto' => $desconto,
            'frete' => $frete,
            'outras_taxas' => $outras_taxas,
            'forma_pagamento' => $forma_pagamento,
            'valor_final' => $valor_final,
        ]);
    
        // Redirecione de volta à página de índice com uma mensagem de sucesso
        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento atualizado com sucesso.');
    }
    

    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();

        return redirect()->route('orcamentos.index')
            ->with('success', 'Orçamento excluído com sucesso.');
    }
}
