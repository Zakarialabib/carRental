<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    /** Handle the incoming request. */
    public function __invoke(Request $request)
    {
        // return view('front.index');
        return view('front.index');
    }
}
