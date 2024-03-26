<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/employee/',
        'employee/dashboard/processflow/assessment/*',
        'employee/forgot',
        'employee/dashboard/processflow/assessment',
        'employee/dashboard/processflow/parts/*',
        'employee/dashboard/processflow/HeaderOne/*',
        'employee/dashboard/processflow/HeaderTwo/*',
        'employee/dashboard/processflow/HeaderThree/*',
        'employee/dashboard/processflow/ShowAssessments/*',
        'employee/dashboard/processflow/SaveAssessmentsMobile/*',
        'employee/dashboard/processflow/parts/{appid}/{montype?}*',
        'employee/dashboard/processflow/HeaderOne/*',
        'employee/dashboard/processflow/HeaderTwo/*',
        'employee/dashboard/processflow/HeaderThree/*',
        'employee/dashboard/processflow/ShowAssessments/*',
        'employee/dashboard/processflow/evaluation/*',
        'employee/dashboard/processflow/floorPlan/*',
        'employee/forMobile/*',
        'employee/dashboard/processflow/SaveInspection/Mobile',
        'employee/dashboard/others/monitoring/mobile/inspection/*'
    ];
}
