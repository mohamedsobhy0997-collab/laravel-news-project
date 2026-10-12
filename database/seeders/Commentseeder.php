<?php

namespace Database\Seeders;

use App\Models\comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Commentseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        comment::factory()->count(200)->create();
    }
}
