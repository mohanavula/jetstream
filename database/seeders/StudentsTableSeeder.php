<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Student;
use DateTime;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 0 -> regdno
        // 1 -> surname
        // 2 -> given_name
        // 3 -> join_year
        // 4 -> dob
        // 5 -> is_lateral_entry
        // 6 -> social_category
        // 7 -> admission_category
        // 8 -> gender
        // 9 -> specialization
        // 10 -> regulation
        // 11 -> 
        // 12 -> 

        $students = Excel::toCollection(null, storage_path('students.csv'))[0];
        $specialization = '';
        $specialization_id = '';
        $regulation = '';
        $regulation_id = '';
        $data = [];
        foreach ($students->splice(1) as $s) {
            if ($specialization != $s[9]) {
                $specialization = $s[9];
                $specialization_id = DB::table('specializations')->where('short_name', '=', $s[9])->get()[0]->id;
            }
            if ($regulation != $s[10]) {
                $regulation = $s[10];
                $regulation_id = DB::table('regulations')->where('short_name', '=', $s[10])->get()[0]->id;
            }
            // try {
            //     $student = new Student();
            //     $student->regdno = $s[0];
            //     $student->surname = $s[1];
            //     $student->given_name = $s[2];
            //     $student->email = $s[0] . '@ksrmce.ac.in';
            //     $student->dob = DateTime::createFromFormat('d-m-Y', $s[4])->format('Y-m-d');   //$s[4];
            //     $student->join_year = $s[3];
            //     $student->social_category = $s[6];
            //     $student->admission_category = $s[7];
            //     $student->gender = $s[8];
            //     $student->is_lateral_entry = $s[5];
            //     $student->specialization_id = $specialization_id;
            //     $student->regulation_id = $regulation_id;
            //     $student->created_at = now();
            //     $student->updated_at = now();
            //     $student->save();
            // } catch (\Exception $e) {
            //     echo $s[0] . "\n";
            // }

            array_push($data, [
                'regdno' => $s[0],
                'surname' => $s[1],
                'given_name' => $s[2],
                'join_year' => $s[3],
                'dob' => DateTime::createFromFormat('d-m-Y', $s[4])->format('Y-m-d'),
                'is_lateral_entry' => $s[5],
                'social_category' => $s[6],
                'admission_category' => $s[7],
                'gender' => $s[8],
                'specialization_id' => $specialization_id,
                'regulation_id' => $regulation_id,
                'email' => $s[0].'@ksrmce.ac.in',
            ]);
        }
        DB::table('students')->insert($data);
    }
}
