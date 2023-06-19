<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserDashbordController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\LangueController;

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
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/redirects',[HomeController::class,"index"])->middleware(['auth', 'verified'])->name('redirects');

##Route::get('/redirects',[HomeController::class,"index"]);


Route::get('/auth/google/redirect', [GoogleController::class ,'redirect']);    
Route::get('/auth/google/callback-url',[GoogleController::class,'callback']);



Route::get('wp-admin/Menue',[MenuController::class, 'Menue1']);
Route::get('wp-admin/Menuef',[MenuController::class, 'Menuef']);


Route::get('versionpro',[MenuController::class, 'pro']);
Route::get('user/contact',[MenuController::class, 'menue']);
Route::get('user/user',[UserDashbordController::class, 'UserDashbord']);
Route::get('/addtask', [UserDashbordController::class, 'form_add']);
Route::get('formPayement',[MenuController::class, 'payement']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
/*
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/private', function () {
        return view('Admin');
    });
    
});
*/
//route projet



Route::get('/listtask', [App\Http\Controllers\ProjetController::class, 'form_listtask']);
Route::get('/taskencours', [App\Http\Controllers\ProjetController::class, 'form_taskencours']);
Route::get('/finishtask', [App\Http\Controllers\ProjetController::class, 'form_finishtask']);
Route::post('/addtask_traitement', [ProjetController::class, 'traitement_add']);
Route::post('/begintask/{id}', 'App\Http\Controllers\ProjetController@begintask')->name('begin_task');
Route::delete('/deletetask/{id}', 'App\Http\Controllers\ProjetController@destroy')->name('delete_task');
Route::delete('/deletetaskencours/{id}', 'App\Http\Controllers\ProjetController@destroy2')->name('delete_taskencours');
Route::post('/canceltaskencours/{id}', 'App\Http\Controllers\ProjetController@canceltaskencours')->name('cancel_taskencours');
Route::post('/finishtask/{id}', 'App\Http\Controllers\ProjetController@finishtask')->name('finish_task');
Route::delete('/deletetaskfinish/{id}', 'App\Http\Controllers\ProjetController@destroy3')->name('delete_taskfinish');
Route::post('/finishtask/{id}', 'App\Http\Controllers\ProjetController@finishtask')->name('finish_task');
Route::put('/update/{id}', [ProjetController::class, 'updatetask'])->name('update_task');







//LiveWireRoute

Route::get('/users',CreateChat::class)->name('users');
Route::get('/chat{key?}',Main::class)->name('chat');

//Langue route

//Route::get("locale/{langue}",[LangueController::class,"setLangue"]);


require __DIR__.'/auth.php';
