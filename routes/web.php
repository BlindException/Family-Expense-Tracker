<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FamilyUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionCategoryController;

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

Route::get('/dashboard', function () {
    $first_day_this_month = date('Y-m-01 00:00:00');
        $today = now();
        $user = auth()->user();
        $userSum = $user->transactions()->get()->sum("amount");
        $familySum = 0;
    $families = $user->families()->get();
    $familyTotals = array();
    $memberPortion = 0;
    foreach($families as $family)
    {
        if(count($family->transactions()->get())>0)
        {
            $famSum = $family->transactions()->get()->sum("amount");
            $count = count($family->users);
            $memberPortion += $famSum / $count;
            array_push($familyTotals, $famSum);
            $familySum += $famSum;
        }
    }
    return view('dashboard', [
        'userSum' => $userSum,
        'families' => $families,
        'familyTotals' => $familyTotals,
'familyTotal' => $familySum,
'familyPortion' => $memberPortion,
'allTotal' => $memberPortion + $userSum,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('transactioncategories', TransactionCategoryController::class)
->only(['index','create','store','edit','update','destroy'])
->middleware(['auth', 'verified']);

Route::resource('families', FamilyController::class)
->only(['index', 'create', 'store', 'edit', 'update', 'show', 'destroy'])
->middleware(['auth', 'verified']);

Route::resource('familyusers', FamilyUserController::class)
->only([ 'create', 'store'])
->middleware(['auth', 'verified']);


Route::resource('transactions', TransactionController::class)
->only(['index', 'create', 'store', 'view', 'edit', 'update', 'show', 'destroy'])
->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
