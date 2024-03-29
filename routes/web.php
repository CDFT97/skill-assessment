<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/admin/login', [AuthenticatedSessionController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login/create', [AuthenticatedSessionController::class, 'adminCreate'])->name('admin.create.login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Quotes
    Route::get("/quotes/random-quotes/{quantity?}", [QuoteController::class, "randomQuotes"])->name('quotes.fiverandom');
    Route::get("/quotes/my-favorites", [QuoteController::class, "myFavorites"])->name('quotes.myfavorites');
    Route::post("/quotes/store", [QuoteController::class, "store"])->name('quotes.store');
    Route::delete("/quotes/remove/{quote_id}", [QuoteController::class, "destroy"])->name('quotes.destroy');

    // ADMIN ROUTES
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::put('/users/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update.status');
        Route::get('users/quotes/{user_id}', [UserController::class, 'userQuotes'])->name('admin.users.quotes');
    });
});

require __DIR__ . '/auth.php';
