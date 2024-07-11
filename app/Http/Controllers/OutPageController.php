<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutPageController extends Controller
{
    public function index()
    {
        return view("pages.out-page");
    }
}