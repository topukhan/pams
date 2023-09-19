<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $userData = [
                [
                    'first_name' => 'Ashikul Islam',
                    'last_name' => 'Khan Shishir',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081040@uttarauniversity.edu.bd',
                    'phone_number' => '01234567890',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Abdur Rahman',
                    'last_name' => 'Talha',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081041@uttarauniversity.edu.bd',
                    'phone_number' => '01234567891',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Hasibul',
                    'last_name' => 'Islam',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081042@uttarauniversity.edu.bd',
                    'phone_number' => '01234567892',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Tawhidul',
                    'last_name' => 'Islam',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081043@uttarauniversity.edu.bd',
                    'phone_number' => '01234567893',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Rezwana',
                    'last_name' => 'Karim',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081044@uttarauniversity.edu.bd',
                    'phone_number' => '01234567894',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Marium',
                    'last_name' => 'Akter',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081045@uttarauniversity.edu.bd',
                    'phone_number' => '01234567895',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Imam',
                    'last_name' => 'Hussain',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081046@uttarauniversity.edu.bd',
                    'phone_number' => '01234567896',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Jewel',
                    'last_name' => 'Mahmud',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081047@uttarauniversity.edu.bd',
                    'phone_number' => '01234567897',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Tofayel Ahmmad',
                    'last_name' => 'Topu',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081048@uttarauniversity.edu.bd',
                    'phone_number' => '01234567898',
                    'password' => Hash::make('12341234'),
                ],
                [
                    'first_name' => 'Synthia',
                    'last_name' => 'Islam',
                    'department' => 'CSE',
                    'role' => 'student',
                    'email' => '2193081049@uttarauniversity.edu.bd',
                    'phone_number' => '01234567899',
                    'password' => Hash::make('12341234'),
                ],
                // Add more user data here
            ];

            $studentData = [
                [
                    'student_id' => '2193081040',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081041',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081042',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081043',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081044',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081045',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081046',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081047',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081048',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                [
                    'student_id' => '2193081049',
                    'batch' => '49',
                    'section' => 'B',
                    'shift' => 'Day',
                ],
                // Add more student data here
            ];

            // Loop through user data and create users and students
            foreach ($userData as $index => $userDataItem) {
                $user = User::create($userDataItem);

                Student::create([
                    'user_id' => $user->id,
                    'student_id' => $studentData[$index]['student_id'],
                    'batch' => $studentData[$index]['batch'],
                    'section' => $studentData[$index]['section'],
                    'shift' => $studentData[$index]['shift'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
