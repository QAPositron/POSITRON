<?php

use App\Http\Controllers\AreadepartamentosedeController;
use App\Http\Controllers\AsignarDosimetroController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DepartamentosedeController;
use App\Http\Controllers\DepartamentosedesController;
use App\Http\Controllers\DosimetriaController;
use App\Http\Controllers\DosimetrosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MesescontdosisedeptosController;
use App\Http\Controllers\NovedadesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\PerfilespersonasController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PersonasedesController;
use App\Http\Controllers\PersonasperfilesController;
use App\Http\Controllers\PersonasrolesController;
use App\Http\Controllers\RolesController;
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

/* Route::get('/',[PruebaController::class,'index1']); */
    //return view('welcome');

Route::get('/', [HomeController::class, 'login'])->name('login');
/*Route::get('home', [HomeController::class, 'index'])->name('home'); */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/////////RUTAS PARA EL CRUD DE EMPRESAS///////
Route::get('empresas/search', [EmpresasController::class, 'search'])->name('empresas.search');

Route::get('empresas/create', [EmpresasController::class, 'create'])->name('empresas.create');

Route::get('/empresas/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios']);
Route::get('/empresas/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios']);
Route::get('/sedes/{edit}/empresasdeptomuni', [EmpresasController::class, 'selectmunicipios']);

Route::post('empresas', [EmpresasController::class, 'save'])->name('empresas.save');
Route::get('empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit');
Route::put('empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update');
Route::delete('empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy');


Route::get('empresas/{empresa}/info', [EmpresasController::class, 'info'])->name('empresas.info');
Route::get('empresas/{empresa}/info#sede', [EmpresasController::class, 'info'])->name('empresas.infosede');

/////////RUTAS PARA EL CRUD DE SEDES///////

Route::get('sedes/{sede}/create', [SedesController::class, 'create'])->name('sedes.create');
Route::get('/sedes/{sede}/sedesdeptomuni', [SedesController::class, 'selectmunicipios']);

Route::post('sedes', [SedesController::class, 'save'])->name('sedes.save');
Route::post('departamentos', [DepartamentoController::class, 'save'])->name('departamento.save');

Route::get('sedes/{sede}/edit', [SedesController::class, 'edit'])->name('sedes.edit');
Route::put('sedes/{sede}', [SedesController::class, 'update'])->name('sedes.update');
Route::delete('sedes/{sede}', [SedesController::class, 'destroy'])->name('sedes.destroy');
Route::delete('empresas/{empresa}/{depto}/destroydepto', [DepartamentosedeController::class, 'destroydepa'])->name('sedesdepto.destroydepa');

/*------------RUTAS PARA EL CRUD DE LAS AREAS PARA LOS DEPARTAMENTOS-------------- */

Route::post('areadeptosave', [AreadepartamentosedeController::class, 'save'])->name('areadepto.save');
Route::put('areadeptoupdate/{area}', [AreadepartamentosedeController::class, 'update'])->name('areadepto.update');
Route::delete('areadeptodestroy/{area}', [AreadepartamentosedeController::class, 'destroy'])->name('areadepto.destroy');



/////////RUTAS PARA EL CRUD DE PERFILES/////
Route::post('perfiles', [PerfilesController::class, 'save'])->name('perfiles.save');


/////////RUTAS PARA EL CRUD DE ROLES/////
Route::post('roles', [RolesController::class, 'save'])->name('roles.save');

/////////RUTAS PARA EL CRUD DE PERSONAS//////
Route::get('personas/search', [PersonaController::class, 'search'])->name('personas.search');
Route::get('personas/create', [PersonaController::class, 'create'])->name('personas.create');
Route::get('personas/selectsedes', [PersonaController::class, 'selectsedes']);
Route::post('personas', [PersonaController::class, 'save'])->name('personas.save');
Route::get('personas/{empresa}/{trabestucont}/create',[PersonaController::class, 'createTrabEstuContEmp'])->name('personasEmpresa.create');
Route::post('personasEmpresa', [PersonaController::class, 'savePersonasEmpresa'])->name('personasEmpresa.save');
Route::get('personas/{persona}/{trabestucont}/{empresa}/edit', [PersonaController::class, 'edit'])->name('personas.edit');
Route::get('/personas/{persona}/{trabestucont}/{empresa}/selectsed', [PersonaController::class, 'selectsedes']);
Route::put('personas/{persona}', [PersonaController::class, 'update'])->name('personas.update');
Route::delete('personas/{persona}', [PersonaController::class, 'destroy'])->name('personas.destroy');

Route::delete('personasperfil/{personaperfil}', [PersonasperfilesController::class, 'destroy'])->name('personaperfil.destroy');
Route::delete('personasrol/{personarol}', [PersonasrolesController::class, 'destroy'])->name('personarol.destroy');
Route::delete('personasede/{personasede}', [PersonasedesController::class, 'destroy'])->name('personasede.destroy');
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

Route::get('contratosdosicreate/{empresadosi}/create', [DosimetriaController::class, 'createContrato'])->name('contratosdosi.create');

Route::get('contratodosisedecreate/{contratodosi}/create', [DosimetriaController::class, 'createSedeContrato'])->name('contratosdosisede.create');

Route::get('/contratosdosicreatelist/{contratodosi}/createlist/contratodosidepa',[DosimetriaController::class,'selectdepa']);

Route::get('contratosdosicreatelist/{empresadosi}/createlist', [DosimetriaController::class, 'createlistContrato'])->name('contratosdosi.createlist');
Route::get('contratosdosicreatelist/{empresadosi}/createlist/create', [DosimetriaController::class, 'createContratodosi'])->name('contratosdosi.create');
Route::post('contratosdosi', [DosimetriaController::class, 'saveContratodosi'])->name('contratosdosi.save');
Route::get('contratodosimetria/{contdosi}/pdf', [DosimetriaController::class, 'pdfContratoDosimetria'])->name('contratodosimetria.pdf');

Route::get('contratosdosicreatelist/{empresadosi}/{contratodosi}/edit', [DosimetriaController::class, 'editContratodosi'])->name('contratosdosi.edit');
Route::put('contratosdosicreatelist/{contratodosi}/update', [DosimetriaController::class, 'updateContratodosi'])->name('contratosdosi.update');
Route::delete('contratosdosicreatelist/{empresadosi}/{contratodosi}/destroy', [DosimetriaController::class, 'destroyContratodosi'])->name('contratosdosi.destroy');
Route::put('contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/update', [DosimetriaController::class, 'updateContsedepto'])->name('contratosdosisededepto.update');
Route::get('/contratosdosicreatelist/{contratodosisede}/{contratodosisededepto}/contratodosidepa',[DosimetriaController::class,'selectdepa']);

Route::get('detallecontrato/{detcont}/create', [DosimetriaController::class, 'createdetalleContrato'])->name('detallecontrato.create');
Route::delete('detallecontrato/{detcont}/{contratodosisede}/{contratodosisededepto}/destroy', [DosimetriaController::class, 'destroyContdosisedepto'])->name('contratosdosisededepto.destroy');

Route::get('detallesedecont/{detsedcont}/create',[DosimetriaController::class, 'createdetsedeContrato'])->name('detallesedecont.create');
/////////RUTAS PARA EL CRUD DE ASIGNACION DOSIMETROS///////

/////KATE//// 
Route::get('asignadosicontratom1/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoM1'])->name('asignadosicontratom1.create');
Route::post('asignadosicontratom1/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoM1'])->name('asignadosicontratom1.save');

Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContratoMn'])->name('asignadosicontratomn.create');
Route::post('asignadosicontratomn/{asigdosicont}/{mesnumber}/', [DosimetriaController::class, 'saveAsignacionDosiContratoMn'])->name('asignadosicontratomn.save');
Route::get('asignadosicontratomn/{asigdosicont}/{mesnumber}/clear', [DosimetriaController::class, 'clearAsignacionAnteriorMn'])->name('asignadosicontratomn.clear');

Route::get('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/create',[DosimetriaController::class, 'asignaDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.create');
Route::post('asignadosicontratomnNovedad/{asigdosicont}/{mesnumber}/',[DosimetriaController::class, 'saveAsignacionDosiContratoMnNovedad'])->name('asignadosicontratomnNovedad.save');
/////////////

Route::get('asignadosicontrato/{asigdosicont}/{mesnumber}/create', [DosimetriaController::class, 'asignaDosiContrato'])->name('asignadosicontrato.create');
Route::post('asignadosicontrato', [DosimetriaController::class, 'saveAsignacionDosiContrato'])->name('asignadosicontrato.save');

Route::get('asignadosicontrato/{asigdosicont}/{mesnumber}/info', [DosimetriaController::class, 'info'])->name('asignadosicontrato.info');

// para eliminar y editar en ruta info
/* Route::patch('asignadosicontrato/{idWork}/{contratoId}/{mesnumber}/update', [DosimetriaController::class, 'updateInfo'])->name('asignadosicontrato.updateInfo'); */
/* Route::delete('asignadosicontrato/{idWork}/{contratoId}/{mesnumber}/delete', [DosimetriaController::class, 'deleteInfo'])->name('asignadosicontrato.deleteInfo'); */


///////////----------RUTA PARA ELIMINAR ASIGNACIONES DE DOSIMETROS KATEEE -----///////////////////
Route::put('asignadosicontrato/{id}/{mesnumber}/update', [DosimetriaController::class, 'updateFechasAsigContrato'])->name('asignadosicontrato.updatefechas');

Route::delete('asignadosicontrato/{id}/destroycontrol', [DosimetriaController::class, 'destroyControlasig'])->name('asigdosicont.destroyInfoControl');
Route::delete('asignadosicontrato/{id}/destroytrabajador', [DosimetriaController::class, 'destroyTrabajadorasig'])->name('asigdosicont.destroyInfoTrabajador');

///////////----------RUTA PARA AÑADIR OBSERVACIONES DEL MES SOBRE LAS ASIGNACIONES DE DOSIMETROS KATEEE -----///////////////////
Route::post('asignadosicontrato/saveObservacionMesAsigdosim', [DosimetriaController::class, 'saveObservacionMesAsigdosim'])->name('asigdosicont.saveObservacionMesAsigdosim');

///////DELETE DOSIMETRO FOR WORK////////

Route::delete('eliminatedDosiForWork/{idWork}/{contratoId}/{mesnumber}', [DosimetriaController::class, 'deleteDosimetro'])->name('dosimetroWork.destroy');
Route::delete('eliminatedDosiControl/{idDosiControl}/{contratoId}/{mesnumber}', [DosimetriaController::class, 'deleteDosimetroControl'])->name('dosimetroControl.destroy');
Route::delete('eliminatedTrabajadorSede/{idWork}/{contratoId}/{mesnumber}', [DosimetriaController::class, 'deleteTrabajadorSede'])->name('trabajadorSede.destroy');
Route::post('createdTrabajadorSede/{mesnumber}', [DosimetriaController::class, 'createTrabajadorSede'])->name('trabajadorSede.create');
Route::patch('editDosimetroStock/{idDosimetro}/{contratoId}/{mesnumber}',
    [DosimetriaController::class, 'patchDosimetroStock'])->name('dosimetroStock.patch');
Route::patch('editDosimetroDelete/{idDosimetro}/{contratoId}/{mesnumber}',
    [DosimetriaController::class, 'patchDosimetroDelete'])->name('dosimetroStockDelete.patch');

/////////RUTAS PARA EL CRUD DE LA LECTURA DE DOSIMETROS///////
Route::get('lecturadosi/{lecdosi}/create', [DosimetriaController::class, 'lecturadosi'])->name('lecturadosi.create');
Route::get('lecturadosi/{lecdosi}/{lecdosicontrol}/create', [DosimetriaController::class, 'lecturadosicontrl'])->name('lecturadosicontrl.create');
Route::put('lecturadosi/{lecdosi}', [DosimetriaController::class, 'savelecturadosi'])->name('lecturadosi.save');
Route::get('lecturadosi/{lecdosicont}/edit', [DosimetriaController::class, 'editlecturadosi'])->name('lecturadosi.edit');
Route::get('lecturadosi/{lecdosi}/getextraviado',[DosimetriaController::class,'getextraviado']);

Route::get('lecturadosicontrol/{lecdosicont}/create', [DosimetriaController::class, 'lecturadosicontrol'])->name('lecturadosicontrol.create');
Route::put('lecturadosicontrol/{lecdosicont}', [DosimetriaController::class, 'savelecturadosicontrol'])->name('lecturadosicontrol.save');
Route::get('lecturadosicontrol/{lecdosicont}/edit', [DosimetriaController::class, 'editlecturadosicontrol'])->name('lecturadosicontrol.edit');

Route::get('lecturadosiarea/{lecdosicont}/create', [DosimetriaController::class, 'lecturadosiarea'])->name('lecturadosiarea.create');
Route::put('lecturadosiarea/{lecdosicont}', [DosimetriaController::class, 'savelecturadosiarea'])->name('lecturadosiarea.save');

/////////RUTAS PARA LOS REPORTES O INFORMES DE DOSIMETRIA///////

Route::get('repodosimetria/{deptodosi}/{mesnumber}/pdf', [DosimetriaController::class, 'pdf'])->name('repodosimetria.pdf');

/////////RUTAS PARA LAS ETIQUETAS DE DOSIMETRIA ///////
Route::get('etiquetasdosimetria/{deptodosi}/{mesnumber}/pdf', [DosimetriaController::class, 'pdfEtiquetas'])->name('etiquetasdosimetria.pdf');

////////////RUTAS PARA LA REVISION SALIDA DE DOSIMETROS ASIGNADOS/////////
Route::get('revisiondosimetria/{deptodosi}/{mesnumber}/revision', [DosimetriaController::class, 'revisionDosimetria'])->name('revisiondosimetria.check');
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/dosimetro',[DosimetriaController::class, 'revisionDosimetro']);
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/trabajadordosimetro',[DosimetriaController::class, 'revisionCheck']);
Route::get('/revisiondosimetria/{deptodosi}/{mesnumber}/dosimetroControl',[DosimetriaController::class, 'revisionCheckControl']);


Route::get('revisiondosimetria/create', [DosimetriaController::class, 'revisionDosimetriaGeneral'])->name('revisiondosimetria.create');
Route::get('/revisiondosimetria/asignaciones', [DosimetriaController::class, 'asignaciones']);
Route::get('/revisiondosimetria/dosimetro', [DosimetriaController::class, 'revisionDosimetro']);
Route::get('/revisiondosimetria/trabajdosimetro',[DosimetriaController::class, 'revisionCheckGeneral']);
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral']);
Route::get('/revisiondosimetria/asignacionesControl', [DosimetriaController::class, 'asignacionesControl']);
Route::get('/revisiondosimetria/controldosimetro',[DosimetriaController::class, 'revisionCheckControlGeneral']);
Route::get('/revisiondosimetria/eliminarevisado', [DosimetriaController::class, 'eliminarevision']);
Route::get('certificadorevisiondosimetria/{empresa}/{deptodosi}/{mesnumber}/pdf', [DosimetriaController::class, 'pdfCertificadorevisionsalida'])->name('certificadorevision.pdf');

////////////RUTAS PARA LA REVISION ENTRADA DE DOSIMETROS ASIGNADOS/////////
Route::get('revisiondosimetriaentrada/{deptodosi}/{mesnumber}/revisionEntrada', [DosimetriaController::class, 'revisionDosimetriaEntrada'])->name('revisiondosimetriaEntrada.check');
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/dosimetro', [DosimetriaController::class, 'revisionDosimetro']);
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/dosimetroControlEntrada',[DosimetriaController::class, 'revisionCheckControlEntrada']);
Route::get('/revisiondosimetriaentrada/{deptodosi}/{mesnumber}/trabajadordosimetroEntrada',[DosimetriaController::class, 'revisionCheckEntrada']);

Route::get('revisiondosimetriaentrada/create', [DosimetriaController::class, 'revisionDosimetriaEntradaGeneral'])->name('revisiondosimetriaentrada.create');
Route::get('/revisiondosimetriaentrada/dosimetro', [DosimetriaController::class, 'revisionDosimetro']);
Route::get('/revisiondosimetriaentrada/asignaciones', [DosimetriaController::class, 'asignacionesEntrada']);
Route::get('/revisiondosimetriaentrada/asignacionesControl', [DosimetriaController::class, 'asignacionesControlEntrada']);

Route::post('revisiondosimetriaentrada/observacion', [DosimetriaController::class, 'observacionesRevsEntradaGeneral'])->name('observacionesrevsentradageneral.create');
Route::get('certificadorevisionentradadosimetria/{empresa}/{deptodosi}/{mesnumber}/pdf', [DosimetriaController::class, 'pdfCertificadorevisionentrada'])->name('certificadorevisionentrada.pdf');

////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (ANTIGUAS)//////////////
Route::get('novedades/create', [NovedadesController::class, 'index'])->name('novedadesdosim.create');
Route::get('/novedades/contratoDosim', [NovedadesController::class, 'contratoDosimetria']);
Route::get('/novedades/sedescontDosi', [NovedadesController::class, 'sedescontDosimetria']);
Route::get('/novedades/especialidadescontDosi', [NovedadesController::class, 'especialidadescontDosimetria']);
Route::get('/novedades/contdosisededepto/', [NovedadesController::class, 'contratodosi']);
Route::get('/novedades/mesescontdosisededepto/', [NovedadesController::class, 'mesescontDosimetria']);
Route::get('/novedades/mesactualcontdosisededepto/', [NovedadesController::class, 'mesactualcontDosimetria']);

Route::get('/novedades/dosiasginadosmesactual/', [NovedadesController::class, 'dosiasginadosmesactual']);
Route::get('/novedades/dosiasginadoscontrolmesactual/', [NovedadesController::class, 'dosiasginadoscontrolmesactual']);
Route::get('/novedades/trabajadoresempresa/', [NovedadesController::class, 'trabajadoresempresa']);
Route::get('/novedades/dosimetros/', [NovedadesController::class, 'dosimetrosdisponibles']);

Route::post('novedades/novedadesmesact', [NovedadesController::class, 'savecambiocantdosim'])->name('cambiocantdosim.save');
Route::get('novedades/{deptodosi}/{mesnumber}/reportePDFcambiodosim', [NovedadesController::class, 'reportePDFcambiodosim'])->name('reportePDFcambiodosim.pdf');

Route::post('novedades/novedadesmesig', [NovedadesController::class, 'savemesiguientecambiocantdosim'])->name('cambiocantdosimesig.save');
Route::get('novedades/limpiar/', [NovedadesController::class, 'clearAsignacionAnteriorMn']);

Route::get('novedades/meseschangecontratoDosi', [NovedadesController::class, 'meseschangecontratoDosi']);

////////////RUTAS PARA LAS NOVEDADES DE DOSIMETRIA (NUEVAS 05/12/22) //////////////
Route::get('novedades/search', [NovedadesController::class, 'search'])->name('novedadesdosimetria.search');
Route::get('/novedades/contratosDosim', [NovedadesController::class, 'contratosDosim']);
Route::get('/novedades/sedesEspcontDosi', [NovedadesController::class, 'sedesEspcontDosim']);
Route::get('/novedades/novedadesContDosim', [NovedadesController::class, 'novedadesContDosim']);
//////////////(se usaron las rutas para encontrar los contratos las sedes y las especialidades y el mes actual y las asignaciones de una empresa de dosimetria)/////////
Route::get('novedades/crear', [NovedadesController::class, 'create'])->name('novedadesdosimetria.create');

Route::get('novedades/nuevoDosimetro', [NovedadesController::class, 'nuevoDosimetro'])->name('novedadesdosimetria.nuevoDosimetro');
Route::get('novedades/retiroDosimetro', [NovedadesController::class,  'retiroDosimetro'])->name('novedadesdosimetria.retiroDosimetro');
Route::get('novedades/cambioTrabajador', [NovedadesController::class,  'cambioTrabajador'])->name('novedadesdosimetria.cambioTrabajador');
Route::get('novedades/{nota}/{deptodosi}/detalleNovedad', [NovedadesController::class, 'detalleNovedad'])->name('novedadesdosimetria.detalleNovedad');


 

/* Route::post('/prueba', function(Request $request){
    $name = $request->input('name');
    $surname = $request->input('surname');
    echo "tu nombre es $name y tu apellido es $surname";
}); */


