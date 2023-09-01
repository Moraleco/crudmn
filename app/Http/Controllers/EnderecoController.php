<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function create()
    {
        return view('enderecos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);

        Endereco::create($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Endereço criado com sucesso.');
    }

    public function edit(Endereco $endereco)
    {
        return view('enderecos.edit', compact('endereco'));
    }

    public function update(Request $request, Endereco $endereco)
    {
        $request->validate([
            'logradouro' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);

        $endereco->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Endereço atualizado com sucesso.');
    }

    public function destroy(Endereco $endereco)
    {
        $endereco->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Endereço excluído com sucesso.');
    }
}
