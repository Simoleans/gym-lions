<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name'              => 'Plan Novato',
            'classes_per_month' => 12,
            'price'             => 15.00,
        ]);

        Plan::create([
            'name'              => 'Plan Intermedio',
            'classes_per_month' => 20,
            'price'             => 20.00,
        ]);

        Plan::create([
            'name'              => 'Plan Full',
            'classes_per_month' => 20,
            'price'             => 40.00,
        ]);
    }
}
