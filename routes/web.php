<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\YieldController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\PlantController;
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\BatchController;


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

//Footer Links Routes
Route::get('/about_us', function(){return view('aboutUs');});
Route::get('/developer', function(){return view('developer');});
Route::get('/contact_us', function(){return view('contactUs');});

Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Routes for Profile
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//Routes for Dashboard (Current Season)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/startSeason', [DashboardController::class, 'startSeason'])->name('season.start');
Route::post('/endSeason', [DashboardController::class, 'endSeason'])->name('season.end');
Route::post('/updateReminder', [DashboardController::class, 'updateReminder'])->name('reminder.update');

//Routes for Labor
Route::get('/labor', [LaborController::class, 'index'])->name('labor.index');
Route::get('/labor/add', [LaborController::class, 'addLaborer'])->name('labor.add');
Route::post('/labor/add', [LaborController::class, 'addLaborerSubmit'])->name('labor.addSubmit');
Route::get('/labor/delete/{id}', [LaborController::class, 'deleteLaborer'])->name('labor.delete');
Route::get('/labor/edit/{id}', [LaborController::class, 'editLaborer'])->name('labor.edit');
Route::post('/labor/update', [LaborController::class, 'updateLaborer'])->name('labor.update');

//Routes for Laborwage Expenses (Only visible and accessable by Admin account)
Route::group(['middleware' => 'role:administrator||superadministrator'], function () {
	Route::get('/laborwage', [ExpenseController::class, 'laborwage'])->name('expense.laborwage');
	Route::get('/laborwage/record', [ExpenseController::class, 'addWage'])->name('expense.addWage');
	Route::post('/laborwage/recorded', [ExpenseController::class, 'addWageSubmit'])->name('expense.addWageSubmit');
	Route::get('/laborwage/delete/{id}', [ExpenseController::class, 'deleteWage'])->name('expense.deleteWage');
	Route::get('/laborwage/edit/{id}', [ExpenseController::class, 'editWage'])->name('expense.editWage');
	Route::post('/laborwage/update', [ExpenseController::class, 'updateWage'])->name('expense.updateWage');
});

//Routes for Material Expenses
Route::get('/materials', [ExpenseController::class, 'materials'])->name('expense.materials');
Route::get('/materials/record', [ExpenseController::class, 'addMatExpense'])->name('expense.addMatExpense');
Route::post('/materials/recorded', [ExpenseController::class, 'addMatExpenseSubmit'])->name('expense.addMatExpenseSubmit');
Route::get('/materials/delete/{id}', [ExpenseController::class, 'deleteMatExpense'])->name('expense.deleteMatExpense');
Route::get('/materials/edit/{id}', [ExpenseController::class, 'editMatExpense'])->name('expense.editMatExpense');
Route::post('/materials/update', [ExpenseController::class, 'updateMatExpense'])->name('expense.updateMatExpense');

//Routes for Tax
Route::get('/tax', [ExpenseController::class, 'tax'])->name('expense.tax');
Route::get('/tax/record', [ExpenseController::class, 'addTaxExpense'])->name('expense.addTaxExpense');
Route::post('/tax/recorded', [ExpenseController::class, 'addTaxExpenseSubmit'])->name('expense.addTaxExpenseSubmit');
Route::get('/tax/delete/{id}', [ExpenseController::class, 'deleteTaxExpense'])->name('expense.deleteTaxExpense');
Route::get('/tax/edit/{id}', [ExpenseController::class, 'editTaxExpense'])->name('expense.editTaxExpense');
Route::post('/tax/update', [ExpenseController::class, 'updateTaxExpense'])->name('expense.updateTaxExpense');

//Routes for Yields
Route::get('/yields', [YieldController::class, 'index'])->name('yield.index');
Route::get('/yields/add', [YieldController::class, 'addYield'])->name('yield.add');
Route::post('/yields/addSubmit', [YieldController::class, 'addYieldSubmit'])->name('yield.addSubmit');
Route::get('/yields/delete/{id}', [YieldController::class, 'deleteYield'])->name('yield.delete');
Route::get('/yields/edit/{id}', [YieldController::class, 'editYield'])->name('yield.edit');
Route::post('/yields/update', [YieldController::class, 'updateYield'])->name('yield.update');

//Routes for Revenue
Route::get('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
Route::get('/revenue/add', [RevenueController::class, 'addRevenue'])->name('revenue.add');
Route::post('/revenue/addSubmit', [RevenueController::class, 'addRevenueSubmit'])->name('revenue.addSubmit');
Route::get('/revenue/delete/{id}', [RevenueController::class, 'deleteRevenue'])->name('revenue.delete');
Route::get('/revenue/edit/{id}', [RevenueController::class, 'editRevenue'])->name('revenue.edit');
Route::post('/revenue/update', [RevenueController::class, 'updateRevenue'])->name('revenue.update');

//Routes for History
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/viewSeason/{id}', [HistoryController::class, 'viewSeason'])->name('history.view');

//Routes for Progress
Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
Route::get('/progress/last-five-seasons', [ProgressController::class, 'lastfive'])->name('progress.lastfive');
Route::get('/progress/compare-from-last-season', [ProgressController::class, 'comparefromlast'])->name('progress.comparefromlast');

//Only Admin can access laratrust
Route::group(['middleware' => 'role:administrator||superadministrator'], function () {
	Route::get('/laratrust', function () {
		return redirect('/laratrust/roles-assignment');
	});
});

//--------------------

//Plants Routes
Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
Route::get('/plants/add', [PlantController::class, 'addPlant'])->name('plants.add');
Route::post('/plants/addSubmit', [PlantController::class, 'addPlantSubmit'])->name('plants.addSubmit');
Route::get('/plants/edit/{id}', [PlantController::class, 'editPlant'])->name('plants.edit');
Route::get('/plants/delete/{id}', [PlantController::class, 'deletePlant'])->name('plants.delete');

//Utilities
Route::get('/utilities', [UtilitiesController::class, 'index'])->name('utilities');
Route::post('/utilities/addSoilType', [UtilitiesController::class, 'addSoilType'])->name('addSoilType');
Route::get('/utilities/deleteSoilType/{id}', [UtilitiesController::class, 'deleteSoilType'])->name('deleteSoilType');
Route::post('/utilities/addPlantCategory', [UtilitiesController::class, 'addPlantCategory'])->name('addPlantCategory');
Route::get('/utilities/deletePlantCategory/{id}', [UtilitiesController::class, 'deletePlantCategory'])->name('deletePlantCategory');
Route::post('/utilities/addPlantType', [UtilitiesController::class, 'addPlantType'])->name('addPlantType');
Route::get('/utilities/deletePlantType/{id}', [UtilitiesController::class, 'deletePlantType'])->name('deletePlantType');
Route::post('/utilities/addDisease', [UtilitiesController::class, 'addDisease'])->name('addDisease');
Route::get('/utilities/deleteDisease/{id}', [UtilitiesController::class, 'deleteDisease'])->name('deleteDisease');

//Batch Routes
Route::get('/batch', [BatchController::class, 'index'])->name('batch.index');
Route::get('/batch/add', [BatchController::class, 'addBatch'])->name('batch.add');
Route::post('/batch/addSubmit', [BatchController::class, 'addBatchSubmit'])->name('batch.addSubmit');
Route::get('/batch/view/{id}', [BatchController::class, 'viewBatch'])->name('batch.view');
Route::get('/batch/progress/{id}', [BatchController::class, 'batchProgress'])->name('batch.progress');
Route::post('/batch/updateBatchProgress', [BatchController::class, 'updateBatchProgress'])->name('batch.updateBatchProgress');
Route::get('/batch/activities/{id}', [BatchController::class, 'batchActivities'])->name('batch.activities');
Route::get('/batch/diseases/{id}', [BatchController::class, 'batchDiseases'])->name('batch.diseases');
Route::post('/batch/addBatchDisease', [BatchController::class, 'addBatchDisease'])->name('batch.addBatchDisease');
Route::get('/batch/deleteBatchDisease/{id}', [BatchController::class, 'deleteBatchDisease'])->name('batch.deleteBatchDisease');
Route::post('/batch/addBatchActivity', [BatchController::class, 'addBatchActivity'])->name('batch.addBatchActivity');

