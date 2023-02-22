<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateTime;

use App\Http\Controllers\ContatoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Contatos */
Route::get('/contatos', [ContatoController::class, 'index']);

/* Buscar Contatos */
Route::get('/contatos/busca', [ContatoController::class, 'search']);

/* Criar Contatos */
Route::POST('/novocontato', [ContatoController::class, 'create'])->name('criar');

/* Atualizar Contatos */
Route::get('/contato/editar/{id}', [ContatoController::class, 'edit'])->name('editar');
Route::put('/update/{id}', [ContatoController::class, 'update'])->name('atualizar');

/* Deletar Contatos */
Route::delete('/contato/delete/{id}', [ContatoController::class, 'destroy']);
