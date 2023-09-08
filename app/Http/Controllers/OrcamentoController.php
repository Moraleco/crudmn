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
            'outras_taxas' => 'required',
            'forma_pagamento' => 'required',
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
}
