<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function viewError()
    {
        return view("system.errors.no-data");
    }
}
