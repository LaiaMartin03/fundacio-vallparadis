<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlackboardController extends Controller
{
    public function index()
    {
        return view('blackboard.index'); // En lugar de 'blackboard.index'
    }
}
