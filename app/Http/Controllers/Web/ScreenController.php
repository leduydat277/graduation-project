<?php
namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ScreenController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Screen/Index');
    }
}