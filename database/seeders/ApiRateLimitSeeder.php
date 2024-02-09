<?php

namespace Database\Seeders;

use App\Models\ApiRateLimit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiRateLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiRateLimit::create([
            'api_url' => 'https://dummyjson.com/quotes',
            'count' => 0,
            'limit_per_minute' => 30
        ]);
    }
}
