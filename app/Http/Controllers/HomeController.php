<?php
// ============================================================
// app/Http/Controllers/HomeController.php
// ============================================================
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $cars = Car::with(['user', 'tags'])->latest()->paginate(12);
        } else {
            $cars = Car::with(['user', 'tags'])->latest()->take(6)->get();
        }
        return view('home', compact('cars'));
    }
}
