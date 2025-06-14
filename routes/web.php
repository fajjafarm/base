<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PoolTestController;
use App\Http\Controllers\EquipmentCheckController;
use App\Http\Controllers\WaterBalanceTestController;
use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\BackwashController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\PlantroomController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\WaterMeterReadingController;
use App\Http\Controllers\BikeRentalController;
use App\Http\Controllers\BikeLockController;
use App\Http\Controllers\BikeHelmetController;
use App\Http\Controllers\ThermalSuiteController;
use App\Http\Controllers\ThermalSuiteCheckController;
use App\Http\Controllers\BikeRentalOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\BackwashLogController;
use App\Http\Controllers\SuperAdmin\SuperAdminPlantroomController;
use App\Http\Controllers\SuperAdmin\SuperAdminPlantroomComponentController;
use App\Http\Controllers\SuperAdmin\SuperAdminPoolController;
use App\Http\Controllers\SuperAdmin\SuperAdminThermalSuiteController;
use App\Http\Controllers\SuperAdmin\SuperAdminWaterMeterController;
use App\Http\Controllers\SuperAdmin\SuperAdminTeamMemberController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\CashUpController;

//super admin access only
//Route::resource('pool-tests/{pool_id}', PoolTesttController::class)->only(['index', 'store']);
require __DIR__ . '/auth.php';

Route::get('/calendar', function () {
    return view('calendar');
})->middleware('auth');

Route::prefix('superadmin')->middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.dashboard');

    Route::get('/plantroom/create', [SuperAdminPlantroomController::class, 'create'])->name('superadmin.plantroom.create');
    Route::post('/plantroom/store', [SuperAdminPlantroomController::class, 'store'])->name('superadmin.plantroom.store');

    Route::get('/plantroom/components/create/{plantroom_id}', [SuperAdminPlantroomComponentController::class, 'create'])->name('superadmin.plantroom.components.create');
    Route::post('/plantroom/components/count/{plantroom_id}', [SuperAdminPlantroomComponentController::class, 'storeCounts'])->name('superadmin.plantroom.components.count');
    Route::get('/plantroom/components/details/{plantroom_id}', [SuperAdminPlantroomComponentController::class, 'details'])->name('superadmin.plantroom.components.details');
    Route::post('/plantroom/components/store/{plantroom_id}', [SuperAdminPlantroomComponentController::class, 'store'])->name('superadmin.plantroom.components.store');

    Route::get('/cash-up', [CashUpController::class, 'index'])->name('cash_up.cash_up');
    Route::post('/cash-up', [CashUpController::class, 'submit'])->name('cash_up.submit');

    Route::get('/team-members', [TeamMemberController::class, 'index'])->name('team-members.index');
    Route::get('/team-members/{teamMember}', [TeamMemberController::class, 'show'])->name('team-members.show');

    Route::get('/pool/create', [SuperAdminPoolController::class, 'create'])->name('superadmin.pool.create');
    Route::post('/pool/store', [SuperAdminPoolController::class, 'store'])->name('superadmin.pool.store');

    Route::get('/thermal-suite/create', [SuperAdminThermalSuiteController::class, 'create'])->name('superadmin.thermal_suite.create');
    Route::post('/thermal-suite/store', [SuperAdminThermalSuiteController::class, 'store'])->name('superadmin.thermal_suite.store');

    Route::get('/water-meter/create', [SuperAdminWaterMeterController::class, 'create'])->name('superadmin.water_meter.create');
    Route::post('/water-meter/store', [SuperAdminWaterMeterController::class, 'store'])->name('superadmin.water_meter.store');

    Route::get('/team-member/create', [SuperAdminTeamMemberController::class, 'create'])->name('superadmin.team_member.create');
    Route::post('/team-member/store', [SuperAdminTeamMemberController::class, 'store'])->name('superadmin.team_member.store');
});

Route::get('/backwashes/{plantroom_id}', [BackwashLogController::class, 'index'])->name('backwashes.index');
Route::get('/backwashes/create/{plantroom_id}', [BackwashLogController::class, 'create'])->name('backwashes.create');
Route::post('/backwashes/store', [BackwashLogController::class, 'store'])->name('backwashes.store');

    Route::get('/users/{user:id}', [UserController::class, 'show'])->name('users.show'); // Updated
    Route::get('/training/create', [TrainingSessionController::class, 'create'])->name('training.create');
    Route::post('/training', [TrainingSessionController::class, 'store'])->name('training.store');

    Route::get('/plantroom/create/{clientID}', [PlantroomController::class, 'create'])->name('plantroom.create');
Route::post('/plantroom/store', [PlantroomController::class, 'store'])->name('plantroom.store');
Route::get('/plantroom-menu', [PlantroomController::class, 'getPlantroomMenu'])->name('plantroom.menu');


   Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/training/create', [TrainingSessionController::class, 'create'])->name('training.create');
    Route::post('/training', [TrainingSessionController::class, 'store'])->name('training.store');


Route::get('/pool-tests/{pool_id}', [PoolTestController::class, 'index'])->name('pool-tests.create');
Route::post('/pool-tests/{pool_id}', [PoolTestController::class, 'store'])->name('pool-tests.store');

Route::get('/thermal-suites/create', [ThermalSuiteController::class, 'create'])->name('thermal-suites.create');
Route::post('/thermal-suites', [ThermalSuiteController::class, 'store'])->name('thermal-suites.store');

Route::get('/thermal-suites/check/{thermal_suite_id}', [ThermalSuiteCheckController::class, 'create'])->name('thermal_suite_checks.create');

//Route::get('/thermal-suites/check{thermal_suite_id}', [ThermalSuiteCheckController::class, 'create'])->name('thermal_suite_checks.create');
Route::post('/thermal-suites/check{thermal_suite_id}', [ThermalSuiteCheckController::class, 'store'])->name('thermal_suite_checks.store');


//Route::get('/thermal/check/view{ThermalID}', [ThermalCheckController::class, 'index'])->name('thermal.checks.index');
//Route::post('/thermal/check', [ThermalCheckController::class, 'store'])->name('thermal.checks.store');

Route::get('/bike-rental-orders', [BikeRentalOrderController::class, 'index'])->name('bike-rental-orders.index');
Route::post('/bike-rental-orders', [BikeRentalOrderController::class, 'store'])->name('bike-rental-orders.store');
Route::put('/bike-rental-orders/update/{id}', [BikeRentalOrderController::class, 'updateStatus'])->name('bike-rental-orders.update');

Route::get('/bike-locks', [BikeLockController::class, 'index'])->name('bike-locks.index');
Route::post('/bike-locks', [BikeLockController::class, 'store'])->name('bike-locks.store');
Route::put('/bike-locks/{lock}', [BikeLockController::class, 'updateBikeLockStatus'])->name('bike-locks.update');

Route::get('/bike-helmets', [BikeHelmetController::class, 'index'])->name('bike-helmets.index');
Route::post('/bike-helmets', [BikeHelmetController::class, 'store'])->name('bike-helmets.store');
Route::put('/bike-helmets/{helmet}', [BikeHelmetController::class, 'updateBikeHelmetStatus'])->name('bike-helmets.update');

Route::get('/bikes', [BikeRentalController::class, 'index'])->name('bikes.index');
Route::post('/bikes', [BikeRentalController::class, 'store'])->name('bikes.store');
Route::put('/bikes/{bike}', [BikeRentalController::class, 'updateBikeStatus'])->name('bikes.update');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create/', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store') ;

Route::get('/water-meter/readings/{water_meter_id?}', [WaterMeterReadingController::class, 'index'])->name('water-meter.readings.index');
Route::post('/water-meter/readings', [WaterMeterReadingController::class, 'store'])->name('water-meter.readings.store');

Route::get('water-meter-readings/view/{plantroomID}', [WaterMeterReadingController::class, 'index'])->name('water-meter-readings.index');
Route::get('/water-meter-readings/create/{plantroomID}', [WaterMeterReadingController::class, 'create'])->name('water-meter-readings.create');
Route::post('/water-meter-readings', [WaterMeterReadingController::class, 'store'])->name('water-meter-readings.store');

Route::get('/water-balance-checks/view/{poolID}', [WaterBalanceTestController::class, 'index'])->name('water-balance-checks.index');
Route::get('/water-balance-checks/create/{poolID}', [WaterBalanceTestController::class, 'create'])->name('water-balance-checks.create');
Route::post('/water-balance-checks', [WaterBalanceTestController::class, 'store'])->name('water-balance-checks.store');

Route::get('/pools/create/{clientID}', [PoolController::class, 'create'])->name('pools.create');
Route::post('/pools', [PoolController::class, 'store'])->name('pools.store');

//Route::get('/plantroom/create/{clientID}', [PlantroomController::class, 'create'])->name('plantroom.create');
//Route::post('/plantroom', [PlantroomController::class, 'store'])->name('plantroom.store');

//regularuser access but only if they are associated with the company
//Route::post('/water-balance-checks/waterBalanceTestForm', [WaterBalanceTestController::class, 'submitWaterTest'])->name('water_balance_checks.waterBalanceTestForm');

Route::post('/equipment-check', [EquipmentCheckController::class, 'store'])->name('equipment-check');
Route::get('/equipment-check', [EquipmentCheckController::class, 'index'])->name('equipment-check');

Route::get('/actionlog/{testId}', [ActionLogController::class, 'create'])->name('actionlog.create');
Route::post('/actionlog', [ActionLogController::class, 'store'])->name('actionlog.store');

//Route::get('/backwashes/view', [BackwashController::class, 'index'])->name('backwashes.index');
//Route::get('/backwashes/view/{poolID}', [BackwashController::class, 'index'])->name('backwashes.index');
//Route::get('/backwashes/create/{poolID}', [BackwashController::class, 'create'])->name('backwashes.create');
//Route::post('/backwashes', [BackwashController::class, 'store'])->name('backwashes.store');

Route::get('/pooltest', [PoolTestController::class, 'create'])->name('pooltest.create');
Route::post('/pooltest', [PoolTestController::class, 'store'])->name('pooltest.store');



Route::get('/dashboards/pooltests', [PoolTestController::class, 'pooltests'])->name('pooltests');


    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('/home', fn()=>view('dashboards.index'))->name('home');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');

