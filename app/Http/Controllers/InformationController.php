<?php

namespace App\Http\Controllers;

class InformationController extends Controller
{
    public function __invoke()
    {
        return inertia('Information');
    }
}
