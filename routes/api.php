<?php

use App\Http\Resources\PedidoResource;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pedidos/{pedido}', [App\Http\Controllers\PedidoController::class, 'getPedido'])->name('pedido');
Route::post('/exportar/pedidos/{pedido}', [App\Http\Controllers\PedidoController::class, 'exportarPedido'])->name('pedidoExportar');
Route::get('consultaDadosSolicitacao' , [App\Http\Controllers\PedidoController::class, 'consultaDadosSolicitacao'])->name('consultaDadosSolicitacao');
Route::get('importarAgendamento' , [App\Http\Controllers\PedidoController::class, 'importarAgendamento'])->name('consultaDadosSolicitacao');
Route::get('novaSolicitacao', [App\Http\Controllers\PedidoController::class, 'newRequest'])->name('novaSolicitacao');
Route::get('horarios-disponiveis', [App\Http\Controllers\PedidoController::class, 'availableHours'])->name('horarios-disponiveis');
Route::get('agendar-videoconferencia', [App\Http\Controllers\PedidoController::class, 'scheduleVC'])->name('agendar-videoconferencia');
Route::get('importar-documentos', [App\Http\Controllers\PedidoController::class, 'importDocuments'])->name('importar-documentos');
