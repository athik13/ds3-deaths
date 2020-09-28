<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Run;
use App\Models\Boss;
use App\Models\Death;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/death-counter', function () {
    $run_check = Run::all();
    if ($run_check->isEmpty()) {
        $run = new Run;
        $run->user_id = auth()->user()->id;
        $run->run = 1;
        $run->save();
    }
    $runs = Run::all();

    return view('deaths.index', compact('runs'));
})->name('death-counter');

Route::middleware(['auth:sanctum', 'verified'])->get('/death-counter/{run}', function (Run $run) {    
    $bosses = Boss::orderBy('order')->get();
    $death_check = Death::where('user_id', auth()->user()->id)->where('run_id', $run->id)->get();
    if ($death_check->isEmpty()) {
        foreach ($bosses as $boss) {
            $death = new Death;
            $death->user_id = auth()->user()->id;
            $death->run_id = $run->id;
            $death->boss_id = $boss->id;
            $death->save();
        }
    }

    $deaths = Death::where('user_id', auth()->user()->id)->where('run_id', $run->id)->get();

    return view('deaths.run', compact('run', 'deaths'));
});

Route::post('save-deaths', function(Request $request) {
    // return $request->all();

    $death = Death::find($request->death_id);
    $death->death_count = $request->death_count;
    $death->notes = $request->notes;
    $death->save();

    return redirect()->back();
});