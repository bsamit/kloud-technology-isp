<?php

use Illuminate\Support\Facades\Route;
use Modules\HR\App\Http\Controllers\HRController;
use Modules\HR\App\Http\Controllers\RoleController;
use Modules\HR\App\Http\Controllers\StaffController;


Route::group([], function () {
    Route::resource('hr', HRController::class)->names('hr');
});

Route::group(['prefix'=> 'human-resources', 'as' => 'human-resources.', 'middleware' => ['auth']], function ($groupRoutes)  {

    $groupRoutes->controller(StaffController::class)->group(function ($routes) {
        $routes->get('/manage-staff/index', 'index')->name('manage-staff.index');
        $routes->get('/manage-staff/create', 'create')->name('manage-staff.create');
        $routes->post('/manage-staff/store', 'store')->name('manage-staff.store');
        $routes->get('/manage-staff/{id}/edit', 'edit')->name('manage-staff.edit');
        $routes->post('/manage-staff/{id}', 'update')->name('manage-staff.update');
        $routes->get('manage-staff/{id}/delete', 'destroy')->name('manage-staff.delete');
    });

    $groupRoutes->controller(RoleController::class)->group(function ($routes) {
        $routes->get('/role', 'index')->name('role.index');
        $routes->post('/role-store', 'store')->name('role.store');
        $routes->get('/role/{id}', 'edit')->name('role.edit');
        $routes->post('/role-update', 'update')->name('role.update');
        
        $routes->get('/roles/{roleId}/give-permissions', 'addPermissionToRole')->name('role.permissions');
        $routes->post('/roles/assign-permissions', 'givePermissionToRole')->name('role.givePermissionToRole');
        $routes->post('/users/assign-role-to-user', 'assignRoleToUser')->name('role.assignRoleToUser');
    });
});
