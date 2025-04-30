<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\AnnonceController;
use App\Http\Middleware\AdminMiddleware;

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
    return view('layouts.app');
});

Route::prefix('/auth')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name("register");
    Route::post('/register', [AuthController::class, 'registerPost'])->name("register");  
    Route::get('/login', [AuthController::class,'login'])->name("login");   
    Route::post('/login', [AuthController::class,'loginPost'])->name("login"); 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
});


Route::get("/getvalidatefalse",[AnnonceController::class, 'getvalidateFalse'])->name("getvalidateFalse"); 

Route::post('/setVlidateTrue/{id}', [AnnonceController::class, 'setVlidateTrue'])->name('setVlidateTrue');



Route::resource("/categories",CategorieController::class); 
Route::resource("/annonces",AnnonceController::class); 
Route::resource("/villes",VilleController::class); 
Route::resource("/users",AuthController::class); 
Route::get("/search",[AnnonceController::class,"search"])->name("search"); 
Route::get("/immobilier",[AnnonceController::class,"immobilier"])->name("immobilier"); 
Route::get("/vehicule",[AnnonceController::class,"vehicule"])->name("vehicule"); 
Route::get("/objet",[AnnonceController::class,"objet"])->name("objet"); 
Route::get("/multimedia",[AnnonceController::class,"multimedia"])->name("multimedia"); 
Route::get("/maison",[AnnonceController::class,"maison"])->name("maison"); 
Route::get("/emploi",[AnnonceController::class,"emploi"])->name("emploi"); 

Route::get("/profile",[AuthController::class,"profile"])->name("profile"); 
Route::post("/profile",[AuthController::class,"update"])->name("profile"); 

 





