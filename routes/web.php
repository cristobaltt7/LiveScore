<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\SquadController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\FavoriteTeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AdminUserController;


Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.forgot');
Route::post('/forgot-password', [AuthController::class, 'verifySecretAnswer'])->name('password.verify');


Route::get('/', [FootballController::class, 'home'])->name('home');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');
    
Route::get('/equipos', function () {
    return view('equipos.index');
})->name('equipos.index')->middleware('auth');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/admin/users/{user}/password', [AdminUserController::class, 'changePassword'])->name('admin.users.changePassword');
    Route::delete('/admin/users/{user}/remove-favorite', [AdminUserController::class, 'removeFavorite'])->name('admin.users.removeFavorite');
    Route::put('/admin/users/{user}/update-profile', [AdminUserController::class, 'updateProfile'])->name('admin.users.updateProfile');
    Route::delete('/admin/users/{user}/favorites/{teamId}', [AdminUserController::class, 'removeFavorite'])
     ->name('admin.users.removeFavorite');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/football/team/{id}', [FootballController::class, 'teamDetails'])->name('football.team');
});


Route::middleware('auth')->group(function () {
    Route::get('/squads/create', [SquadController::class, 'create'])->name('squads.create');
    Route::post('/squads/store', [SquadController::class, 'store'])->name('squads.store');
    Route::delete('/squads/{squad}', [SquadController::class, 'destroy'])->name('squads.destroy');
});


Route::middleware(['auth'])->group(function () {
    // Football routes
    Route::get('/football', [FootballController::class, 'index'])->name('football');
    Route::get('/football/search', [FootballController::class, 'search']);
    Route::get('/football/team/{id}', [FootballController::class, 'teamDetails']);
    Route::post('/football/toggle-favorite', [FootballController::class, 'toggleFavorite']);
    Route::get('/football/leagues', [FootballController::class, 'availableLeagues']);

    // User favorites
    Route::get('/user/favorites', function() {
        return response()->json([
            'favorites' => json_decode(auth()->user()->favorite_teams ?? '[]', true)
        ]);
    });
});


Route::get('/football/team/{teamId}/squad', [FootballController::class, 'getTeamSquad']);
Route::get('/football/team/{teamId}/view-squad', [FootballController::class, 'showSquadView']);
Route::get('/transfermarkt/squad/{clubId}', [FootballController::class, 'getTransfermarktSquad']);
Route::get('/liga/resultados', [FootballController::class, 'resultados'])->name('liga.resultados');

Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias');
Route::get('/noticias/fetch', [NoticiaController::class, 'fetch']);
Route::get('/noticias/search', [NoticiaController::class, 'search']);



Route::get('/api/news/sidebar', function () {
    $response = Http::get('https://gnews.io/api/v4/search', [
        'q' => 'fútbol español',
        'lang' => 'es',
        'country' => 'es',
        'max' => 10,
        'apikey' => 'ea4e1d5ab7d64ede59c27928015e65b3'
    ]);

    return response()->json($response->json());
});

Route::get('/football/team/{id}', [FootballController::class, 'teamDetails']);

Route::middleware('auth')->group(function () {
    Route::post('/favorite/toggle', [FavoriteTeamController::class, 'toggle'])
         ->name('favorite.toggle');
    Route::get('/followed-team', function () {
        $favorites = json_decode(auth()->user()->favorite_teams ?? '{}', true);
        return view('followed-team', ['favorites' => $favorites]);
    })->name('favorites');

    Route::get('/football/view/{id}', function ($id) {
        return redirect('/football')->with('scrollToTeamId', $id);
    })->name('football.view');
});


    Route::get('/club/{id}', [FootballController::class, 'verClub'])->name('club.ver');

Route::middleware('auth')->group(function () {
    Route::get('/club/{clubId}/players', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/players/{playerId}/full-profile', [PlayerController::class, 'fullProfile'])->name('players.full-profile');
});
Route::get('/player-statistics', [PlayerController::class, 'showAllClubs'])->name('player-statistics.index');

