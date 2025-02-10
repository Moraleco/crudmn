<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Notificações -->
<!-- Notificações -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger badge-counter">{{ count(session('notificacoes', [])) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header d-flex justify-content-between align-items-center">
            Notificações
            @if(session()->has('notificacoes') && count(session('notificacoes')) > 0)
            
            @endif
        </h6>

        @forelse(session('notificacoes', []) as $notificacao)
            <a class="dropdown-item d-flex align-items-center" href="{{ $notificacao['link'] }}">
                <div class="mr-3">
                    @php
                        $tipo = $notificacao['tipo'] ?? 'outro'; // Evita erro Undefined array key
                    @endphp
                    <div class="icon-circle 
                        @if($tipo == 'status') bg-warning 
                        @elseif($tipo == 'pagamento') bg-success 
                        @elseif($tipo == 'valor') bg-info 
                        @elseif($tipo == 'servico') bg-primary 
                        @elseif($tipo == 'exclusao') bg-danger
                        @else bg-secondary 
                        @endif">
                        <i class="
                            @if($tipo == 'status') fas fa-exclamation-triangle 
                            @elseif($tipo == 'pagamento') fas fa-money-bill-wave 
                            @elseif($tipo == 'valor') fas fa-dollar-sign 
                            @elseif($tipo == 'servico') fas fa-tools 
                            @elseif($tipo == 'exclusao') fas fa-trash-alt
                            @else fas fa-bell 
                            @endif text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $notificacao['data'] ?? now()->format('d/m/Y H:i') }}</div>
                    <span class="font-weight-bold">{{ $notificacao['mensagem'] ?? 'Notificação sem mensagem' }}</span>
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="{{ route('limpar.notificacoes') }}">Limpar Notificações</a>
        @empty
            <a class="dropdown-item text-center small text-gray-500" href="#">Nenhuma notificação</a>
            
        @endforelse
    </div>
</li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        {{-- <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li> --}}

    </ul>

</nav>
