<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\MotifController;

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

Route::get('/motif', [MotifController::class, 'index'])->middleware('auth')->name('motifs.index');
Route::post('/motif', [MotifController::class, 'store'])->middleware('auth')->name('motifs.store');

Route::get('/demo', function () {
    return view('demo');
 });



//  // user protected routes
// Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
//     Route::get('/', 'HomeController@index')->name('user_dashboard');
// });

// // admin protected routes
// Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
// });

Auth::routes();

Route::get('/404', function()
{
    return view('404');
})->name('not-found');

