<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['name' => 'Draft', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Published', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
