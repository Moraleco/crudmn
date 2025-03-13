<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon"><i class="fas fa-code"></i></div>
        <div class="sidebar-brand-text mx-3">ORÇA FÁCIL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Cadastro -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastro"
            aria-expanded="false" aria-controls="collapseCadastro">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Cadastro</span>
        </a>
        <div id="collapseCadastro" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clientes</h6>
                <a class="collapse-item" href="{{route('clientes.index')}}">Clientes</a>
                <a class="collapse-item" href="{{route('clientes.create')}}">Novo Cliente</a>
            </div>
        </div>
    </li>

    <!-- Ordens de Serviço -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOS" aria-expanded="false"
            aria-controls="collapseOS">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Ordem de Serviço</span>
        </a>
        <div id="collapseOS" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ordens de Serviço</h6>
                <a class="collapse-item" href="{{route('orcamentos.create')}}">Nova Ordem</a>
                <a class="collapse-item" href="{{route('orcamentos.index')}}">Ver Ordens</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Relatórios -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelatorios"
            aria-expanded="false" aria-controls="collapseRelatorios">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseRelatorios" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Relatórios</h6>
                <a class="collapse-item" href="{{route('relatorios.index')}}">Relatórios de O.S</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Configurações -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguracoes"
            aria-expanded="true" aria-controls="collapseConfiguracoes">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Configurações</span>
        </a>
        <div id="collapseConfiguracoes" class="collapse" aria-labelledby="headingConfiguracoes"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Configuração Geral:</h6>
                <a class="collapse-item" href="{{ route('configuracoes.index') }}">Empresa</a>
            </div>
        </div>
    </li>


    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('img/ifms.png') }}" alt="...">
        <p class="text-center mb-2"><strong>TCC</strong> para o curso Sistemas para Internet - TSI <br> Alunos: Gabriel,
            Giovana e Lucas</p>
        <a class="btn btn-success btn-sm" href="https://github.com/Moraleco">Meu GitHub</a>
    </div>

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>