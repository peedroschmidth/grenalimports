<style>
    nav{
        font-size: 18px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">GRENAL IMPORTS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item" >
          <a @if($current=="home") class="nav-link active" @else class="nav-link" @endif aria-current="page" href="/">Início</a>
        </li>
        <li class="nav-item dropdown" >
          <a  @if($current=="vendas") class="nav-link dropdown-toggle active" @else class="nav-link dropdown-toggle" @endif href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Vendas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/vendas/novo">Nova Venda</a></li>
            <li><a class="dropdown-item" href="/vendas">Todas</a></li>
            <li><a class="dropdown-item" href="/vendasAberto">Em Aberto</a></li>
            <li><a class="dropdown-item" href="/vendasPendentes">Pendentes</a></li>
            <li><a class="dropdown-item" href="/vendasFinalizadas">Finalizadas</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a @if($current=="encomendas") class="nav-link dropdown-toggle active" @else class="nav-link dropdown-toggle" @endif href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Encomendas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/encomendas/novo">Nova Encomenda</a></li>
            <li><a class="dropdown-item" href="/encomendas">Todas</a></li>
            <li><a class="dropdown-item" href="/encomendas/aguardando">Aguardando</a></li>
            <li><a class="dropdown-item" href="/encomendas/transito">Em Trânsito</a></li>
            <li><a class="dropdown-item" href="/encomendas/recebidas">Finalizadas</a></li>
          </ul>
        </li>
        <li class="nav-item" >
          <a @if($current=="estoque") class="nav-link active" @else class="nav-link" @endif aria-current="page" href="/estoque">Estoque</a>
        </li>

        <li class="nav-item">
          <a @if($current=="contabilidade") class="nav-link active" @else class="nav-link" @endif aria-current="page" href="/contabilidade">Contabilidade</a>
        </li>
        <li class="nav-item">
          <a @if($current=="clientes") class="nav-link active" @else class="nav-link" @endif aria-current="page" href="/clientes">Clientes</a>
        </li>
        <li class="nav-item">
          <a @if($current=="fornecedores") class="nav-link active" @else class="nav-link" @endif aria-current="page" href="/fornecedores">Fornecedores</a>
        </li>
        <li class="nav-item dropdown" >
          <a @if($current=="painel") class="nav-link dropdown-toggle active" @else class="nav-link dropdown-toggle" @endif class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Painel
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/ligas">Ligas</a></li>
            <li><a class="dropdown-item" href="/clubes">Clubes</a></li>
            <li><a class="dropdown-item" href="/cores">Cores</a></li>
            <li><a class="dropdown-item" href="/tamanhos">Tamanhos</a></li>
            <li><a class="dropdown-item" href="/descricao">Descrição</a></li>
          </ul>
        </li>
        <li >
          <a class="nav-link" aria-current="page" href="/logout">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
