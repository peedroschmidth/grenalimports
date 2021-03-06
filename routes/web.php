<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\ClubeController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ContabilidadeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\DescricaoController;
use App\Http\Controllers\TamanhoController;

//Cores
Route::get('/cores',[CorController::class,'index']);
Route::get('/cores/apagar/{id}', [CorController::class, 'destroy']);
Route::get('/cores/editar/{id}', [CorController::class, 'edit']);
Route::post('/cores/{id}', [CorController::class, 'update']);
Route::get('/cores/novo', [CorController::class, 'create']);
Route::post('/cores', [CorController::class, 'store']);

//Tamanhos
Route::get('/tamanhos',[TamanhoController::class,'index']);
Route::get('/tamanhos/apagar/{id}', [TamanhoController::class, 'destroy']);
Route::get('/tamanhos/editar/{id}', [TamanhoController::class, 'edit']);
Route::post('/tamanhos/{id}', [TamanhoController::class, 'update']);
Route::get('/tamanhos/novo', [TamanhoController::class, 'create']);
Route::post('/tamanhos', [TamanhoController::class, 'store']);

//Descricao
Route::get('/descricao',[DescricaoController::class,'index']);
Route::get('/descricao/apagar/{id}', [DescricaoController::class, 'destroy']);
Route::get('/descricao/editar/{id}', [DescricaoController::class, 'edit']);
Route::post('/descricao/{id}', [DescricaoController::class, 'update']);
Route::get('/descricao/novo', [DescricaoController::class, 'create']);
Route::post('/descricao', [DescricaoController::class, 'store']);

//Ligas
Route::get('/ligas',[LigaController::class,'index']);
Route::get('/ligas/apagar/{id}', [LigaController::class, 'destroy']);
Route::get('/ligas/editar/{id}', [LigaController::class, 'edit']);
Route::post('/ligas/{id}', [LigaController::class, 'update']);
Route::get('/ligas/novo', [LigaController::class, 'create']);
Route::post('/ligas', [LigaController::class, 'store']);

//Clubes
Route::get('/clubes',[ClubeController::class,'index']);
Route::get('/clubes/apagar/{id}', [ClubeController::class, 'destroy']);
Route::get('/clubes/editar/{id}', [ClubeController::class, 'edit']);
Route::post('/clubes/{id}', [ClubeController::class, 'update']);
Route::get('/clubes/novo', [ClubeController::class, 'create']);
Route::post('/clubes', [ClubeController::class, 'store']);

//Fornecedores
Route::get('/fornecedores',[FornecedorController::class,'index']);
Route::get('/fornecedores/apagar/{id}', [FornecedorController::class, 'destroy']);
Route::get('/fornecedores/editar/{id}', [FornecedorController::class, 'edit']);
Route::post('/fornecedores/{id}', [FornecedorController::class, 'update']);
Route::get('/fornecedores/novo', [FornecedorController::class, 'create']);
Route::post('/fornecedores', [FornecedorController::class, 'store']);

//Clientes
Route::get('/clientesPesquisar',[ClienteController::class, 'teste']);
Route::get('/clientes',[ClienteController::class,'index']);
Route::get('/clientes/apagar/{id}', [ClienteController::class, 'destroy']);
Route::get('/clientes/editar/{id}', [ClienteController::class, 'edit']);
Route::post('/clientes/{id}', [ClienteController::class, 'update']);
Route::get('/clientes/novo', [ClienteController::class, 'create']);
Route::post('/clientes', [ClienteController::class, 'store']);

//Vendas
Route::get('/vendas',[VendaController::class,'index']);
Route::get('/vendas/apagar/{id}', [VendaController::class, 'destroy']);
Route::get('/vendas/editar/{id}', [VendaController::class, 'edit']);
Route::post('/vendas/{id}', [VendaController::class, 'update']);
Route::get('/vendas/novo', [VendaController::class, 'create']);
Route::post('/vendas', [VendaController::class, 'store']);
Route::get('/vendasAberto', [VendaController::class, 'vendasAberto']);
Route::get('/vendasFinalizadas', [VendaController::class, 'vendasFinalizadas']);
Route::get('/vendasPendentes', [VendaController::class, 'vendasPendentes']);
Route::post('/vendasRelatorio', [VendaController::class, 'relatorio']);


//Encomendas
Route::get('/encomendas',[EncomendaController::class,'index']);
Route::get('/encomendas/apagar/{id}', [EncomendaController::class, 'destroy']);
Route::get('/encomendas/editar/{id}', [EncomendaController::class, 'edit']);
Route::post('/encomendas/{id}', [EncomendaController::class, 'update']);
Route::get('/encomendas/novo', [EncomendaController::class, 'create']);
Route::post('/encomendas', [EncomendaController::class, 'store']);
Route::post('/encomendasCriar', [EncomendaController::class, 'criarEncomenda']);
Route::post('/encomendasIncluir', [EncomendaController::class, 'encomendasIncluir']);
Route::get('/encomendas/removerItem/{id}', [EncomendaController::class, 'encomendasRemover']);
Route::get('/encomendas/aguardando',[EncomendaController::class,'encomendasAguardando']);
Route::get('/encomendas/transito',[EncomendaController::class,'encomendasTransito']);
Route::get('/encomendas/confirmarRecebimento/{id}',[EncomendaController::class,'confirmarRecebimento']);
Route::get('/encomendas/recebidas',[EncomendaController::class,'encomendasRecebidas']);
//alterar o nome dos m??tdos, colocar encomendas/aguardando, vendas/finalizadas... etc

//Dashboard
Route::get('/dashboard', [DashboardController::class,'dashboard']);

//Estoque
Route::get('/estoque',[EstoqueController::class,'index']);
Route::get('/estoque/vender/{id}',[EstoqueController::class,'vender']);
Route::post('/estoque/confirmar/{id}',[EstoqueController::class,'confirmarVenda']);
Route::get('/estoque/apagar/{id}', [EstoqueController::class, 'destroy']);
Route::get('/estoque/editar/{id}', [EstoqueController::class, 'edit']);
Route::post('/estoque/{id}', [EstoqueController::class, 'update']);
Route::get('/estoque/novo', [EstoqueController::class, 'create']);
Route::post('/estoque', [EstoqueController::class, 'store']);

//Contabilidade
Route::get('/contabilidade',[ContabilidadeController::class,'index']);
Route::post('/contabilidade/adicionar',[ContabilidadeController::class,'adicionar']);
Route::post('/contabilidade/adicionar/{id}',[ContabilidadeController::class,'adicionarValor']);
Route::get('/contabilidade/apagar/{id}', [ContabilidadeController::class, 'destroy']);
Route::post('/contabilidade/relatorio', [ContabilidadeController::class, 'relatorio']);

//Classe inicial
Route::get('/', [IndexController::class, 'index']);


Auth::routes();

Route::get('/logout', [LoginController::class,'logout']);

//Route::get('/home', [HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
