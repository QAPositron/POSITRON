<?php

use App\Http\Controllers\AsignarDosimetroController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\DosimetriaController;
use App\Http\Controllers\DosimetrosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\SedesController;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\TrabajadorsController;
use App\Models\Holder;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

/* Route::get('/',[PruebaController::class,'index1']); */
    //return view('welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');

/////////RUTAS PARA EL CRUD DE EMPRESAS///////
Route::get('empresas/search', [EmpresasController::class, 'search'])->name('empresas.search');

Route::get('empresas/create', [EmpresasController::class, 'create'])->name('empresas.create');
Route::post('empresas', [EmpresasController::class, 'save'])->name('empresas.save');
Route::get('empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit');
Route::put('empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update');
Route::delete('empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy');


Route::get('empresas/{empresa}/info', [EmpresasController::class, 'info'])->name('empresas.info');

/////////RUTAS PARA EL CRUD DE SEDES///////

Route::get('sedes/{sede}/create', [SedesController::class, 'create'])->name('sedes.create');
Route::post('sedes', [SedesController::class, 'save'])->name('sedes.save');
Route::get('sedes/{sede}/edit', [SedesController::class, 'edit'])->name('sedes.edit');
Route::put('sedes/{sede}', [SedesController::class, 'update'])->name('sedes.update');
Route::delete('sedes/{sede}', [SedesController::class, 'destroy'])->name('sedes.destroy');

/////////RUTAS PARA EL CRUD DE TRABAJADORES///////

Route::get('trabajadores/{trabajador}/create', [TrabajadorsController::class, 'create'])->name('trabajadores.create');
/* Route::get('/trabaja',[TrabajadorsController::class, 'select']); */
Route::post('trabajadores', [TrabajadorsController::class, 'save'])->name('trabajadores.save');
Route::get('trabajadores/{trabajador}/edit', [TrabajadorsController::class, 'edit'])->name('trabajadores.edit');
Route::put('trabajadores/{trabajador}', [TrabajadorsController::class, 'update'])->name('trabajadores.update');
Route::delete('trabajadores/{trabajador}', [TrabajadorsController::class, 'destroy'])->name('trabajadores.destroy');

/////////RUTAS PARA EL CRUD DE CONTACTOS///////

Route::get('contactos/{contacto}/create', [ContactosController::class, 'create'])->name('contactos.create');
Route::post('contactos', [ContactosController::class, 'save'])->name('contactos.save');
Route::get('contactos/{contacto}/edit', [ContactosController::class, 'edit'])->name('contactos.edit');
Route::put('contactos/{contacto}', [ContactosController::class, 'update'])->name('contactos.update');
Route::delete('contactos/{contacto}', [ContactosController::class, 'destroy'])->name('contactos.destroy');

/////////RUTAS PARA EL CRUD DE DOSIMETROS///////
Route::get('dosimetros/search', [DosimetrosController::class, 'search'])->name('dosimetros.search');

Route::get('dosimetros/create', [DosimetrosController::class, 'create'])->name('dosimetros.create');
Route::post('dosimetros', [DosimetrosController::class, 'save'])->name('dosimetros.save');
Route::get('dosimetros/{dosimetro}/edit', [DosimetrosController::class, 'edit'])->name('dosimetros.edit');
Route::put('dosimetros/{dosimetro}', [DosimetrosController::class, 'update'])->name('dosimetros.update');
Route::delete('dosimetros/{dosimetro}', [DosimetrosController::class, 'destroy'])->name('dosimetros.destroy');

/////////RUTAS PARA EL CRUD DE HOLDERS///////
Route::get('holders/search', [HolderController::class, 'search'])->name('holders.search');

Route::get('holders/create', [HolderController::class, 'create'])->name('holders.create');
Route::post('holders', [HolderController::class, 'save'])->name('holders.save');
Route::get('holders/{holder}/edit', [HolderController::class, 'edit'])->name('holders.edit');
Route::put('holders/{holder}', [HolderController::class, 'update'])->name('holders.update');
Route::delete('holders/{holder}', [HolderController::class, 'destroy'])->name('holders.destroy');

/////////RUTAS PARA DOSIMETRIA///////
Route::get('empresasdosicreate', [DosimetriaController::class, 'createEmpresa'])->name('empresasdosi.create');
Route::post('empresasdosi', [DosimetriaController::class, 'saveEmpresa'])->name('empresasdosi.save');

Route::get('contratosdosicreate/{contratodosi}/create', [DosimetriaController::class, 'createContrato'])->name('contratosdosi.create');
Route::post('contratosdosi', [DosimetriaController::class, 'saveContrato'])->name('contratosdosi.save');
Route::post('contratosdosisede', [DosimetriaController::class, 'saveSedeContrato'])->name('contratosdosisede.save');

Route::get('detallecontrato/{detcont}/create', [DosimetriaController::class, 'createdetalleContrato'])->name('detallecontrato.create');
Route::get('detallesedecont/{detsedcont}/create',[DosimetriaController::class, 'createdetsedeContrato'])->name('detallesedecont.create');
/////////RUTAS PARA EL CRUD DE ASIGNACION DOSIMETROS///////

Route::get('asignadosicontrato/{asigdosicont}/create', [DosimetriaController::class, 'asignaDosiContrato'])->name('asignadosicontrato.create');
Route::post('asignadosicontrato', [DosimetriaController::class, 'saveAsignacionDosiContrato'])->name('asignadosicontrato.save');

///////DELETE DOSIMETRO FOR WORK////////
Route::delete('eliminatedDosiForWork/{idWork}/{contratoId}', [DosimetriaController::class, 'deleteDosimetro'])->name('dosimetroWork.destroy');
Route::delete('eliminatedDosiControl/{idDosiControl}/{contratoId}', [DosimetriaController::class, 'deleteDosimetroControl'])->name('dosimetroControl.destroy');
Route::delete('eliminatedTrabajadorSede/{idWork}/{contratoId}', [DosimetriaController::class, 'deleteTrabajadorSede'])->name('trabajadorSede.destroy');
Route::post('createdTrabajadorSede', [DosimetriaController::class, 'createTrabajadorSede'])->name('trabajadorSede.create');



Route::get('asignadosicreate', [AsignarDosimetroController::class, 'create'])->name('asignadosis.create');
Route::get('asignadosi', [AsignarDosimetroController::class, 'save'])->name('asignadosis.save');


Route::get('/prueba1', [PruebaController::class,'index']);
Route::post('/prueba1', [PruebaController::class, 'sedes']);
Route::post('/prueba',[PruebaController::class,'prueba']);

Route::get('pruebacreate',[PruebaController::class,'index1']);
Route::get('/prueba2',[PruebaController::class,'prueba2']);
Route::get('/prueba3',[PruebaController::class,'prueba3']);
Route::get('/prueba4',[PruebaController::class,'prueba4']);

/* Route::post('/prueba', function(Request $request){
    $name = $request->input('name');
    $surname = $request->input('surname');
    echo "tu nombre es $name y tu apellido es $surname";
}); */
