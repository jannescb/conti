<?php

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use Inertia\Inertia;

class HomeController
{
    public function __invoke()
    {
        $page = Page::where('name', 'Home')->with('files')->first();

        return Inertia::render('Test/Test', [
            'page'      => $page,
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
