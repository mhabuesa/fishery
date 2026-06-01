<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PondController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login');
});


Route::middleware(['auth', SetLocale::class])->group(function () {

    
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/language/{lang}', 'changeLanguage')->name('language.change');
    });

    // Partner Routes
    Route::controller(UserController::class)->name('partner.')->prefix('partner')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Purpose Routes
    Route::controller(PurposeController::class)->name('purpose.')->prefix('purpose')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
    
    // Purpose Routes
    Route::controller(PondController::class)->name('pond.')->prefix('pond')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Finance Routes
    Route::controller(FinanceController::class)->name('finance.')->prefix('finance')->group(function () {
        Route::get('/investment', 'investment_index')->name('investment.index');
        Route::get('/investment/create', 'investment_create')->name('investment.create');
        Route::post('/investment', 'investment_store')->name('investment.store');
        Route::get('/investment/edit/{id}', 'investment_edit')->name('investment.edit');
        Route::post('/investment/update/{id}', 'investment_update')->name('investment.update');
        Route::delete('/investment/destroy/{id}', 'investment_destroy')->name('investment.destroy');
        
        // Expense Routes
        Route::get('/expense', 'expense_index')->name('expense.index');
        Route::get('/expense/create', 'expense_create')->name('expense.create');
        Route::post('/expense', 'expense_store')->name('expense.store');
        Route::get('/expense/edit/{id}', 'expense_edit')->name('expense.edit');
        Route::post('/expense/update/{id}', 'expense_update')->name('expense.update');
        Route::delete('/expense/destroy/{id}', 'expense_destroy')->name('expense.destroy');
    });

    // Extra Routes of resource controllers can be defined here
    // Profile Routes
    Route::controller(ProfileController::class)->name('profile.')->prefix('profile')->group(function () {
        Route::post('/profile_password/{profile}', 'profile_password')->name('password');
    });


    // Resource Controller
    Route::resources([
        'profile' => ProfileController::class,
    ]);

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });
});