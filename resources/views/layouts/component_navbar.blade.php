<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">GRENAL IMPORTS
      </a>
    </div>
    <ul class="nav navbar-nav">
        <li @if($current=="home") class="active" @endif><a href="/">Início</a></li>
        <li @if($current=="vendas") class="active" @endif class="dropdown" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Vendas</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/vendas/novo">Nova Venda</a></li>
                <li><a href="/vendas">Todas</a></li>
                <li><a href="/vendasAberto">Em Aberto</a></li>
                <li><a href="/vendasPendentes">Pendentes</a></li>
                <li><a href="/vendasFinalizadas">Finalizadas</a></li>
            </ul>
        </li>
        <li @if($current=="encomendas") class="active" @endif class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Encomendas</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/encomendas/novo">Nova Encomenda</a></li>
                <li><a href="/encomendas">Todas</a></li>
                <li><a href="/encomendas/aguardando">Aguardando</a></li>
                <li><a href="/encomendas/transito">Em Trânsito</a></li>
                <li><a href="/encomendas/recebidas">Recebidas</a></li>
            </ul>
        </li>
        <li @if($current=="estoque") class="active" @endif><a href="/estoque">Estoque</a></li>
        <li @if($current=="contabilidade") class="active" @endif><a href="/contabilidade">Contabilidade</a></li>
        <li @if($current=="clientes") class="active" @endif><a href="/clientes">Clientes</a></li>
        <li @if($current=="fornecedores") class="active" @endif><a href="/fornecedores">Fornecedores</a></li>
        <li @if($current=="painel") class="active" @endif class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Painel</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="/ligas">Ligas</a></li>
                <li><a href="/clubes">Clubes</a></li>
                <li><a href="#">Descrição</a></li>
                <li><a href="#">Tamanho</a></li>
                <li><a href="#">Cores</a></li>
            </ul>
        </li>
        <li @if($current=="sair") class="active" @endif><a href="/logout">Sair</a></li>
    </ul>
  </div>
</nav>