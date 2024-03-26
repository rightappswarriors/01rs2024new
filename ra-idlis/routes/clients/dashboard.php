<?php
use App\Http\Middleware\CustomAuthChecker;

Route::get(
    'dashboard', 
    'Client\ClientDashboardController@index'
)->middleware([CustomAuthChecker::class]);

Route::get(
    'dashboard/apply', 
    'Client\ClientDashboardController@apply'
)->middleware([CustomAuthChecker::class]);

Route::get(
    'dashboard/new-application/', 
    'Client\ClientDashboardController@newApplication'
)->middleware([CustomAuthChecker::class]);

Route::get(
    'dashboard/application/certificate-of-need/', 
    'Client\ClientDashboardController@newApplication'
)->middleware([CustomAuthChecker::class]);


Route::get(
    'dashboard/application/permit-to-construct/', 
    'Client\ClientDashboardController@permitToConstruct'
)->middleware([CustomAuthChecker::class]);

//my changes
Route::get('dashboard/application/authority-to-operate/', 
    'Client\ClientDashboardController@authorityToOperate'
)->middleware([CustomAuthChecker::class]);

Route::get('dashboard/application/certificate-of-accreditation/', 
    'Client\ClientDashboardController@certificateOfAccreditation'
)->middleware([CustomAuthChecker::class]);


Route::get('dashboard/application/license-to-operate/', 
    'Client\ClientDashboardController@licenseToOperate'
)->middleware([CustomAuthChecker::class]);


Route::get('dashboard/application/certificate-of-registration/', 
    'Client\ClientDashboardController@certificateOfRegistration'
)->middleware([CustomAuthChecker::class]);

//attachment
Route::get('dashboard/application/requirements/', 
    'Client\ClientDashboardController@requirement'
)->middleware([CustomAuthChecker::class]);