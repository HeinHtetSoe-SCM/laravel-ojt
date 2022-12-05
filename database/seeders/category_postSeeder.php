<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category_post;
use Illuminate\Support\Facades\DB;

class category_postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_posts')->insert([
            'category_id' => 1,
            'post_id' => 1
        ]);
    }
}
