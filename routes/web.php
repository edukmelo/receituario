<?php

use App\Http\Controllers\cadPacientesController;
use App\Http\Controllers\farmacias;
use App\Http\Controllers\geraReceita;
use App\Http\Controllers\homeController;
use App\Http\Controllers\listaReceitas;
use App\Http\Controllers\medicamentoController;
use App\Http\Controllers\medicoController;
use App\Http\Controllers\usuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', homeController::class)->name('home');
Route::post('painel', [usuarioController::class, 'login'])->name('usuarios.login');

Route::get('home', [medicoController::class, 'index'])->name('medicos.index');
Route::get('/', [usuarioController::class, 'logout'])->name('usuarios.logout');
Route::put('admin/{usuario}', [medicoController::class, 'editar'])->name('medico.editar');

Route::get('paciente', [cadPacientesController::class, 'index'])->name('pacientes.index');
Route::post('pacientes', [cadPacientesController::class, 'insert'])->name('pacientes.insert');
Route::get('pacientes/inserir', [cadPacientesController::class, 'create'])->name('pacientes.inserir');
Route::get('pacientes/{item}/edit', [cadPacientesController::class, 'edit'])->name('pacientes.edit');
Route::put('pacientes/{item}', [cadPacientesController::class, 'editar'])->name('pacientes.editar');
Route::delete('pacientes/{item}', [cadPacientesController::class, 'delete'])->name('pacientes.delete');
Route::get('pacientes/{item}/delete', [cadPacientesController::class, 'modal'])->name('pacientes.modal');
Route::get('pesquisapac', [cadPacientesController::class, 'pesquisa'])->name('pesqpacientes.index');

Route::get('medicamentos', [medicamentoController::class, 'index'])->name('medicamentos.index');
Route::get('pesquisa', [medicamentoController::class, 'pesquisa'])->name('pesqmedicamentos.index');

Route::get('pesqpacrec', [geraReceita::class, 'pesquisaPaciente'])->name('pesqpacrec.index');
Route::get('inicializareceita/{item}', [geraReceita::class, 'inicializaReceita'])->name('inicializareceita.index');
Route::get('addmedicamentos/{item}', [geraReceita::class, 'addMedicamentos'])->name('addmedicamentos.index');
Route::post('incluimedicamentos/{receita}', [geraReceita::class, 'incluiMedicamentos'])->name('incluimedicamentos.index');
Route::post('receitas', [geraReceita::class, 'insertRec'])->name('receitas.insert');
Route::get('receitas/inserir/{idreceita}', [geraReceita::class, 'createRec'])->name('receitas.inserir');
Route::post('finalizareceita/{idreceita}', [geraReceita::class, 'finalizaReceita'])->name('finalizareceita.index');


Route::get('indicelistareceitas/', [geraReceita::class, 'listaReceitas'])->name('listareceitas.index');
Route::get('listareceitas/{paciente}', [geraReceita::class, 'listaPacRec'])->name('listapacrec.index');
Route::get('monta/{idreceita}', [geraReceita::class, 'montaReceita'])->name('montareceita.index');

// Rotas Painel Pacientes
Route::get('paclistareceitas/{paciente}', [listaReceitas::class, 'listaRec'])->name('paclistapacrec.index');
Route::get('paclistareceitasin/{paciente}', [listaReceitas::class, 'listaRecIn'])->name('paclistapacrecin.index');
Route::get('homepac', [listaReceitas::class, 'index'])->name('homepac.index');
Route::get('pacmonta/{idreceita}', [listaReceitas::class, 'montaReceita'])->name('pacmontareceita.index');

// Rotas Painel Farmacias
Route::get('indicepacientes/', [farmacias::class, 'listaClientes'])->name('indicepacientes.index');
Route::get('listarec/{paciente}', [farmacias::class, 'listarec'])->name('listarec.index');
Route::get('farmonta/{idreceita}', [farmacias::class, 'montaRec'])->name('farmontareceita.index');
Route::get('homefar', [farmacias::class, 'index'])->name('homefar.index');
Route::get('utiliza/{idreceita}', [farmacias::class, 'inserirUso'])->name('utiliza.inserir');
Route::post('utilizar', [farmacias::class, 'insertUso'])->name('utiliza.insert');


