<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = new \stdClass();
        $user->name = 'Inertia.js';
        $user->id = 1;
        return Inertia::render('Home', \compact('user'));
    }
}
