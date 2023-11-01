<?php

use App\Http\Controllers\Form\LeadFormController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LeadFormController::class, 'index'])->name('form.index');
Route::post('/send', [LeadFormController::class, 'send'])->name('form.send');
