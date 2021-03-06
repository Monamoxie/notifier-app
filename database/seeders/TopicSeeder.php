<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::insert([
            [
                'topic' => 'technology' 
            ],
            [
                'topic' => 'gender-equality'
            ],
            [
                'topic' => 'agriculture'
            ],
            [
                'topic' => 'business'
            ],
            [
                'topic' => 'world-peace'
            ]
        ]);
    }
}
