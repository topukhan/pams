<?php

namespace Database\Seeders;

use App\Models\Coordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'first_name' => 'Md. Torikur',
                'last_name' => 'Rahman',
                'department' => 'CSE',
                'phone_number' => '01234567895',
                'role' => 'coordinator',
                'email' => 'coordinator@gmail.com',
                'password' => Hash::make('12345678')
            ]);

            Coordinator::create([
                'user_id' => $user->id,
                'faculty_id' => '2191081040',
                'designation' => 'Associate Professor',
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
