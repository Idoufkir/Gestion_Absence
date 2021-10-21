<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\MotifController;
use App\Http\Middleware\AdminAuthenticated;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('employes', EmployeController::class);

Route::get('/employes', [EmployeController::class, 'index'])->middleware('auth')->name('employes.index');
Route::get('/employes/{employe}/edit', [EmployeController::class, 'edit'])->middleware('auth')->name('employes.edit');
Route::delete('/employes/{employe}', [EmployeController::class, 'destroy'])->middleware('auth')->name('employes.destroy');
Route::patch('/employes/{employe}', [EmployeController::class, 'update'])->middleware('auth')->name('employes.update');

Route::get('/historique', [HistoriqueController::class, 'index'])->middleware('auth')->name('historiques.index');

Route::get('/motifs', [MotifController::class, 'index'])->middleware('auth')->name('motifs.index');
Route::post('/motifs', [MotifController::class, 'store'])->middleware('auth')->name('motifs.store');
Route::get('/motifs/{motif}/edit', [MotifController::class, 'edit'])->middleware('auth', 'admin')->name('motifs.edit');
// Route::delete('/motifs/{motif}', [MotifController::class, 'destroy'])->middleware('auth', 'admin')->name('motifs.destroy');
Route::patch('/motifs/{motif}', [MotifController::class, 'update'])->middleware('auth', 'admin')->name('motifs.update');

Route::get('/demo', function () {
    return view('demo');
 });

Auth::routes();

Route::get('/404', function()
{
    return view('404');
})->name('not-found');


// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', function () 
    {
        return view('welcome');
    });
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', function () 
    {
        return view('motif');
    });
    Route::delete('/motifs/{motif}', [MotifController::class, 'destroy'])->name('motifs.destroy');
});