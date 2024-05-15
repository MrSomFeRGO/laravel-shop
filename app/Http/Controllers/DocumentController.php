<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DocumentController extends Controller
{
    public function __invoke($filename)
    {
        abort_if(auth()->id() != 1, Response::HTTP_FORBIDDEN);
        $path = "docs/$filename";
        return response()->download($path);
    }
}
