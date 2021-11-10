<?php

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use Inertia\Inertia;

class HomeController
{
    public function __invoke()
    {
        return Inertia::render('Test/Test', [
            'page'      => Page::where('name', 'Home')->first(),
            'relations' => [
                Page::class => Page::all()->mapWithKeys(function ($page) {
                    return [
                        $page->id => $page->name,
                    ];
                })->toArray(),
            ],
        ]);
    }
}
