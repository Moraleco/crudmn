<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon"><i class="fas fa-code"></i></div>
        <div class="sidebar-brand-text mx-3">ORÇA FÁCIL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Cadastro -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastro" aria-expanded="true">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Cadastro</span>
        </a>
        <div id="collapseCadastro" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clientes</h6>
                <a class="collapse-item" href="{{route('clientes.index')}}">Clientes</a>
                <a class="collapse-item" href="{{route('clientes.create')}}">Novo Cliente</a>
            </div>
        </div>
    </li>

    <!-- Relatórios -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelatorios" aria-expanded="true">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseRelatorios" class="collapse">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Relatórios:</h6>
                <a class="collapse-item" href="{{route('relatorios.index')}}">Ordens de Serviço</a>
            </div>
        </div>
    </li>

</ul>
