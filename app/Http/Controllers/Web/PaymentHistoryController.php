<?php

namespace App\Http\Controllers\Web;

use App\Models\Review;
use App\Models\Room;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;

class PaymentHistoryController extends Controller
{
    public function index(): Response
    {
       
        return Inertia::render('PaymentHistory/Index', [
           
        ]);
    }
}