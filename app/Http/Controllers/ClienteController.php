<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // $clientes = Cliente::paginate(5);

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
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'documento_type' => 'required|in:cpf,cnpj',
            'cpf' => ['nullable', 'unique:clientes,cpf', 'cpf'],
            'cnpj' => ['nullable', 'unique:clientes,cnpj', 'cnpj'],
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
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

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso.');
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
    // Validação dos campos
    $request->validate([
        'nome' => 'required|string|max:255',
        'telefone' => 'required|string|max:20',
        'documento_type' => 'required|in:cpf,cnpj',
        'cpf' => ['nullable', 'unique:clientes,cpf,' . $cliente->id, 'cpf'],
        'cnpj' => ['nullable', 'unique:clientes,cnpj,' . $cliente->id, 'cnpj'],
        'logradouro' => 'required|string|max:255',
        'numero' => 'required|string|max:10',
        'cidade' => 'required|string|max:255',
        'bairro' => 'required|string|max:255',
        'estado' => 'required|string|max:2',
        'cep' => 'required|string|max:9',
    ]);

    // Atualizando os dados do cliente
    $clienteData = $request->except(['_token', 'documento_type', 'cpf', 'cnpj', 'logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);

    // Ajustando CPF/CNPJ
    if ($request->input('documento_type') === 'cpf') {
        $clienteData['cpf'] = $request->input('cpf');
        $clienteData['cnpj'] = null;
    } elseif ($request->input('documento_type') === 'cnpj') {
        $clienteData['cnpj'] = $request->input('cnpj');
        $clienteData['cpf'] = null;
    }

    // Atualiza o cliente
    $cliente->update($clienteData);

    // Atualizar o endereço associado ao cliente (se existir)
    if ($cliente->endereco) {
        $enderecoData = $request->only(['logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']);
        $cliente->endereco->update($enderecoData);
    } else {
        // Se o cliente não tiver endereço, cria um novo
        $cliente->endereco()->create($request->only(['logradouro', 'numero', 'cidade', 'bairro', 'estado', 'cep']));
    }

    return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso.');
}

    public function destroy(Cliente $cliente)
    {
        // Criar ou atualizar a lista de notificações na sessão
        $notificacoes = session()->get('notificacoes', []);
        $notificacoes[] = [
            'tipo' => 'cliente_exclusao',
            'mensagem' => "O cliente '{$cliente->nome}' foi excluído",
            'link' => route('clientes.index'),
            'data' => now()->format('d/m/Y H:i')
        ];

        session()->put('notificacoes', $notificacoes);

        // Exclui o endereço associado ao cliente
        $cliente->endereco->delete();

        // Exclui o cliente
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente e endereço excluídos com sucesso.');
    }
}
