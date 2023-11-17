<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CarsController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke()
    {
        return view('admin.cars.index');
    }
}
