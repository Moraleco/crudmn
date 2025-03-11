<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Orcamento;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        // Captura os filtros da requisição
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');
        $clienteId = $request->input('cliente_id');
        $servico = $request->input('servico');
        $statusOrcamento = $request->input('status');
        $formaPagamento = $request->input('forma_pagamento');
        $situacaoPagamento = $request->input('situacao_pagamento');
        $valorServico = $request->input('valor_servico');
        $desconto = $request->input('desconto');
        $frete = $request->input('frete');
        $outrasTaxas = $request->input('outras_taxas');
        $buscaOs = $request->input('busca_os');
        $relatorioDetalhado = $request->has('relatorio_detalhado');

        // Inicializa variáveis vazias para evitar erro
        $listaClientes = collect(); 
        $listaOrcamentos = collect(); 
        $totalClientes = 0;
        $totalOrcamentos = 0;
        $valorTotalOrcamentos = 0;

        // Só executa as consultas se pelo menos um filtro for aplicado
        if ($dataInicio || $dataFim || $clienteId || $servico || $statusOrcamento || $formaPagamento || $situacaoPagamento || $buscaOs) {
            
            // Filtro de clientes cadastrados
            $clientes = Cliente::query();
            if ($dataInicio && $dataFim) {
                $clientes->whereBetween('created_at', [$dataInicio, $dataFim]);
            }
            if ($clienteId) {
                $clientes->where('id', $clienteId);
            }
            $listaClientes = $clientes->get();
            $totalClientes = $listaClientes->count();

            // Filtro de ordens de serviço (O.S.)
            $orcamentos = Orcamento::query();
            if ($dataInicio && $dataFim) {
                $orcamentos->whereBetween('created_at', [$dataInicio, $dataFim]);
            }
            if ($clienteId) {
                $orcamentos->where('cliente_id', $clienteId);
            }
            if ($servico) {
                $orcamentos->where('servicos', 'LIKE', "%$servico%");
            }
            if ($statusOrcamento) {
                $orcamentos->where('status', $statusOrcamento);
            }
            if ($formaPagamento) {
                $orcamentos->where('forma_pagamento', $formaPagamento);
            }
            if ($situacaoPagamento) {
                $orcamentos->where('situacao_pagamento', $situacaoPagamento);
            }
            if ($valorServico) {
                $orcamentos->where('valor_do_servico', '>=', $valorServico);
            }
            if ($desconto) {
                $orcamentos->where('desconto', '>=', $desconto);
            }
            if ($frete) {
                $orcamentos->where('frete', '>=', $frete);
            }
            if ($outrasTaxas) {
                $orcamentos->where('outras_taxas', '>=', $outrasTaxas);
            }
            if ($buscaOs) {
                $orcamentos->where(function($query) use ($buscaOs) {
                    $query->where('id', $buscaOs)
                        ->orWhere('servicos', 'LIKE', "%$buscaOs%");
                });
            }

            $listaOrcamentos = $orcamentos->get();
            $totalOrcamentos = $listaOrcamentos->count();
            $valorTotalOrcamentos = $listaOrcamentos->sum('valor_final');
        }

        // Buscar lista de clientes para dropdowns na view
        $clientesDisponiveis = Cliente::all();

        return view('relatorios.index', compact(
            'totalClientes', 'totalOrcamentos', 'valorTotalOrcamentos',
            'listaClientes', 'listaOrcamentos', 'clientesDisponiveis', 'relatorioDetalhado'
        ));
    }
}
