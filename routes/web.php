<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ConfiguracaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('clientes', ClienteController::class);
Route::resource('orcamentos', OrcamentoController::class);
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/orcamentos/{orcamento}/pdf', [OrcamentoController::class, 'generatePDF'])->name('orcamentos.pdf');
Route::get('/limpar-notificacoes', function () {
    session()->forget('notificacoes');
    return redirect()->back();
})->name('limpar.notificacoes');
Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes.index');
Route::post('/configuracoes', [ConfiguracaoController::class, 'update'])->name('configuracoes.update');




