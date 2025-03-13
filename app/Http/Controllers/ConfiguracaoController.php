<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao;
use Illuminate\Support\Facades\Storage;

class ConfiguracaoController extends Controller
{
    /**
     * Exibe a página de configurações da empresa.
     */
    public function index()
    {
        $configuracao = Configuracao::first() ?? new Configuracao();
        return view('configuracoes.index', compact('configuracao'));
    }

    /**
     * Atualiza ou cria as configurações da empresa.
     */
    public function update(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'nome_empresa' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:18',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:9',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Busca a configuração existente ou cria uma nova instância se não existir
        $configuracao = Configuracao::firstOrNew();

        // Preenchendo os campos
        $configuracao->nome_empresa = $request->input('nome_empresa', $configuracao->nome_empresa);
        $configuracao->cnpj = $request->input('cnpj', $configuracao->cnpj);
        $configuracao->telefone = $request->input('telefone', $configuracao->telefone);
        $configuracao->email = $request->input('email', $configuracao->email);
        $configuracao->endereco = $request->input('endereco', $configuracao->endereco);
        $configuracao->cidade = $request->input('cidade', $configuracao->cidade);
        $configuracao->estado = $request->input('estado', $configuracao->estado);
        $configuracao->cep = $request->input('cep', $configuracao->cep);

        // **CORREÇÃO: Salvando a imagem corretamente em `public/img/`**
        if ($request->hasFile('logo')) {
            // Remove a logo anterior, se existir
            if (!empty($configuracao->logo) && file_exists(public_path('img/logo' . $configuracao->logo))) {
                unlink(public_path('img/logo' . $configuracao->logo));
            }

            // Move a imagem para a pasta public/img
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/logo'), $imageName);

            // Atualiza o nome da imagem no banco de dados
            $configuracao->logo = $imageName;
        }

        // **FORÇANDO O SALVAMENTO CORRETO**
        if ($configuracao->save()) {
            return redirect()->route('configuracoes.index')->with('success', 'Configurações atualizadas com sucesso!');
        } 

        return redirect()->route('configuracoes.index')->with('error', 'Erro ao salvar as configurações.');
    }
}
