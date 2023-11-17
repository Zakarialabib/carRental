<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke()
    {
        return view('admin.sections.index');
    }
}
