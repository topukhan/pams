<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'type' => 'project',
            ],
            [
                'type' => 'thesis',
            ]
        ];
        try {
            foreach ($types as $type) {
                ProjectType::create([
                    'name' => $type['type'],
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
