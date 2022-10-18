<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function me(){
        return[
            'NIS' => 3103120161,
            'Nama' => 'Nayla Rahma',
            'Phone' => '08818779205'
        ];
    }
}