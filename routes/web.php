<?php

use App\Http\Controllers\AreadepartamentosedeController;
use App\Http\Controllers\AsignarDosimetroController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DepartamentosedeController;
use App\Http\Controllers\DepartamentosedesController;
use App\Http\Controllers\DosimetriaController;
use App\Http\Controllers\DosimetrosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiderdosimrolController;
use App\Http\Controllers\MesescontdosisedeptosController;
use App\Http\Controllers\NovedadesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\PerfilespersonasController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PersonasedesController;
use App\Http\Controllers\PersonasperfilesController;
use App\Http\Controllers\PersonasrolesController;
/* use App\Http\Controllers\PersonasrolesController; */
use App\Http\Controllers\ProductoController;
/* use App\Http\Controllers\RolesController; */
use App\Http\Controllers\SedesController;
use App\Http\Controllers\TrabajadorsController;
use App\Http\Livewire\FormTrabajador;
use App\Models\Areadepartamentosede;
use App\Models\Departamento;
use App\Models\Departamentosede;
use App\Models\Holder;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
////////DEBIDO AL POCO TIEMPO QUE TUVE PARA IMPLEMENTAR LOS MIDDLEWARE DE LAS RUTAS SE TUVIERON QUE DUPLICAR PARA LOS PERMISOS DE ADMIN Y SUPERADMIN :( ///////
/* Route::get('/',[PruebaController::class,'index1']); */
    //return view('welcome');

Route::get('/', [HomeController::class, 'login'])->name('login'); 
/*Route::get('home', [HomeController::class, 'index'])->name('home'); */
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('can:superadmin.home');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('can:admin.home');
/////////RUTAS PARA EL CRUD DE EMPRESAS///////PERMISO SUPERADMIN////
Route::get('empresas/search', [EmpresasController::class, 'search'])->name('empresas.search')->middleware('can:superadmin.home');
Route::get('empresas/create', [EmpresasController::class, 'create'])->name('empresas.create')->middleware('can:superadmin.home');
Route::get('/empresas/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:superadmin.home');
Route::get('/empresas/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:superadmin.home');
Route::get('/sedes/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:superadmin.home');
Route::post('empresas', [EmpresasController::class, 'save'])->name('empresas.save')->middleware('can:superadmin.home');
Route::get('empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit')->middleware('can:superadmin.home');
Route::put('empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update')->middleware('can:superadmin.home');
Route::delete('empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy')->middleware('can:superadmin.home');
Route::get('empresas/{empresa}/info', [EmpresasController::class, 'info'])->name('empresas.info')->middleware('can:superadmin.home');
Route::get('empresas/{empresa}/info#sede', [EmpresasController::class, 'info'])->name('empresas.infosede')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE EMPRESAS///////PERMISO ADMIN////
Route::get('empresas/search', [EmpresasController::class, 'search'])->name('empresas.search')->middleware('can:admin.home');
Route::get('empresas/create', [EmpresasController::class, 'create'])->name('empresas.create')->middleware('can:admin.home');
Route::get('/empresas/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:admin.home');
Route::get('/empresas/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:admin.home');
Route::get('/sedes/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios'])->middleware('can:admin.home');
Route::post('empresas', [EmpresasController::class, 'save'])->name('empresas.save')->middleware('can:admin.home');
Route::get('empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit')->middleware('can:admin.home');
Route::put('empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update')->middleware('can:admin.home');
/* Route::delete('empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy'); */
Route::get('empresas/{empresa}/info', [EmpresasController::class, 'info'])->name('empresas.info')->middleware('can:admin.home');
Route::get('empresas/{empresa}/info#sede', [EmpresasController::class, 'info'])->name('empresas.infosede')->middleware('can:admin.home');

/////////RUTAS PARA EL CRUD DE SEDES///////PERMISO SUPERADMIN////
Route::get('sedes/{sede}/create', [SedesController::class, 'create'])->name('sedes.create')->middleware('can:superadmin.home');
Route::get('/sedes/{sede}/sedesdeptomuni', [SedesController::class, 'selectmunicipios'])->middleware('can:superadmin.home');
Route::post('sedes', [SedesController::class, 'save'])->name('sedes.save')->middleware('can:superadmin.home');
Route::post('departamentos', [DepartamentoController::class, 'save'])->name('departamento.save')->middleware('can:superadmin.home');
Route::get('sedes/{sede}/edit', [SedesController::class, 'edit'])->name('sedes.edit')->middleware('can:superadmin.home');
Route::put('sedes/{sede}', [SedesController::class, 'update'])->name('sedes.update')->middleware('can:superadmin.home');
Route::delete('sedes/{sede}', [SedesController::class, 'destroy'])->name('sedes.destroy')->middleware('can:superadmin.home');
Route::delete('empresas/{empresa}/{depto}/destroydepto', [DepartamentosedeController::class, 'destroydepa'])->name('sedesdepto.destroydepa')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE SEDES///////PERMISO ADMIN////
Route::get('sedes/{sede}/create', [SedesController::class, 'create'])->name('sedes.create')->middleware('can:admin.home');
Route::get('/sedes/{sede}/sedesdeptomuni', [SedesController::class, 'selectmunicipios'])->middleware('can:admin.home');
Route::post('sedes', [SedesController::class, 'save'])->name('sedes.save')->middleware('can:admin.home');
Route::post('departamentos', [DepartamentoController::class, 'save'])->name('departamento.save')->middleware('can:admin.home');
Route::get('sedes/{sede}/edit', [SedesController::class, 'edit'])->name('sedes.edit')->middleware('can:admin.home');
Route::put('sedes/{sede}', [SedesController::class, 'update'])->name('sedes.update')->middleware('can:admin.home');
/* Route::delete('sedes/{sede}', [SedesController::class, 'destroy'])->name('sedes.destroy');
Route::delete('empresas/{empresa}/{depto}/destroydepto', [DepartamentosedeController::class, 'destroydepa'])->name('sedesdepto.destroydepa'); */

/*------------RUTAS PARA EL CRUD DE LAS AREAS PARA LOS DEPARTAMENTOS---------PERMISO SUPERADMIN----- */
Route::post('areadeptosave', [AreadepartamentosedeController::class, 'save'])->name('areadepto.save')->middleware('can:superadmin.home');
Route::put('areadeptoupdate/{area}', [AreadepartamentosedeController::class, 'update'])->name('areadepto.update')->middleware('can:superadmin.home');
Route::delete('areadeptodestroy/{area}', [AreadepartamentosedeController::class, 'destroy'])->name('areadepto.destroy')->middleware('can:superadmin.home');
/*------------RUTAS PARA EL CRUD DE LAS AREAS PARA LOS DEPARTAMENTOS--------PERMISO ADMIN------ */
Route::post('areadeptosave', [AreadepartamentosedeController::class, 'save'])->name('areadepto.save')->middleware('can:admin.home');
Route::put('areadeptoupdate/{area}', [AreadepartamentosedeController::class, 'update'])->name('areadepto.update')->middleware('can:admin.home');
/* Route::delete('areadeptodestroy/{area}', [AreadepartamentosedeController::class, 'destroy'])->name('areadepto.destroy'); */


/////////RUTAS PARA EL CRUD DE PERFILES/////
/* Route::post('perfiles', [PerfilesController::class, 'save'])->name('perfiles.save'); */


/////////RUTAS PARA EL CRUD DE ROLES/////
/* Route::post('roles', [RolesController::class, 'save'])->name('roles.save'); */

/////////RUTAS PARA EL CRUD DE PERSONAS//////PERMISO SUPERADMIN////
Route::get('personas/search', [PersonaController::class, 'search'])->name('personas.search')->middleware('can:superadmin.home');
Route::get('personas/create', [PersonaController::class, 'create'])->name('personas.create')->middleware('can:superadmin.home');
Route::get('personas/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:superadmin.home'); 
Route::post('personas', [PersonaController::class, 'save'])->name('personas.save')->middleware('can:superadmin.home');
Route::get('personas/{empresa}/{trabestucont}/create',[PersonaController::class, 'createTrabEstuContEmp'])->name('personasEmpresa.create')->middleware('can:superadmin.home');
Route::post('personasEmpresa', [PersonaController::class, 'savePersonasEmpresa'])->name('personasEmpresa.save')->middleware('can:superadmin.home');
Route::get('personas/{persona}/{trabestucont}/{empresa}/edit', [PersonaController::class, 'edit'])->name('personas.edit')->middleware('can:superadmin.home');
Route::get('/personas/{empresa}/{trabestucont}/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:superadmin.home');
Route::get('/personas/{empresa}/{trabestucont}/personasedes', [PersonaController::class, 'personasedes'])->middleware('can:superadmin.home');
Route::get('/personas/{empresa}/{trabestucont}/{persona}/personsedes', [PersonaController::class, 'personasedes'])->middleware('can:superadmin.home');
Route::get('/personas/{persona}/{empresa}/{trabestucont}/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:superadmin.home');
Route::put('personas/{persona}', [PersonaController::class, 'update'])->name('personas.update')->middleware('can:superadmin.home');
Route::delete('personas/{persona}', [PersonaController::class, 'destroy'])->name('personas.destroy')->middleware('can:superadmin.home');
Route::delete('personasperfil/{personaperfil}', [PersonasperfilesController::class, 'destroy'])->name('personaperfil.destroy')->middleware('can:superadmin.home');
Route::delete('personasrol/{personarol}/{sede}', [PersonasrolesController::class, 'destroy'])->name('personarol.destroy')->middleware('can:superadmin.home');
Route::delete('personasede/{personasede}', [PersonasedesController::class, 'destroy'])->name('personasede.destroy')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE PERSONAS//////PERMISO ADMIN////
Route::get('personas/search', [PersonaController::class, 'search'])->name('personas.search')->middleware('can:admin.home');
Route::get('personas/create', [PersonaController::class, 'create'])->name('personas.create')->middleware('can:admin.home');
Route::get('personas/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:admin.home'); 
Route::post('personas', [PersonaController::class, 'save'])->name('personas.save')->middleware('can:admin.home');
Route::get('personas/{empresa}/{trabestucont}/create',[PersonaController::class, 'createTrabEstuContEmp'])->name('personasEmpresa.create')->middleware('can:admin.home');
Route::post('personasEmpresa', [PersonaController::class, 'savePersonasEmpresa'])->name('personasEmpresa.save')->middleware('can:admin.home');
Route::get('personas/{persona}/{trabestucont}/{empresa}/edit', [PersonaController::class, 'edit'])->name('personas.edit')->middleware('can:admin.home');
Route::get('/personas/{empresa}/{trabestucont}/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:admin.home');
Route::get('/personas/{empresa}/{trabestucont}/personasedes', [PersonaController::class, 'personasedes'])->middleware('can:admin.home');
Route::get('/personas/{empresa}/{trabestucont}/{persona}/personsedes', [PersonaController::class, 'personasedes'])->middleware('can:admin.home');
Route::get('/personas/{persona}/{empresa}/{trabestucont}/selectsedes', [PersonaController::class, 'selectsedes'])->middleware('can:admin.home');
Route::put('personas/{persona}', [PersonaController::class, 'update'])->name('personas.update')->middleware('can:admin.home');
/* Route::delete('personas/{persona}', [PersonaController::class, 'destroy'])->name('personas.destroy');
Route::delete('personasperfil/{personaperfil}', [PersonasperfilesController::class, 'destroy'])->name('personaperfil.destroy');
Route::delete('personasrol/{personarol}/{sede}', [PersonasrolesController::class, 'destroy'])->name('personarol.destroy');
Route::delete('personasede/{personasede}', [PersonasedesController::class, 'destroy'])->name('personasede.destroy'); */

/////////RUTAS PARA EL CRUD DE DOSIMETROS///////PERMISO SUPERADMIN/////
Route::get('dosimetros/search', [DosimetrosController::class, 'search'])->name('dosimetros.search')->middleware('can:superadmin.home');
Route::get('dosimetros/create', [DosimetrosController::class, 'create'])->name('dosimetros.create')->middleware('can:superadmin.home');
Route::post('dosimetros', [DosimetrosController::class, 'save'])->name('dosimetros.save')->middleware('can:superadmin.home');
Route::get('dosimetros/{dosimetro}/edit', [DosimetrosController::class, 'edit'])->name('dosimetros.edit')->middleware('can:superadmin.home');
Route::put('dosimetros/{dosimetro}', [DosimetrosController::class, 'update'])->name('dosimetros.update')->middleware('can:superadmin.home');
Route::delete('dosimetros/{dosimetro}', [DosimetrosController::class, 'destroy'])->name('dosimetros.destroy')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE DOSIMETROS///////PERMISO ADMIN/////
Route::get('dosimetros/search', [DosimetrosController::class, 'search'])->name('dosimetros.search')->middleware('can:admin.home');
Route::get('dosimetros/create', [DosimetrosController::class, 'create'])->name('dosimetros.create')->middleware('can:admin.home');
Route::post('dosimetros', [DosimetrosController::class, 'save'])->name('dosimetros.save')->middleware('can:admin.home');
Route::get('dosimetros/{dosimetro}/edit', [DosimetrosController::class, 'edit'])->name('dosimetros.edit')->middleware('can:admin.home');
Route::put('dosimetros/{dosimetro}', [DosimetrosController::class, 'update'])->name('dosimetros.update')->middleware('can:admin.home');
/* Route::delete('dosimetros/{dosimetro}', [DosimetrosController::class, 'destroy'])->name('dosimetros.destroy'); */

/////////RUTAS PARA EL CRUD DE HOLDERS///////PERMISO SUPERADMIN//////
Route::get('holders/search', [HolderController::class, 'search'])->name('holders.search')->middleware('can:superadmin.home');
Route::get('holders/create', [HolderController::class, 'create'])->name('holders.create')->middleware('can:superadmin.home');
Route::post('holders', [HolderController::class, 'save'])->name('holders.save')->middleware('can:superadmin.home');
Route::get('holders/{holder}/edit', [HolderController::class, 'edit'])->name('holders.edit')->middleware('can:superadmin.home');
Route::put('holders/{holder}', [HolderController::class, 'update'])->name('holders.update')->middleware('can:superadmin.home');
Route::delete('holders/{holder}', [HolderController::class, 'destroy'])->name('holders.destroy')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE HOLDERS///////PERMISO ADMIN////
Route::get('holders/search', [HolderController::class, 'search'])->name('holders.search')->middleware('can:admin.home');
Route::get('holders/create', [HolderController::class, 'create'])->name('holders.create')->middleware('can:admin.home');
Route::post('holders', [HolderController::class, 'save'])->name('holders.save')->middleware('can:admin.home');
Route::get('holders/{holder}/edit', [HolderController::class, 'edit'])->name('holders.edit')->middleware('can:admin.home');
Route::put('holders/{holder}', [HolderController::class, 'update'])->name('holders.update')->middleware('can:admin.home');
/* Route::delete('holders/{holder}', [HolderController::class, 'destroy'])->name('holders.destroy'); */

/////////RUTAS PARA DOSIMETRIA///////PERMISO SUPERADMIN////
Route::get('empresasdosicreate', [DosimetriaController::class, 'createEmpresa'])->name('empresasdosi.create')->middleware('can:superadmin.home');
Route::post('empresasdosi', [DosimetriaController::class, 'saveEmpresa'])->name('empresasdosi.save')->middleware('can:superadmin.home');
Route::get('contratosdosicreate/{empresadosi}/create', [DosimetriaController::class, 'createContrato'])->name('contratosdosi.create')->middleware('can:superadmin.home');
Route::get('contratodosisedecreate/{contratodosi}/create', [DosimetriaController::class, 'createSedeContrato'])->name('contratosdosisede.create')->middleware('can:superadmin.home');
Route::get('/contratosdosicreatelist/{contratodosi}/createlist/contratodosidepa',[DosimetriaController::class,'selectdepa'])->middleware('can:superadmin.home');
Route::get('contratosdosicreatelist/{empresadosi}/createlist', [DosimetriaController::class, 'createlistContrato'])->name('contratosdosi.createlist')->middleware('can:superadmin.home');
Route::get('contratosdosicreatelist/{empresadosi}/createlist/create', [DosimetriaController::class, 'createContratodosi'])->name('contratosdosi.create')->middleware('can:superadmin.home');
Route::post('contratosdosi', [DosimetriaController::class, 'saveContratodosi'])->name('contratosdosi.save')->middleware('can:superadmin.home');
Route::get('contratodosimetria/{contdosi}/pdf', [DosimetriaController::class, 'pdfContratoDosimetria'])->name('contratodosimetria.pdf')->middleware('can:superadmin.home');
Route::get('contratosdosicreatelist/{empresadosi}/{contratodosi}/edit', [DosimetriaController::class, 'editContratodosi'])->name('contratosdosi.edit')->middleware('can:superadmin.home');
Route::put('contratosdosicreatelist/{contratodosi}/update', [DosimetriaController::class, 'updateContratodosi'])->name('contratosdosi.update')->middleware('can:superadmin.home');
Route::delete('contratosdosicreatelist/{empresadosi}/{contratodosi}/destroy', [DosimetriaController::class, 'destroyContratodosi'])->name('contratosdosi.destroy')->middleware('can:superadmin.home');
Route::put('contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/update', [DosimetriaController::class, 'updateContsedepto'])->name('contratosdosisededepto.update')->middleware('can:superadmin.home');
Route::get('/contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/contratodosidepa',[DosimetriaController::class,'selectdepa'])->middleware('can:superadmin.home');
Route::get('detallecontrato/{detcont}/create', [DosimetriaController::class, 'createdetalleContrato'])->name('detallecontrato.create')->middleware('can:superadmin.home');
Route::delete('detallecontrato/{detcont}/{contratodosisede}/{contratodosisededepto}/destroy', [DosimetriaController::class, 'destroyContdosisedepto'])->name('contratosdosisededepto.destroy')->middleware('can:superadmin.home');
Route::get('detallesedecont/{detsedcont}/create',[DosimetriaController::class, 'createdetsedeContrato'])->name('detallesedecont.create')->middleware('can:superadmin.home');
/////Ruta para entrar al detalle de la subEspecialidad de una novedad /////
Route::get('detallesedecontsubesp/{novcontdepto}/create',[DosimetriaController::class, 'createdetsedeSubEspCont'])->name('detallesedecontsubEsp.create')->middleware('can:superadmin.home');
/////////RUTAS PARA DOSIMETRIA///////PERMISO ADMIN
Route::get('empresasdosicreate', [DosimetriaController::class, 'createEmpresa'])->name('empresasdosi.create')->middleware('can:admin.home');
Route::post('empresasdosi', [DosimetriaController::class, 'saveEmpresa'])->name('empresasdosi.save')->middleware('can:admin.home');
Route::get('contratosdosicreate/{empresadosi}/create', [DosimetriaController::class, 'createContrato'])->name('contratosdosi.create')->middleware('can:admin.home');
Route::get('contratodosisedecreate/{contratodosi}/create', [DosimetriaController::class, 'createSedeContrato'])->name('contratosdosisede.create')->middleware('can:admin.home');
Route::get('/contratosdosicreatelist/{contratodosi}/createlist/contratodosidepa',[DosimetriaController::class,'selectdepa'])->middleware('can:admin.home');
Route::get('contratosdosicreatelist/{empresadosi}/createlist', [DosimetriaController::class, 'createlistContrato'])->name('contratosdosi.createlist')->middleware('can:admin.home');
Route::get('contratosdosicreatelist/{empresadosi}/createlist/create', [DosimetriaController::class, 'createContratodosi'])->name('contratosdosi.create')->middleware('can:admin.home');
Route::post('contratosdosi', [DosimetriaController::class, 'saveContratodosi'])->name('contratosdosi.save')->middleware('can:admin.home');
Route::get('contratodosimetria/{contdosi}/pdf', [DosimetriaController::class, 'pdfContratoDosimetria'])->name('contratodosimetria.pdf')->middleware('can:admin.home');
Route::get('contratosdosicreatelist/{empresadosi}/{contratodosi}/edit', [DosimetriaController::class, 'editContratodosi'])->name('contratosdosi.edit')->middleware('can:admin.home');
Route::put('contratosdosicreatelist/{contratodosi}/update', [DosimetriaController::class, 'updateContratodosi'])->name('contratosdosi.update')->middleware('can:admin.home');
/* Route::delete('contratosdosicreatelist/{empresadosi}/{contratodosi}/destroy', [DosimetriaController::class, 'destroyContratodosi'])->name('contratosdosi.destroy'); */
Route::put('contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/update', [DosimetriaController::class, 'updateContsedepto'])->name('contratosdosisededepto.update')->middleware('can:admin.home');
Route::get('/contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/contratodosidepa',[DosimetriaController::class,'selectdepa'])->middleware('can:admin.home');
Route::get('detallecontrato/{detcont}/create', [DosimetriaController::class, 'createdetalleContrato'])->name('detallecontrato.create')->middleware('can:admin.home');
/* Route::delete('detallecontrato/{detcont}/{contratodosisede}/{contratodosisededepto}/destroy', [DosimetriaController::class, 'destroyContdosisedepto'])->name('contratosdosisededepto.destroy'); */
Route::get('detallesedecont/{detsedcont}/create',[DosimetriaController::class, 'createdetsedeContrato'])->name('detallesedecont.create')->middleware('can:admin.home');
/////Ruta para entrar al detalle de la subEspecialidad de una novedad /////
Route::get('detallesedecontsubesp/{novcontdepto}/create',[DosimetriaController::class, 'createdetsedeSubEspCont'])->name('detallesedecontsubEsp.create')->middleware('can:admin.home');


/////////RUTAS PARA EL CRUD DE ASIGNACION DOSIMETROS///////PERMISO SUPERADMIN////
Route::get('asignadosicontratom1/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoM1'])->name('asignadosicontratom1.create')->middleware('can:superadmin.home');
Route::post('asignadosicontratom1/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoM1'])->name('asignadosicontratom1.save')->middleware('can:superadmin.home');
Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoMn'])->name('asignadosicontratomn.create')->middleware('can:superadmin.home');
Route::post('asignadosicontratomn/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoMn'])->name('asignadosicontratomn.save')->middleware('can:superadmin.home');
Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/clear', [DosimetriaController::class, 'clearAsignacionAnteriorMn'])->name('asignadosicontratomn.clear')->middleware('can:superadmin.home');
Route::get('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/create',[DosimetriaController::class, 'asignaDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.create')->middleware('can:superadmin.home');
Route::post('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/',[DosimetriaController::class, 'saveAsignacionDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.save')->middleware('can:superadmin.home');
/////////////
Route::get('asignadosicontrato/{asigdosicont}/{mesnumber}/{item}/info', [DosimetriaController::class, 'info'])->name('asignadosicontrato.info')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE ASIGNACION DOSIMETROS///////PERMISO ADMIN////
Route::get('asignadosicontratom1/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoM1'])->name('asignadosicontratom1.create')->middleware('can:admin.home');
Route::post('asignadosicontratom1/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoM1'])->name('asignadosicontratom1.save')->middleware('can:admin.home');
Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoMn'])->name('asignadosicontratomn.create')->middleware('can:admin.home');
Route::post('asignadosicontratomn/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoMn'])->name('asignadosicontratomn.save')->middleware('can:admin.home');
Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/clear', [DosimetriaController::class, 'clearAsignacionAnteriorMn'])->name('asignadosicontratomn.clear')->middleware('can:admin.home');
Route::get('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/create',[DosimetriaController::class, 'asignaDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.create')->middleware('can:admin.home');
Route::post('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/',[DosimetriaController::class, 'saveAsignacionDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.save')->middleware('can:admin.home');
/////////////
Route::get('asignadosicontrato/{asigdosicont}/{mesnumber}/{item}/info', [DosimetriaController::class, 'info'])->name('asignadosicontrato.info')->middleware('can:admin.home');

///////////----------RUTA PARA ELIMINAR ASIGNACIONES DE DOSIMETROS-----//////////PERMISO SUPERADMIN/////////
Route::put('asignadosicontrato/{id}/{mesnumber}/{item}/update', [DosimetriaController::class, 'updateFechasAsigContrato'])->name('asignadosicontrato.updatefechas')->middleware('can:superadmin.home');
Route::delete('asignadosicontrato/{id}/destroycontrol', [DosimetriaController::class, 'destroyControlasig'])->name('asigdosicont.destroyInfoControl')->middleware('can:superadmin.home');
Route::delete('asignadosicontrato/{id}/destroytrabajador', [DosimetriaController::class, 'destroyTrabajadorasig'])->name('asigdosicont.destroyInfoTrabajador')->middleware('can:superadmin.home');
Route::delete('asignadosicontrato/{id}/destroyArea',[DosimetriaController::class, 'destroyAreasig'])->name('asigdosicont.destroyInfoArea')->middleware('can:superadmin.home');
///////////----------RUTA PARA ELIMINAR ASIGNACIONES DE DOSIMETROS-----/////////PERMISO ADMIN//////////
Route::put('asignadosicontrato/{id}/{mesnumber}/{item}/update', [DosimetriaController::class, 'updateFechasAsigContrato'])->name('asignadosicontrato.updatefechas')->middleware('can:admin.home');
/* Route::delete('asignadosicontrato/{id}/destroycontrol', [DosimetriaController::class, 'destroyControlasig'])->name('asigdosicont.destroyInfoControl');
Route::delete('asignadosicontrato/{id}/destroytrabajador', [DosimetriaController::class, 'destroyTrabajadorasig'])->name('asigdosicont.destroyInfoTrabajador');
Route::delete('asignadosicontrato/{id}/destroyArea',[DosimetriaController::class, 'destroyAreasig'])->name('asigdosicont.destroyInfoArea'); */

///////////----------RUTA PARA AÑADIR OBSERVACIONES DEL MES SOBRE LAS ASIGNACIONES DE DOSIMETROS -----///////////PERMISO SUPERADMIN////////
Route::post('asignadosicontrato/saveObservacionMesAsigdosim', [DosimetriaController::class, 'saveObservacionMesAsigdosim'])->name('asigdosicont.saveObservacionMesAsigdosim')->middleware('can:superadmin.home');
///////////----------RUTA PARA AÑADIR OBSERVACIONES DEL MES SOBRE LAS ASIGNACIONES DE DOSIMETROS -----////////PERMISO ADMIN///////////
Route::post('asignadosicontrato/saveObservacionMesAsigdosim', [DosimetriaController::class, 'saveObservacionMesAsigdosim'])->name('asigdosicont.saveObservacionMesAsigdosim')->middleware('can:admin.home');

/////////RUTAS PARA EL CRUD DE LA LECTURA DE DOSIMETROS///////PERMISO SUPERADMIN///
Route::get('lecturadosi/{lecdosi}/{item}/create', [DosimetriaController::class, 'lecturadosi'])->name('lecturadosi.create')->middleware('can:superadmin.home');
Route::get('lecturadosi/{lecdosi}/{lecdosicontrol}/{item}/create', [DosimetriaController::class, 'lecturadosicontrl'])->name('lecturadosicontrl.create')->middleware('can:superadmin.home');
Route::put('lecturadosi/{lecdosi}/{item}', [DosimetriaController::class, 'savelecturadosi'])->name('lecturadosi.save')->middleware('can:superadmin.home');
Route::get('lecturadosi/{lecdosicont}/{item}/edit', [DosimetriaController::class, 'editlecturadosi'])->name('lecturadosi.edit')->middleware('can:superadmin.home');
Route::get('lecturadosi/{lecdosi}/{lecdosicontrol}/{item}/edit', [DosimetriaController::class, 'editlecturadosicontrl'])->name('lecturadosicontrl.edit')->middleware('can:superadmin.home');
Route::get('lecturadosi/{lecdosi}/getextraviado',[DosimetriaController::class,'getextraviado'])->middleware('can:superadmin.home');
Route::get('lecturadosicontrol/{lecdosicont}/{contdosisededepto}/{item}/create', [DosimetriaController::class, 'lecturadosicontrol'])->name('lecturadosicontrol.create')->middleware('can:superadmin.home');
Route::put('lecturadosicontrol/{lecdosicont}/{item}', [DosimetriaController::class, 'savelecturadosicontrol'])->name('lecturadosicontrol.save')->middleware('can:superadmin.home');
Route::get('lecturadosicontrol/{lecdosicont}/{contdosisededepto}/{item}/edit', [DosimetriaController::class, 'editlecturadosicontrol'])->name('lecturadosicontrol.edit')->middleware('can:superadmin.home');
Route::get('lecturadosiarea/{lecdosicont}/{item}/create', [DosimetriaController::class, 'lecturadosiarea'])->name('lecturadosiarea.create')->middleware('can:superadmin.home');
Route::get('lecturadosiarea/{lecdosicont}/{lecdosicontrol}/{item}/create', [DosimetriaController::class, 'lecturadosiareacontrl'])->name('lecturadosiareacontrl.create')->middleware('can:superadmin.home');
Route::put('lecturadosiarea/{lecdosicont}/{item}', [DosimetriaController::class, 'savelecturadosiarea'])->name('lecturadosiarea.save')->middleware('can:superadmin.home');
Route::get('lecturadosiarea/{lecdosicont}/{item}/edit', [DosimetriaController::class, 'editlecturadosiarea'])->name('lecturadosiarea.edit')->middleware('can:superadmin.home');
Route::get('lecturadosiarea/{lecdosicont}/{lecdosicontrol}/{item}/edit', [DosimetriaController::class, 'editlecturadosiareacontrl'])->name('lecturadosiareacontrl.edit')->middleware('can:superadmin.home');
/////////RUTAS PARA EL CRUD DE LA LECTURA DE DOSIMETROS///////PERMISO ADMIN/////
Route::get('lecturadosi/{lecdosi}/{item}/create', [DosimetriaController::class, 'lecturadosi'])->name('lecturadosi.create')->middleware('can:admin.home');
Route::get('lecturadosi/{lecdosi}/{lecdosicontrol}/{item}/create', [DosimetriaController::class, 'lecturadosicontrl'])->name('lecturadosicontrl.create')->middleware('can:admin.home');
Route::put('lecturadosi/{lecdosi}/{item}', [DosimetriaController::class, 'savelecturadosi'])->name('lecturadosi.save')->middleware('can:admin.home');
Route::get('lecturadosi/{lecdosicont}/{item}/edit', [DosimetriaController::class, 'editlecturadosi'])->name('lecturadosi.edit')->middleware('can:admin.home');
Route::get('lecturadosi/{lecdosi}/{lecdosicontrol}/{item}/edit', [DosimetriaController::class, 'editlecturadosicontrl'])->name('lecturadosicontrl.edit')->middleware('can:admin.home');
Route::get('lecturadosi/{lecdosi}/getextraviado',[DosimetriaController::class,'getextraviado'])->middleware('can:admin.home');
Route::get('lecturadosicontrol/{lecdosicont}/{contdosisededepto}/{item}/create', [DosimetriaController::class, 'lecturadosicontrol'])->name('lecturadosicontrol.create')->middleware('can:admin.home');
Route::put('lecturadosicontrol/{lecdosicont}/{item}', [DosimetriaController::class, 'savelecturadosicontrol'])->name('lecturadosicontrol.save')->middleware('can:admin.home');
Route::get('lecturadosicontrol/{lecdosicont}/{contdosisededepto}/{item}/edit', [DosimetriaController::class, 'editlecturadosicontrol'])->name('lecturadosicontrol.edit')->middleware('can:admin.home');
Route::get('lecturadosiarea/{lecdosicont}/{item}/create', [DosimetriaController::class, 'lecturadosiarea'])->name('lecturadosiarea.create')->middleware('can:admin.home');
Route::get('lecturadosiarea/{lecdosicont}/{lecdosicontrol}/{item}/create', [DosimetriaController::class, 'lecturadosiareacontrl'])->name('lecturadosiareacontrl.create')->middleware('can:admin.home');
Route::put('lecturadosiarea/{lecdosicont}/{item}', [DosimetriaController::class, 'savelecturadosiarea'])->name('lecturadosiarea.save')->middleware('can:admin.home');
Route::get('lecturadosiarea/{lecdosicont}/{item}/edit', [DosimetriaController::class, 'editlecturadosiarea'])->name('lecturadosiarea.edit')->middleware('can:admin.home');
Route::get('lecturadosiarea/{lecdosicont}/{lecdosicontrol}/{item}/edit', [DosimetriaController::class, 'editlecturadosiareacontrl'])->name('lecturadosiareacontrl.edit')->middleware('can:admin.home');

/////////RUTAS PARA LOS REPORTES O INFORMES DE DOSIMETRIA///////PERMISO SUPERADMIN/////
Route::get('repodosimetria/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdf'])->name('repodosimetria.pdf')->middleware('can:superadmin.home');
/////////RUTAS PARA LOS REPORTES O INFORMES DE DOSIMETRIA///////PERMISO ADMIN/////
Route::get('repodosimetria/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdf'])->name('repodosimetria.pdf')->middleware('can:admin.home');
/////////RUTAS PARA LOS REPORTES O INFORMES DE DOSIMETRIA///////PERMISO LIDER DE DOSIMETRIA/////
Route::get('repodosimetria/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdf'])->name('repodosimetria.pdf')->middleware('can:liderdosim.home');

/////////RUTAS PARA LAS ETIQUETAS DE DOSIMETRIA ///////PERMISO SUPERADMIN/////
Route::get('etiquetasdosimetria/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfEtiquetas'])->name('etiquetasdosimetria.pdf')->middleware('can:superadmin.home');
/////////RUTAS PARA LAS ETIQUETAS DE DOSIMETRIA ///////PERMISO ADMIN/////
Route::get('etiquetasdosimetria/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfEtiquetas'])->name('etiquetasdosimetria.pdf')->middleware('can:admin.home');

////////////RUTAS PARA LA REVISION SALIDA DE DOSIMETROS ASIGNADOS/////////PERMISO SUPERADMIN/////
Route::get('revisiondosimetria/{deptodosi}/{mesnumber}/{item}/revision', [DosimetriaController::class, 'revisionDosimetria'])->name('revisiondosimetria.check')->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetro',[DosimetriaController::class, 'revisionDosimetro'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/trabajadordosimetro',[DosimetriaController::class, 'revisionCheck'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetroControl',[DosimetriaController::class, 'revisionCheckControl'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetroAmbiental',[DosimetriaController::class, 'revisionCheckAmbiental'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesTrab', [DosimetriaController::class, 'asignacionesTrab'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesCont', [DosimetriaController::class, 'asignacionesCont'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesContUnic', [DosimetriaController::class, 'asignacionesContUnic'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesArea', [DosimetriaController::class, 'asignacionesArea'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/trabjencargado', [DosimetriaController::class, 'trabjencargado'])->middleware('can:superadmin.home');
Route::get('revisiondosimetria/create', [DosimetriaController::class, 'revisionDosimetriaGeneral'])->name('revisiondosimetria.create')->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/asignaciones', [DosimetriaController::class, 'asignaciones'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/trabajdosimetro',[DosimetriaController::class, 'revisionCheckGeneral'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/asignacionesControl', [DosimetriaController::class, 'asignacionesControl'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetria/eliminarevisado', [DosimetriaController::class, 'eliminarevision'])->middleware('can:superadmin.home');
Route::get('/reporteRevisionSalida/{empresa}/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfReporteRevisionSalida'])->name('Reporterevisionsalida.pdf')->middleware('can:superadmin.home');
////////////RUTAS PARA LA REVISION SALIDA DE DOSIMETROS ASIGNADOS/////////PERMISO ADMIN/////
Route::get('revisiondosimetria/{deptodosi}/{mesnumber}/{item}/revision', [DosimetriaController::class, 'revisionDosimetria'])->name('revisiondosimetria.check')->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetro',[DosimetriaController::class, 'revisionDosimetro'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/trabajadordosimetro',[DosimetriaController::class, 'revisionCheck'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetroControl',[DosimetriaController::class, 'revisionCheckControl'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/dosimetroAmbiental',[DosimetriaController::class, 'revisionCheckAmbiental'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesTrab', [DosimetriaController::class, 'asignacionesTrab'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesCont', [DosimetriaController::class, 'asignacionesCont'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesContUnic', [DosimetriaController::class, 'asignacionesContUnic'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/asignacionesArea', [DosimetriaController::class, 'asignacionesArea'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/{item}/trabjencargado', [DosimetriaController::class, 'trabjencargado'])->middleware('can:admin.home');
Route::get('revisiondosimetria/create', [DosimetriaController::class, 'revisionDosimetriaGeneral'])->name('revisiondosimetria.create')->middleware('can:admin.home');
Route::get('/revisiondosimetria/asignaciones', [DosimetriaController::class, 'asignaciones'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/trabajdosimetro',[DosimetriaController::class, 'revisionCheckGeneral'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/asignacionesControl', [DosimetriaController::class, 'asignacionesControl'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral'])->middleware('can:admin.home');
Route::get('/revisiondosimetria/eliminarevisado', [DosimetriaController::class, 'eliminarevision'])->middleware('can:admin.home');
Route::get('/reporteRevisionSalida/{empresa}/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfReporteRevisionSalida'])->name('Reporterevisionsalida.pdf')->middleware('can:admin.home');

////////////RUTAS PARA LA REVISION ENTRADA DE DOSIMETROS ASIGNADOS/////////PERMISO SUPERADMIN////////
Route::get('revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/revisionEntrada', [DosimetriaController::class, 'revisionDosimetriaEntrada'])->name('revisiondosimetriaEntrada.check')->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/dosimetroControlEntrada',[DosimetriaController::class, 'revisionCheckControlEntrada'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/trabajadordosimetroEntrada',[DosimetriaController::class, 'revisionCheckEntrada'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/ambientaldosimetroEntrada',[DosimetriaController::class, 'revisionEntradaCheckAmbiental'])->middleware('can:superadmin.home');
Route::post('/revisiondosimetriaentrada', [DosimetriaController::class, 'saveObservacionesReventrada'])->name('observacionesReventrada.save')->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesTrab', [DosimetriaController::class, 'asignacionesTrab'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesCont', [DosimetriaController::class, 'asignacionesCont'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesArea', [DosimetriaController::class, 'asignacionesArea'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/trabjencargado', [DosimetriaController::class, 'trabjencargado'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/observacionesreventrada', [DosimetriaController::class, 'observacionesreventrada'])->middleware('can:superadmin.home');
Route::post('/revisiondosimetriaentrada/observacionesremove', [DosimetriaController::class, 'observacionesremove'])->name('observaciones.remove')->middleware('can:superadmin.home');
Route::get('revisiondosimetriaentrada/create', [DosimetriaController::class, 'revisionDosimetriaEntradaGeneral'])->name('revisiondosimetriaentrada.create')->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/asignaciones', [DosimetriaController::class, 'asignacionesEntrada'])->middleware('can:superadmin.home');
Route::get('/revisiondosimetriaentrada/asignacionesControl', [DosimetriaController::class, 'asignacionesControlEntrada'])->middleware('can:superadmin.home');
Route::post('revisiondosimetriaentrada/observacionCreate', [DosimetriaController::class, 'nuevaObservacionreventrada'])->name('nuevaobservacionreventrada.create')->middleware('can:superadmin.home');
Route::get('/reporteRevisionEntrada/{empresa}/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfReporteRevisionEntrada'])->name('Reporterevisionentrada.pdf')->middleware('can:superadmin.home');
////////////RUTAS PARA LA REVISION ENTRADA DE DOSIMETROS ASIGNADOS/////////PERMISO ADMIN////////
Route::get('revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/revisionEntrada', [DosimetriaController::class, 'revisionDosimetriaEntrada'])->name('revisiondosimetriaEntrada.check')->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/dosimetroControlEntrada',[DosimetriaController::class, 'revisionCheckControlEntrada'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/trabajadordosimetroEntrada',[DosimetriaController::class, 'revisionCheckEntrada'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/ambientaldosimetroEntrada',[DosimetriaController::class, 'revisionEntradaCheckAmbiental'])->middleware('can:admin.home');
Route::post('/revisiondosimetriaentrada', [DosimetriaController::class, 'saveObservacionesReventrada'])->name('observacionesReventrada.save')->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesTrab', [DosimetriaController::class, 'asignacionesTrab'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesCont', [DosimetriaController::class, 'asignacionesCont'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/asignacionesArea', [DosimetriaController::class, 'asignacionesArea'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/trabjencargado', [DosimetriaController::class, 'trabjencargado'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/{item}/observacionesreventrada', [DosimetriaController::class, 'observacionesreventrada'])->middleware('can:admin.home');
Route::post('/revisiondosimetriaentrada/observacionesremove', [DosimetriaController::class, 'observacionesremove'])->name('observaciones.remove')->middleware('can:admin.home');
Route::get('revisiondosimetriaentrada/create', [DosimetriaController::class, 'revisionDosimetriaEntradaGeneral'])->name('revisiondosimetriaentrada.create')->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/dosimetro', [DosimetriaController::class, 'revisionDosimetro'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/asignaciones', [DosimetriaController::class, 'asignacionesEntrada'])->middleware('can:admin.home');
Route::get('/revisiondosimetriaentrada/asignacionesControl', [DosimetriaController::class, 'asignacionesControlEntrada'])->middleware('can:admin.home');
Route::post('revisiondosimetriaentrada/observacionCreate', [DosimetriaController::class, 'nuevaObservacionreventrada'])->name('nuevaobservacionreventrada.create')->middleware('can:admin.home');
Route::get('/reporteRevisionEntrada/{empresa}/{deptodosi}/{mesnumber}/{item}/pdf', [DosimetriaController::class, 'pdfReporteRevisionEntrada'])->name('Reporterevisionentrada.pdf')->middleware('can:admin.home');

////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (ANTIGUAS)///////PERMISO SUPER ADMIN///////
Route::get('novedades/create', [NovedadesController::class, 'index'])->name('novedadesdosim.create')->middleware('can:superadmin.home');
Route::get('/novedades/contratoDosim', [NovedadesController::class, 'contratoDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/sedescontDosi', [NovedadesController::class, 'sedescontDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/especialidadescontDosi', [NovedadesController::class, 'especialidadescontDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/contdosisededepto/', [NovedadesController::class, 'contratodosi'])->middleware('can:superadmin.home');
Route::get('/novedades/mesescontdosisededepto/', [NovedadesController::class, 'mesescontDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/mesactualcontdosisededepto/', [NovedadesController::class, 'mesactualcontDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/novedadactualcontdosisededepto/', [NovedadesController::class, 'novedadactualDosimetria'])->middleware('can:superadmin.home');
Route::get('/novedades/dosiasginadosmesactual/', [NovedadesController::class, 'dosiasginadosmesactual'])->middleware('can:superadmin.home');
Route::get('/novedades/dosiasginadoscontrolmesactual/', [NovedadesController::class, 'dosiasginadoscontrolmesactual'])->middleware('can:superadmin.home');
Route::get('/novedades/dosiareasginadosmesactual', [NovedadesController::class, 'dosiareasginadosmesactual'])->middleware('can:superadmin.home');
Route::get('/novedades/trabajadoresempresa/', [NovedadesController::class, 'trabajadoresempresa'])->middleware('can:superadmin.home');
Route::get('/novedades/areasespecialidadesempresa/', [NovedadesController::class, 'areasespecialidadesempresa'])->middleware('can:superadmin.home');
Route::get('/novedades/dosimetros/', [NovedadesController::class, 'dosimetrosdisponibles'])->middleware('can:superadmin.home');
Route::post('novedades/novedadesmesact', [NovedadesController::class, 'savecambiocantdosim'])->name('cambiocantdosim.save')->middleware('can:superadmin.home');
Route::post('novedades/novedadesmesig', [NovedadesController::class, 'savemesiguientecambiocantdosim'])->name('cambiocantdosimesig.save')->middleware('can:superadmin.home');
Route::post('novedades/novedadesmesactcambiotrab', [NovedadesController::class, 'savecambiotrabajadordosim'])->name('cambiotrabajadordosim.save')->middleware('can:superadmin.home');
Route::get('novedades/limpiar/', [NovedadesController::class, 'clearAsignacionAnteriorMn'])->middleware('can:superadmin.home');
Route::get('novedades/meseschangecontratoDosi', [NovedadesController::class, 'meseschangecontratoDosi'])->middleware('can:superadmin.home');
////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (ANTIGUAS)///////PERMISO SUPER ADMIN///////
Route::get('novedades/create', [NovedadesController::class, 'index'])->name('novedadesdosim.create')->middleware('can:admin.home');
Route::get('/novedades/contratoDosim', [NovedadesController::class, 'contratoDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/sedescontDosi', [NovedadesController::class, 'sedescontDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/especialidadescontDosi', [NovedadesController::class, 'especialidadescontDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/contdosisededepto/', [NovedadesController::class, 'contratodosi'])->middleware('can:admin.home');
Route::get('/novedades/mesescontdosisededepto/', [NovedadesController::class, 'mesescontDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/mesactualcontdosisededepto/', [NovedadesController::class, 'mesactualcontDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/novedadactualcontdosisededepto/', [NovedadesController::class, 'novedadactualDosimetria'])->middleware('can:admin.home');
Route::get('/novedades/dosiasginadosmesactual/', [NovedadesController::class, 'dosiasginadosmesactual'])->middleware('can:admin.home');
Route::get('/novedades/dosiasginadoscontrolmesactual/', [NovedadesController::class, 'dosiasginadoscontrolmesactual'])->middleware('can:admin.home');
Route::get('/novedades/dosiareasginadosmesactual', [NovedadesController::class, 'dosiareasginadosmesactual'])->middleware('can:admin.home');
Route::get('/novedades/trabajadoresempresa/', [NovedadesController::class, 'trabajadoresempresa'])->middleware('can:admin.home');
Route::get('/novedades/areasespecialidadesempresa/', [NovedadesController::class, 'areasespecialidadesempresa'])->middleware('can:admin.home');
Route::get('/novedades/dosimetros/', [NovedadesController::class, 'dosimetrosdisponibles'])->middleware('can:admin.home');
Route::post('novedades/novedadesmesact', [NovedadesController::class, 'savecambiocantdosim'])->name('cambiocantdosim.save')->middleware('can:admin.home');
Route::post('novedades/novedadesmesig', [NovedadesController::class, 'savemesiguientecambiocantdosim'])->name('cambiocantdosimesig.save')->middleware('can:admin.home');
Route::post('novedades/novedadesmesactcambiotrab', [NovedadesController::class, 'savecambiotrabajadordosim'])->name('cambiotrabajadordosim.save')->middleware('can:admin.home');
Route::get('novedades/limpiar/', [NovedadesController::class, 'clearAsignacionAnteriorMn'])->middleware('can:admin.home');
Route::get('novedades/meseschangecontratoDosi', [NovedadesController::class, 'meseschangecontratoDosi'])->middleware('can:admin.home');

////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (NUEVAS) //////////////PERMISO SUPER ADMIN//////////
Route::get('novedades/search', [NovedadesController::class, 'search'])->name('novedadesdosimetria.search')->middleware('can:superadmin.home');
Route::get('/novedades/contratosDosim', [NovedadesController::class, 'contratosDosim'])->middleware('can:superadmin.home');
Route::get('/novedades/sedesEspcontDosi', [NovedadesController::class, 'sedesEspcontDosim'])->middleware('can:superadmin.home');
Route::get('/novedades/sedesNovEspcontDosi', [NovedadesController::class, 'sedesNovEspcontDosim'])->middleware('can:superadmin.home');
Route::get('/novedades/novedadesContDosim', [NovedadesController::class, 'novedadesContDosim'])->middleware('can:superadmin.home');
Route::get('/novedades/novedadesSubEspContDosim', [NovedadesController::class, 'novedadesSubEspContDosim'])->middleware('can:superadmin.home');
Route::get('/novedades/cambiosnovedadesContDosim', [NovedadesController::class, 'cambiosnovedadesContDosim'])->middleware('can:superadmin.home');
//////////////(se usaron las rutas para encontrar los contratos las sedes y las especialidades y el mes actual y las asignaciones de una empresa de dosimetria)/////////
Route::get('novedades/crear', [NovedadesController::class, 'create'])->name('novedadesdosimetria.create')->middleware('can:superadmin.home');
Route::get('novedades/nuevoDosimetro', [NovedadesController::class, 'nuevoDosimetro'])->name('novedadesdosimetria.nuevoDosimetro')->middleware('can:superadmin.home');
Route::get('novedades/retiroDosimetro', [NovedadesController::class,  'retiroDosimetro'])->name('novedadesdosimetria.retiroDosimetro')->middleware('can:superadmin.home');
Route::get('novedades/cambioTrabajador', [NovedadesController::class,  'cambioTrabajador'])->name('novedadesdosimetria.cambioTrabajador')->middleware('can:superadmin.home');
Route::get('novedades/{id}/{item}/detalleNovedad', [NovedadesController::class, 'detalleNovedad'])->name('novedadesdosimetria.detalleNovedad')->middleware('can:superadmin.home');
///////item 0 para historico de novedades y item 1 para reporte particular///////
Route::get('/reporteNov/{novedad}/{contrato}/{item}/pdf', [NovedadesController::class, 'reportePDFnovedad'])->name('reporteNovedad.pdf')->middleware('can:superadmin.home');
////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (NUEVAS) //////////////PERMISO ADMIN//////////
Route::get('novedades/search', [NovedadesController::class, 'search'])->name('novedadesdosimetria.search')->middleware('can:admin.home');
Route::get('/novedades/contratosDosim', [NovedadesController::class, 'contratosDosim'])->middleware('can:admin.home');
Route::get('/novedades/sedesEspcontDosi', [NovedadesController::class, 'sedesEspcontDosim'])->middleware('can:admin.home');
Route::get('/novedades/sedesNovEspcontDosi', [NovedadesController::class, 'sedesNovEspcontDosim'])->middleware('can:admin.home');
Route::get('/novedades/novedadesContDosim', [NovedadesController::class, 'novedadesContDosim'])->middleware('can:admin.home');
Route::get('/novedades/novedadesSubEspContDosim', [NovedadesController::class, 'novedadesSubEspContDosim'])->middleware('can:admin.home');
Route::get('/novedades/cambiosnovedadesContDosim', [NovedadesController::class, 'cambiosnovedadesContDosim'])->middleware('can:admin.home');
//////////////(se usaron las rutas para encontrar los contratos las sedes y las especialidades y el mes actual y las asignaciones de una empresa de dosimetria)/////////
Route::get('novedades/crear', [NovedadesController::class, 'create'])->name('novedadesdosimetria.create')->middleware('can:admin.home');
Route::get('novedades/nuevoDosimetro', [NovedadesController::class, 'nuevoDosimetro'])->name('novedadesdosimetria.nuevoDosimetro')->middleware('can:admin.home');
Route::get('novedades/retiroDosimetro', [NovedadesController::class,  'retiroDosimetro'])->name('novedadesdosimetria.retiroDosimetro')->middleware('can:admin.home');
Route::get('novedades/cambioTrabajador', [NovedadesController::class,  'cambioTrabajador'])->name('novedadesdosimetria.cambioTrabajador')->middleware('can:admin.home');
Route::get('novedades/{id}/{item}/detalleNovedad', [NovedadesController::class, 'detalleNovedad'])->name('novedadesdosimetria.detalleNovedad')->middleware('can:admin.home');
///////item 0 para historico de novedades y item 1 para reporte particular///////
Route::get('/reporteNov/{novedad}/{contrato}/{item}/pdf', [NovedadesController::class, 'reportePDFnovedad'])->name('reporteNovedad.pdf')->middleware('can:admin.home');

////////////RUTAS PARA LOS PRODUCTOS DE LAS COTIZACIONES //////////////PERMISO SUPERADMIN//////
Route::get('productos/search', [ProductoController::class, 'search'])->name('productos.search')->middleware('can:superadmin.home');
Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create')->middleware('can:superadmin.home');
Route::post('productos', [ProductoController::class, 'save'])->name('productos.save')->middleware('can:superadmin.home');
Route::get('productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('can:superadmin.home');
Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('can:superadmin.home');
Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('can:superadmin.home');
////////////RUTAS PARA LOS PRODUCTOS DE LAS COTIZACIONES //////////////PERMISO SUPERADMIN//////
Route::get('productos/search', [ProductoController::class, 'search'])->name('productos.search')->middleware('can:admin.home');
Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create')->middleware('can:admin.home');
Route::post('productos', [ProductoController::class, 'save'])->name('productos.save')->middleware('can:admin.home');
Route::get('productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('can:admin.home');
Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('can:admin.home');
/* Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy'); */

////////////RUTAS PARA  LAS COTIZACIONES /////////PERMISO SUPER ADMIN/////
Route::get('cotizaciones/search', [CotizacionController::class, 'search'])->name('cotizaciones.search')->middleware('can:superadmin.home');
Route::get('cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create')->middleware('can:superadmin.home');
Route::get('/cotizaciones/selectsedes', [CotizacionController::class, 'selectsedes'])->middleware('can:superadmin.home');
Route::get('/cotizaciones/{cotizacion}/selectsedes', [CotizacionController::class, 'selectsedes'])->middleware('can:superadmin.home');
Route::post('cotizaciones', [CotizacionController::class, 'save'])->name('cotizaciones.save')->middleware('can:superadmin.home');
Route::get('cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit')->middleware('can:superadmin.home');
Route::put('cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update')->middleware('can:superadmin.home');
Route::delete('cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy')->middleware('can:superadmin.home');
Route::get('cotizaciones/{cotizacion}/info', [CotizacionController::class, 'info'])->name('cotizaciones.info')->middleware('can:superadmin.home');
////////////RUTAS PARA  LAS COTIZACIONES /////////PERMISO ADMIN/////
Route::get('cotizaciones/search', [CotizacionController::class, 'search'])->name('cotizaciones.search')->middleware('can:admin.home');
Route::get('cotizaciones/create', [CotizacionController::class, 'create'])->name('cotizaciones.create')->middleware('can:admin.home');
Route::get('/cotizaciones/selectsedes', [CotizacionController::class, 'selectsedes'])->middleware('can:admin.home');
Route::get('/cotizaciones/{cotizacion}/selectsedes', [CotizacionController::class, 'selectsedes'])->middleware('can:admin.home');
Route::post('cotizaciones', [CotizacionController::class, 'save'])->name('cotizaciones.save')->middleware('can:admin.home');
Route::get('cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit')->middleware('can:admin.home');
Route::put('cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update')->middleware('can:admin.home');
/* Route::delete('cotizaciones/{cotizacion}', [CotizacionController::class, 'destroy'])->name('cotizaciones.destroy'); */
Route::get('cotizaciones/{cotizacion}/info', [CotizacionController::class, 'info'])->name('cotizaciones.info')->middleware('can:admin.home');

/////////////////RUTAS PERMITIDAS PARA EL ROL DE LIDER DE DOSIMETRIA//////////////////// 
Route::get('/dosimetria', [LiderdosimrolController::class, 'index'])->middleware('can:liderdosim.home')->name('liderdosim.home'); 
Route::get('/dosimetria/contratos', [LiderdosimrolController::class, 'contratos'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/sedes', [LiderdosimrolController::class, 'sedes'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/especialidades', [LiderdosimrolController::class, 'especialidades'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/especialidadesnovedad', [LiderdosimrolController::class, 'especialidadesnovedad'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/{array}/{depto}/detalledepto/', [LiderdosimrolController::class, 'dosisededeptocontraDetalle'])->middleware('can:liderdosim.home')->name('liderdosim.detalledepto'); 
Route::get('/dosimetria/{array}/{depto}/detallesubesp/', [LiderdosimrolController::class, 'dosisededeptocontDetalleSupEsp'])->middleware('can:liderdosim.home')->name('liderdosim.detalledepto'); 
Route::get('/dosimetria/{id}/detalletrabajador', [LiderdosimrolController::class, 'contratoTrabajadorDetalle'])->middleware('can:liderdosim.home')->name('liderdosim.detalletrabajador'); 
Route::get('/dosimetria/{id}/detalletrabajador/sedes', [LiderdosimrolController::class, 'sedes'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/{id}/detalletrabajador/especialidades', [LiderdosimrolController::class, 'especialidades'])->middleware('can:liderdosim.home'); 
Route::get('/dosimetria/{id}/detalletrabajador/especialidadesnovedad', [LiderdosimrolController::class, 'especialidadesnovedad'])->middleware('can:liderdosim.home'); 
Route::get('repodosimetriaParticular/{id}/{finiperiodo}/{contrato}/pdf', [LiderdosimrolController::class, 'reportedosiParticular'])->middleware('can:liderdosim.home')->name('repodosimetriaparticular.pdf');



