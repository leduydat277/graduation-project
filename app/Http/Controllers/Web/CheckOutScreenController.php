<?php

namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;

class CheckoutScreenController extends Controller
{
    public function index(): Response
    {
      return Inertia::render('CheckOut/Index');
    }

    
}
