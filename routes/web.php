<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractRoomController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequisiteController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamUserController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TenantController;
use Dompdf\Dompdf;
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

Route::domain('{team:alias}.public.' . env('APP_HOST'))->group(function () {
    Route::get('estates', [EstateController::class, 'publicIndex']);
    Route::get('estates/{estate}', [EstateController::class, 'publicShow']);
    Route::post('estates/{estate}', [EstateController::class, 'publicShow']);
    Route::get('estates/{estate}/rooms/{room}', [ApplicationController::class, 'create']);
    Route::post('estates/{estate}/rooms/{room}', [ApplicationController::class, 'store']);
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::middleware('socialite.driver')->group(function () {
        Route::get('login/{driver}', [LoginController::class, 'redirectToProvider']);
        Route::get('login/{driver}/callback', [LoginController::class, 'handleProviderCallback']);
    });
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('teams', TeamController::class)->only(['index', 'create', 'store']);
    Route::post('/teams/select', [TeamController::class, 'select']);

    Route::middleware('team')->group(function () {
        Route::get('/', [TeamController::class, 'show']);
        Route::resource('estates', EstateController::class);
        Route::resource('estates/{estate}/floors', FloorController::class);
        Route::resource('estates/{estate}/rooms', RoomController::class);
        Route::resource('tenants', TenantController::class);
        Route::resource('tenants/{tenant}/contracts', ContractController::class);
        Route::resource('bills', BillController::class)->only(['index']);
        Route::resource('tenants/{tenant}/bills', BillController::class)->only(['show', 'create', 'store', 'edit', 'update']);
        Route::post('tenants/{tenant}/bills/{bill}/act', [BillController::class, 'act']);
        Route::post('tenants/{tenant}/bills/{bill}/pay', [BillController::class, 'pay']);
        Route::resource('tenants/{tenant}/contractRooms', ContractRoomController::class);
        Route::resource('tenants/{tenant}/balances', BalanceController::class);
        Route::get('tenants/get/{inn?}', [TenantController::class, 'get']);
        Route::resource('requisites', RequisiteController::class);
        Route::resource('employees', TeamUserController::class);
        Route::resource('statements', StatementController::class);
        Route::resource('applications', ApplicationController::class);

        Route::resource('templates', TemplateController::class);
        Route::post('tenants/{tenant}/contracts/{contract}/export', [ContractController::class, 'export']);

        Route::get('tenants/export/debtor', [TenantController::class, 'debtorTenantsExport']);
        Route::get('contracts/export/active', [ContractController::class, 'activeContractsExport']);
        Route::post('tenants/{tenant}/export/revise', [BalanceController::class, 'reviseExport']);

        Route::post('invite', [InviteController::class, 'invite']);

        Route::get('floors/{floor}/rooms', [FloorController::class, 'rooms']);
        Route::post('rooms/floor_img', [RoomController::class, 'floor_img']);
        Route::post('contractRooms/floor_img', [ContractRoomController::class, 'floor_img']);
        Route::post('contractRooms/room_coordinates', [ContractRoomController::class, 'room_coordinates']);
        Route::post('contractRooms/rooms', [ContractRoomController::class, 'rooms']);
        Route::post('contractRooms/floors', [ContractRoomController::class, 'floors']);
    });

    Route::get('join', [InviteController::class, 'join'])->name('join');
});

Route::get('test', function () {
    dd(\App\Models\Tenant::find(1)->debt);
});