<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'name' => 'Class - 8',
        ]);
        DB::table('classes')->insert([
            'name' => 'Class - 9',
        ]);
        DB::table('classes')->insert([
            'name' => 'Class - 10',
        ]);
        DB::table('classes')->insert([
            'name' => 'Class - 11',
        ]);
        DB::table('classes')->insert([
            'name' => 'Class - 12',
        ]);
    }
}
