<?php

use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepportController;
use App\Http\Controllers\searchController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

route::get('post', [HomeController::class, 'post'])->middleware(['auth','admin']); // Test non fonctionnelle de rendre les page disponible qu'aux admins

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route pour la page admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', [AdminPagesController::class, 'users'])->name('users');
    Route::get('/users/search', [SearchController::class, 'search'])->name('users.search');
    Route::get('add_user',[AdminPagesController::class,'add'])->name('add_user');
    Route::post('add-user', [AdminPagesController::class,'store'])->name('add_user');
    Route::get('edit/{id}', [AdminPagesController::class, 'edit_user'])->name('admin.users.edit');
    Route::put('update-user/{id}', [AdminPagesController::class, 'update_user']);

    Route::post('delete-user/{id}', [AdminPagesController::class,'delete_user'])->name('users.destroy');
    Route::get('orders', [AdminPagesController::class,'orders'])->name('orders');

    Route::post('show', [HomeController::class, 'showUsers'])->name('dashboard.showUsers');

    Route::get('/get-user-count', [GraphController::class, 'getUserCount']);

    Route::get('/chart', [GraphController::class, 'showChart'])->name('show.chart');
    Route::get('/graph', [GraphController::class, 'getGraphData'])->name('get.graph.data');
    Route::get('/doughnut/{specificDate}', [GraphController::class, 'getDoughnutData'])->name('get.doughnut.data');


    Route::get('/meals', [GraphController::class, 'eat'])->name('meals.index');

    Route::get('/users-who-ate', [AdminPagesController::class, 'get_user_logs'])->name('users.who_ate');
    Route::get('/filter-user-logs', [SearchController::class, 'filter_user_logs'])->name('filter.user_logs');



    Route::get('/rapport', function () {
        return view('Rapport.rapport');
    });

    Route::post('/generer-rapport-utilisateurs', [RepportController::class, 'genererRapport'])->name('genererRapportUtilisateurs');

    Route::post('/generer-rapport-semaine', [RepportController::class, 'genererRapportSemaine'])->name('genererRapportSemaine');


    Route::get('/delete-users', [AdminPagesController::class,'showdel'])->name('delete.users');
    Route::get('/del/search', [SearchController::class, 'searchdel'])->name('del.search');

    Route::get('/historique', [SearchController::class, 'searchByNameAndEmail'])->name('historique');

    Route::get('/restore/{id}', [AdminPagesController::class, 'restore_user'])->name('users.restore');

    Route::get('/users-with-statut-1', [AdminPagesController::class, 'users_with_statut_1']);
    Route::get('/users-with-statut-1-and-compte-1', [AdminPagesController::class, 'users_with_statut_1_and_compte_1']);

});
//Route::get('/get-chart', [GraphController::class, 'showChart']);

