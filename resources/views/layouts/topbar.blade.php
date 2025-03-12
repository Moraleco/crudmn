<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle -->
    <button id="sidebarToggle" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Notificações -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">{{ count(session('notificacoes', [])) }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                <h6 class="dropdown-header d-flex justify-content-between align-items-center">
                    Notificações
                    @if(session()->has('notificacoes') && count(session('notificacoes')) > 0)
                    <a href="{{ route('limpar.notificacoes') }}" class="small text-danger">Limpar Tudo</a>
                    @endif
                </h6>

                @forelse(session('notificacoes', []) as $notificacao)
                    <a class="dropdown-item d-flex align-items-center" href="{{ $notificacao['link'] }}">
                        <div class="mr-3">
                            @php
                                $tipo = $notificacao['tipo'] ?? 'outro';
                            @endphp
                            <div class="icon-circle 
                                @if($tipo == 'status') bg-warning 
                                @elseif($tipo == 'pagamento') bg-success 
                                @elseif($tipo == 'valor') bg-info 
                                @elseif($tipo == 'servico') bg-primary 
                                @elseif($tipo == 'exclusao') bg-danger
                                @elseif($tipo == 'cliente_exclusao') bg-dark 
                                @else bg-secondary 
                                @endif">
                                <i class="
                                    @if($tipo == 'status') fas fa-exclamation-triangle 
                                    @elseif($tipo == 'pagamento') fas fa-money-bill-wave 
                                    @elseif($tipo == 'valor') fas fa-dollar-sign 
                                    @elseif($tipo == 'servico') fas fa-tools 
                                    @elseif($tipo == 'exclusao') fas fa-trash-alt
                                    @elseif($tipo == 'cliente_exclusao') fas fa-user-times 
                                    @else fas fa-bell 
                                    @endif text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $notificacao['data'] ?? now()->format('d/m/Y H:i') }}</div>
                            <span class="font-weight-bold">{{ $notificacao['mensagem'] ?? 'Notificação sem mensagem' }}</span>
                        </div>
                    </a>
                @empty
                    <a class="dropdown-item text-center small text-gray-500" href="#">Nenhuma notificação</a>
                @endforelse
            </div>
        </li>
    </ul>
</nav>
