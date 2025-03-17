<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Orcamento;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalOrcamentos = Orcamento::count();
        $orcamentosAprovados = Orcamento::where('status', 'Autorizado')->count();
    
        // Contagem das O.S. por status
        $osAguardando = Orcamento::where('status', 'Aguardando Autorização')->count();
        $osAutorizado = Orcamento::where('status', 'Autorizado')->count();
        $osRecusado = Orcamento::where('status', 'Recusado')->count();
        $osFinalizado = Orcamento::where('status', 'Finalizado')->count();
    
        // Calcular Faturamento Total (somente orçamentos com situação de pagamento "Pago")
        $faturamentoTotal = Orcamento::where('situacao_pagamento', 'Pago')->sum('valor_final');

        // Calcular valores pendentes de faturamento (orçamentos "A Pagar")
        $pendenteFaturamento = Orcamento::where('situacao_pagamento', 'A Pagar')->sum('valor_final');

        return view('dashboard.index', compact(
            'totalClientes', 'totalOrcamentos', 'orcamentosAprovados', 
            'faturamentoTotal', 'pendenteFaturamento', 
            'osAguardando', 'osAutorizado', 'osRecusado', 'osFinalizado'
        ));
    }
}
