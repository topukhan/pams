<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $domains = [
            [
                'name' => 'Image Processing',
            ],
            [
                'name' => 'Robotics',
            ],
            [
                'name' => 'Web Application Development',
            ],
            [
                'name' => 'Networking',
            ],
            [
                'name' => 'Artificial Intelligence',
            ],
            [
                'name' => 'Data Science',
            ],
        ];
        try {
            foreach ($domains as $domain) {
                Domain::create([
                    'name' => $domain['name'],
                ]);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
