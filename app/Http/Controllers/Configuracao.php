<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Configuracao extends Controller
{
    public function chekUser(){
        $user = Auth::user();
    }
}
