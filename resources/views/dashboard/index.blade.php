@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Título -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>

    <!-- Cards de Estatísticas -->
    <div class="row">
        <!-- Total de Clientes -->
        <div class="col-md-3">
            <div class="card shadow-lg border-left-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon bg-primary text-white p-3 rounded">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="text-primary font-weight-bold">Total de Clientes</h6>
                            <h3 class="font-weight-bold">{{ $totalClientes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total de Orçamentos -->
        <div class="col-md-3">
            <div class="card shadow-lg border-left-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon bg-info text-white p-3 rounded">
                            <i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="text-info font-weight-bold">Total de Orçamentos</h6>
                            <h3 class="font-weight-bold">{{ $totalOrcamentos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orçamentos Aprovados -->
        <div class="col-md-3">
            <div class="card shadow-lg border-left-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon bg-success text-white p-3 rounded">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="text-success font-weight-bold">Orçamentos Aprovados</h6>
                            <h3 class="font-weight-bold">{{ $orcamentosAprovados }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Faturamento Total -->
        <div class="col-md-3">
            <div class="card shadow-lg border-left-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon bg-warning text-white p-3 rounded">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="text-warning font-weight-bold">Faturamento Total</h6>
                            <h3 class="font-weight-bold">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendente de Faturamento -->
        <div class="col-md-3 mt-3">
            <div class="card shadow-lg border-left-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-icon bg-danger text-white p-3 rounded">
                            <i class="fas fa-exclamation-circle fa-2x"></i>
                        </div>
                        <div class="ml-3">
                            <h6 class="text-danger font-weight-bold">Pendente de Faturamento</h6>
                            <h3 class="font-weight-bold">R$ {{ number_format($pendenteFaturamento, 2, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de O.S. -->
    <div class="row mt-4">
        <div class="col-xl-6 col-lg-6 mx-auto">
            <div class="card shadow-lg">
                <!-- Header do Gráfico -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status das Ordens de Serviço</h6>
                </div>

                <!-- Corpo do Gráfico -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="osStatusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle aguardando-autorizacao"></i> Aguardando Autorização
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle autorizado"></i> Autorizado
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle recusado"></i> Recusado
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle finalizado"></i> Finalizado
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script do Gráfico -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("osStatusChart").getContext("2d");
    var osStatusChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Aguardando Autorização", "Autorizado", "Recusado", "Finalizado"],
            datasets: [{
                data: [{{ $osAguardando ?? 0 }}, {{ $osAutorizado ?? 0 }}, {{ $osRecusado ?? 0 }}, {{ $osFinalizado ?? 0 }}],
                backgroundColor: ["yellow", "#1cc88a", "#e74a3b", "#4e73df"],
                hoverBackgroundColor: ["#e6e600", "#17a673", "#be2617", "#2a4bb8"],
                hoverBorderColor: "#fff",
            }],
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 75,
        },
    });
});
</script>

<!-- Estilos Personalizados -->
<style>
.card-body {
    white-space: nowrap; /* Impede que o texto quebre em várias linhas */
    overflow: hidden; /* Evita que o conteúdo ultrapasse o card */
    text-overflow: ellipsis; /* Adiciona "..." caso o texto fique muito grande */
}

.card-body h6 {
    font-size: 14px; /* Reduz um pouco o tamanho do título */
}

.card-body h3 {
    font-size: 20px; /* Mantém um tamanho legível para os números */
}

/* Ajuste para telas pequenas */
@media (max-width: 768px) {
    .card-body {
        white-space: normal; /* Permite quebra de linha apenas em telas pequenas */
        text-align: center;
    }
}

.dashboard-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.aguardando-autorizacao { color: #f6c23e; }
.autorizado { color: #1cc88a; }
.recusado { color: #e74a3b; }
.finalizado { color: #4e73df; }

.border-left-primary { border-left: 5px solid #4e73df !important; }
.border-left-info { border-left: 5px solid #36b9cc !important; }
.border-left-success { border-left: 5px solid #1cc88a !important; }
.border-left-warning { border-left: 5px solid #f6c23e !important; }
.border-left-danger { border-left: 5px solid #e74a3b !important; }

.shadow-lg {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15) !important;
}
</style>
@endsection
