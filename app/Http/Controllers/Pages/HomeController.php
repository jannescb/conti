<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;

class HomeController
{
    public function __invoke()
    {
        // return Inertia::render('Test/Content');

        return Inertia::render('Test/Test');
    }
}
