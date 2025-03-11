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
            <div class="dropdown-menu dropdown-menu-right shadow">
                <h6 class="dropdown-header">Notificações</h6>
                @forelse(session('notificacoes', []) as $notificacao)
                    <a class="dropdown-item" href="{{ $notificacao['link'] }}">
                        <div class="small text-gray-500">{{ $notificacao['data'] }}</div>
                        <span class="font-weight-bold">{{ $notificacao['mensagem'] }}</span>
                    </a>
                @empty
                    <a class="dropdown-item text-center small text-gray-500" href="#">Nenhuma notificação</a>
                @endforelse
            </div>
        </li>
    </ul>
</nav>
