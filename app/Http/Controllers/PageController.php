<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string',
            'route'   => 'required|string',
            'content' => 'sometimes',
        ]);

        Page::updateOrCreate([
            'name' => $validated['name'],
        ], [
            'content' => $validated['content'],
        ]);

        return Redirect::route($validated['route']);
    }
}
