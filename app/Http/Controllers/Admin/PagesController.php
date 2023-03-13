<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(Request $request)
    {
        return view('admin.pages.index');
    }
}
