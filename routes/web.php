<?php
// use App\asset_details;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
// use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SurveyorDashboardController;
use App\Http\Controllers\SuperadminDashboardController;


//Dashboard
Route::get('/superadmin/displaydashboard', [SuperadminDashboardController::class, 'showDashboard'])->name('superadmin.displayDash');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/surveyor/dashboard', [SurveyorDashboardController::class, 'index'])->name('surveyor.dashboard');
    Route::get('/superadmin/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.dashboard');
});


//Assets
Route::get('/superadmin/assetModule', [SuperadminDashboardController::class, 'viewassetModule'])->name('superadmin.assetModule');
Route::get('/superadmin/location', [SuperadminDashboardController::class, 'viewlocation'])->name('superadmin.location');
Route::POST('/superadmin/assetModule/{campusId}', [SuperadminDashboardController::class, 'storeassetModule'])->name('asset.store');
Route::post('/campus', [SuperadminDashboardController::class, 'storeCampus'])->name('campus.store');
// Route::get('/getCampus', [SuperadminDashboardController::class, 'campusForm'])->name('superadmin.getCampus');
Route::get('/superadmin/edit/{id}', [SuperadminDashboardController::class, 'editAssets'])->name('superadmin.editAsset');
Route::post('/superadmin/updateAsset', [SuperadminDashboardController::class, 'updateAsset'])->name('asset.update');
Route::post('/superadmin/deleteAsset/{id}', [SuperadminDashboardController::class, 'deleteAsset'])->name('asset.delete');
Route::post('/superadmin/finalizeAsset/{id}', [SuperadminDashboardController::class, 'finalizeAsset'])->name('asset.delete');
Route::get('/getLatestId', [SuperadminDashboardController::class, 'getLatestTag'])->name('asset.id');


//Users
Route::get('/superadmin/displayUsers', [SuperadminDashboardController::class, 'displayUsers'])->name('superadmin.displayUsers');
Route::get('/superadmin/Users', [SuperadminDashboardController::class, 'viewUsers'])->name('superadmin.Users');
Route::post('/users/updateUser', [SuperadminDashboardController::class, 'updateUser'])->name('users.update');
Route::get('/superadmin/addUser', [SuperadminDashboardController::class, 'ViewAddUser'])->name('users.add');
Route::post('/superadmin/addUser', [SuperadminDashboardController::class, 'AddUser'])->name('users.add');
Route::post('/superadmin/deleteUser/{id}', [SuperadminDashboardController::class, 'DeleteUser'])->name('users.delete');
Route::get('/superadmin/editUser/{Id}', [SuperadminDashboardController::class, 'EditUser'])->name('users.edit');
Route::get('/superadmin/showeditUser/{Id}', [SuperadminDashboardController::class, 'showEditUser'])->name('users.edit');


// Auth routes
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


//stats Routes
Route::get('/superadmin/stats', [SuperadminDashboardController::class, 'viewstats'])->name('superadmin.stats');



//geting all other data
Route::get('/sub-products/{faCategoryCode}', [SuperadminDashboardController::class, 'getSubcategory'])->name('products.sub-products');
Route::Post('/uploadcategory', [SuperadminDashboardController::class, 'uploadcategory']);
Route::get('/faCat', [SurveyorDashboardController::class, 'getfacategory'])->name('surveyor.facategory');






Route::get('/surveyor/addAsset', [SurveyorDashboardController::class, 'viewlocation'])->name('surveyor.assetModule');
Route::POST('/surveyor/assetModule/{campusId}', [SurveyorDashboardController::class, 'storeassetModule'])->name('asset.store');
Route::get('/surveyor/assetModule', [SurveyorDashboardController::class, 'viewassetModule'])->name('superadmin.assetModule');
Route::get('/getCampus', [SurveyorDashboardController::class, 'getCampus'])->name('surveyor.getCampus');
Route::get('/getdata', [SurveyorDashboardController::class, 'showdata'])->name('get.assets');
