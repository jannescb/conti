<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Attribute;
use App\Models\Section;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Page::factory(1)
            ->has(Section::factory()->count(5), 'sections')
            ->create([
                'title' => 'Home'
            ]);
        Attribute::factory(10)->create();
    }
}
