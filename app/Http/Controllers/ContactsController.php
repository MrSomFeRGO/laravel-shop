<?php

namespace App\Http\Controllers;

class ContactsController extends Controller
{
    public function __invoke()
    {
        return inertia('Contacts');
    }
}
