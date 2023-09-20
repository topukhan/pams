<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use App\Models\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $supervisors = [
                [
                    'first_name' => 'Tanjilla',
                    'last_name' => 'Wahid',
                    'department' => 'CSE',
                    'role' => 'supervisor',
                    'email' => '2192081040@uttarauniversity.edu.bd',
                    'phone_number' => '01234567890',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Samia',
                    'last_name' => 'Yasmin',
                    'department' => 'CSE',
                    'role' => 'supervisor',
                    'email' => '2192081041@uttarauniversity.edu.bd',
                    'phone_number' => '01234567891',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Nasrin',
                    'last_name' => 'Tumpa',
                    'department' => 'CSE',
                    'role' => 'supervisor',
                    'email' => '2192081042@uttarauniversity.edu.bd',
                    'phone_number' => '01234567892',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Shahrukh',
                    'last_name' => 'Omar',
                    'department' => 'CSE',
                    'role' => 'supervisor',
                    'email' => '2192081043@uttarauniversity.edu.bd',
                    'phone_number' => '01234567893',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Naznin Hossain',
                    'last_name' => 'Esha',
                    'department' => 'CSE',
                    'role' => 'supervisor',
                    'email' => '2192081044@uttarauniversity.edu.bd',
                    'phone_number' => '01234567894',
                    'password' => Hash::make('12341234'),
                ],

                // Add more supervisor data here
            ];

            $supervisorData = [
                [
                    'faculty_id' => '2192081040',
                    'designation' => 'Assistant Professor',
                    'availability' => false,
                ],
                [
                    'faculty_id' => '2192081041',
                    'designation' => 'Instructor',
                    'availability' => false,
                ],
                [
                    'faculty_id' => '2192081042',
                    'designation' => 'Assistant Professor',
                    'availability' => false,
                ],
                [
                    'faculty_id' => '2192081043',
                    'designation' => 'Associate Professo',
                    'availability' => false,
                ],
                [
                    'faculty_id' => '2192081044',
                    'designation' => 'Instructor',
                    'availability' => false,
                ],
            ];

            foreach ($supervisors as $index => $supervisor) {
                $user = User::create($supervisor);
        
                Supervisor::create([
                    'user_id' => $user->id,
                    'faculty_id' => $supervisorData[$index]['faculty_id'],
                    'designation' => $supervisorData[$index]['designation'],
                    'availability' => $supervisorData[$index]['availability'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
