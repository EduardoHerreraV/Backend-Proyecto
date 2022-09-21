<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const SQL_CODE_UNIQUE_VIOLATION = 23503;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
