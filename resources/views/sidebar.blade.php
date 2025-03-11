<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ORÇA FÁCIL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Nav Item - Cadastro -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastro" aria-expanded="true" aria-controls="collapseCadastro">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Cadastro</span>
        </a>
        <div id="collapseCadastro" class="collapse" aria-labelledby="headingCadastro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clientes</h6>
                <a class="collapse-item" href="{{route('clientes.index')}}">Clientes</a>
                <a class="collapse-item" href="{{route('clientes.create')}}">Novo Cliente</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Ordem de Serviço -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Ordem de Serviço</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ordem de Serviço:</h6>
                <a class="collapse-item" href="{{route('orcamentos.create')}}">Nova Ordem de Serviço</a>
                <a class="collapse-item" href="{{route('orcamentos.index')}}">Ordens de Serviço</a>
                <a class="collapse-item" href="#">Alterar Ordem de Serviço</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Relatórios -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelatorios" aria-expanded="true" aria-controls="collapseRelatorios">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseRelatorios" class="collapse" aria-labelledby="headingRelatorios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Relatórios:</h6>
                <a class="collapse-item" href="{{route('relatorios.index')}}">Ordens de Serviço</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Footer -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('img/ifms.png') }}" alt="...">
        <p class="text-center mb-2"><strong>TCC</strong> para o curso Sistemas para Internet - TSI <br> Alunos: Gabriel, Giovana e Lucas</p>
        <a class="btn btn-success btn-sm" href="https://github.com/Moraleco">Meu GitHub</a>
    </div>

</ul>
<!-- End of Sidebar -->
