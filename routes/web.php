<?php

use Inertia\Inertia;
use App\Models\PackageType;
use App\Imports\ShipmentImport;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\CarrierController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManifastController;
use App\Http\InertiaControllers\ProductsController;
use App\Http\Controllers\Admin\PackageTypeController;
use App\Http\Controllers\Customers\PackageController;
use App\Http\Controllers\Customers\DashboardController as CustomersDashboardController;

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

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [ProfileController::class, 'login'])->name('login');
    Route::post('check', [ProfileController::class, 'check'])->name('check');

    Route::middleware(['admin'])->group(function () {
        Route::post('logout', [ProfileController::class, 'destroy'])->name('logout');
        Route::post('bulkupdate', [ShipmentController::class, 'bulkupdate'])->name('shipments.bulkupdate');
        Route::resource('shipments', ShipmentController::class);
        Route::get('manifests', [ManifastController::class,'index'])->name('manifest.index');

        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::resource('customers', UserController::class);
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::resource('statuses', StatusController::class);
            Route::resource('rates', RateController::class);
            Route::resource('shippers', ShipperController::class);
            Route::resource('packagetypes', PackageTypeController::class);
            Route::resource('carriers', CarrierController::class);
            Route::resource('countries', CountryController::class);
            // Route::resource('states', StateController::class);
            Route::get('states/list/{state}', [StateController::class, 'list'])->name('states.list');
            Route::get('states/{state}', [StateController::class, 'index'])->name('states.index');
            // Route::get('states', [StateController::class, 'index'])->name('states.index');
            Route::post('cities', [CityController::class, 'store'])->name('cities.store');
        });
        Route::resource('manifests', ManifastController::class);
        Route::post('excel', [ExcelController::class, 'import'])->name('excel.import');
        Route::get('manifest/export/', [ExcelController::class, 'export'])->name('excel.manifest');
        Route::resource('settings', SettingController::class);
        Route::resource('products', ProductsController::class);
        // Route::get('customers/create', [\App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        // Route::get('customer', [\App\Http\Controllers\UserController::class, 'store'])->name('customer.store');
        // Route::get('customers/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('customers.edit');
        // Route::get('customer', [\App\Http\Controllers\UserController::class, 'update'])->name('customer.update');
        // Route::get('customers/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('customers.destroy');

        Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    });
});





require __DIR__ . '/auth.php';

    Route::get('about', function () {
        return Inertia::render('About');
    })->name('about');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [CustomersDashboardController::class, 'index'])->name('dashboard');

    Route::get('packages', [PackageController::class,'list'])->name('packages.list');
    Route::get('package/{id}/show', [PackageController::class,'show'])->name('packages.show');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
