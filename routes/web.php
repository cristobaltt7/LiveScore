<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\SquadController;


Route::get('/', [FootballController::class, 'home'])->name('home');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
Route::get('/settings', function () {
    return view('settings');
})->name('settings');
    
Route::get('/equipos', function () {
    return view('equipos.index');
})->name('equipos.index')->middleware('auth');

Route::get('/football', function () {
    return view('football');
})->name('football');

Route::get('/sports', function () {
    return view('sports');
})->name('sports');

Route::get('/news', function () {
    return view('news');
})->middleware('auth');

Route::get('/followed-team', function () {
    return view('followed-team');
})->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
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

Route::get('/test-sportdevs', function () {
    $token = env('SPORTDEVS_API_KEY');

    $response = Http::withHeaders([
        'Authorization' => "Bearer $token"
    ])->get('https://api.sportdevs.com/api/v1/leagues');

    if ($response->successful()) {
        return response()->json([
            'success' => true,
            'leagues' => $response->json()['data']
        ]);
    } else {
        return response()->json([
            'success' => false,
            'status' => $response->status(),
            'error' => $response->body()
        ]);
    }
});

Route::get('/football/team/{teamId}/squad', [FootballController::class, 'getTeamSquad']);
Route::get('/football/team/{teamId}/view-squad', [FootballController::class, 'showSquadView']);
Route::get('/transfermarkt/squad/{clubId}', [FootballController::class, 'getTransfermarktSquad']);
Route::get('/liga/resultados', [FootballController::class, 'resultados'])->name('liga.resultados');
