<?php

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use App\Models\Section;
use Inertia\Inertia;

class HomeController
{
    public function __invoke()
    {
        return Inertia::render('Home/Home', [
            'sections' => [
                [
                    'type'        => 'text',
                    'class'       => Section::class,
                    'parent_id'   => 1,
                    'parent_type' => Page::class,
                    'attributes'  => [
                        [
                            'type'  => 'text',
                            'key'   => 'text',
                            'value' => null,
                        ],
                    ],
                ],
                [
                    'type'        => 'quote',
                    'class'       => Section::class,
                    'parent_id'   => 1,
                    'parent_type' => Page::class,
                    'attributes'  => [
                        [
                            'type'  => 'text',
                            'key'   => 'author',
                            'value' => null,
                        ],
                        [
                            'type'  => 'text',
                            'key'   => 'quote',
                            'value' => 'default value',
                        ],
                    ],
                ],
            ],
            'content' => Page::first()->getContent(),
        ]);
    }
}
