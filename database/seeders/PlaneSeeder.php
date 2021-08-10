<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plane::factory(5)->create();

    }
}
