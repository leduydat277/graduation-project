<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ScreenController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Screen/Index');
    }
}
