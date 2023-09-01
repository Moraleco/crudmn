<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $enderecos = Endereco::all();
        return view('clientes.create')->with('enderecos', $enderecos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'documento_type' => 'required', // Validating the document type selection
            'cpf' => $request->input('documento_type') === 'cpf' ? 'unique:clientes,cpf|nullable' : '',
            'cnpj' => $request->input('documento_type') === 'cnpj' ? 'unique:clientes,cnpj|nullable' : '',
            'logradouro' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);
    
        $clienteData = $request->except(['_token', 'documento_type', 'cpf', 'cnpj', 'logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);
        if ($request->input('documento_type') === 'cpf') {
            $clienteData['cpf'] = $request->input('cpf');
            $clienteData['cnpj'] = null;
        } elseif ($request->input('documento_type') === 'cnpj') {
            $clienteData['cnpj'] = $request->input('cnpj');
            $clienteData['cpf'] = null;
        }
    
        $cliente = Cliente::create($clienteData);
    
        // Criar o endereço associado ao cliente
        $enderecoData = $request->only(['logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);
        $cliente->endereco()->create($enderecoData);
    
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso.')
            ->with('cliente_id', $cliente->id);
             
    }
    
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'documento_type' => 'required', // Validating the document type selection
            'cpf' => $request->input('documento_type') === 'cpf' ? 'unique:clientes,cpf,' . $cliente->id . '|nullable' : '',
            'cnpj' => $request->input('documento_type') === 'cnpj' ? 'unique:clientes,cnpj,' . $cliente->id . '|nullable' : '',
            'logradouro' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);
    
        $clienteData = $request->except(['_token', 'documento_type', 'cpf', 'cnpj', 'logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);
        if ($request->input('documento_type') === 'cpf') {
            $clienteData['cpf'] = $request->input('cpf');
            $clienteData['cnpj'] = null;
        } elseif ($request->input('documento_type') === 'cnpj') {
            $clienteData['cnpj'] = $request->input('cnpj');
            $clienteData['cpf'] = null;
        }
    
        $cliente->update($clienteData);
    
        // Atualizar o endereço associado ao cliente
        $enderecoData = $request->only(['logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);
        $cliente->endereco->update($enderecoData);
    
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }
    

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso.');
    }
}

