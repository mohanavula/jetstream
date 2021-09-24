<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * table: program_levels
         */
        $ug_id = DB::table('program_levels')->insertGetId([
            'short_name' => 'UG', 'name' => 'Undergraduate',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pg_id = DB::table('program_levels')->insertGetId([
            'short_name' => 'PG', 'name' => 'Postgraduate',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        /**
         * table: programs
         */
        $btech_id = DB::table('programs')->insertGetId([
            'program_level_id' => $ug_id,
            'short_name' => 'BTech',
            'name' => 'Bachelor of Technology',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $mtech_id = DB::table('programs')->insertGetId([
            'program_level_id' => $pg_id,
            'short_name' => 'MTech',
            'name' => 'Master of Technology',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /**
         * table: regulations
         */
        $r15ug_id = DB::table('regulations')->insertGetId([
            'program_id' => $btech_id,
            'short_name' => 'R15UG',
            'name' => 'Regulations for UG Programs in Engineering (2015)',
            'start_year' => 2015,
            'total_semesters' => 8,
            'total_credits' => 160,
            'pass_cgpa' => 4.5,
            'in_force' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $r15pg_id = DB::table('regulations')->insertGetId([
            'program_id' => $mtech_id,
            'short_name' => 'R15PG',
            'name' => 'Regulations for PG Programs in Engineering (2015)',
            'start_year' => 2015,
            'total_semesters' => 4,
            'total_credits' => 60,
            'pass_cgpa' => 4.5,
            'in_force' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $r18ug_id = DB::table('regulations')->insertGetId([
            'program_id' => $btech_id,
            'short_name' => 'R18UG',
            'name' => 'Regulations for UG Programs in Engineering (2018)',
            'start_year' => 2018,
            'total_semesters' => 8,
            'total_credits' => 160,
            'pass_cgpa' => 4.5,
            'in_force' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $r18pg_id = DB::table('regulations')->insertGetId([
            'program_id' => $mtech_id,
            'short_name' => 'R18PG',
            'name' => 'Regulations for PG Programs in Engineering (2018)',
            'start_year' => 2018,
            'total_semesters' => 4,
            'total_credits' => 60,
            'pass_cgpa' => 4.5,
            'in_force' => true
        ]);

        $r20ug_id = DB::table('regulations')->insertGetId([
            'program_id' => $btech_id,
            'short_name' => 'R20UG',
            'name' => 'Regulations for UG Programs in Engineering (2020)',
            'start_year' => 2020,
            'total_semesters' => 8,
            'total_credits' => 160,
            'pass_cgpa' => 4.5,
            'in_force' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /**
         * table: semesters
         */
        
        $data = [
            // R15UG - B.Tech
            ['regulation_id' => $r15ug_id, 'short_name' => '1 Sem', 'name' => 'First Semester', 'semester_number' => 1, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '2 Sem', 'name' => 'Second Semester', 'semester_number' => 2, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '3 Sem', 'name' => 'Third Semester', 'semester_number' => 3, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '4 Sem', 'name' => 'Fourth Semester', 'semester_number' => 4, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '5 Sem', 'name' => 'Fifth Semester', 'semester_number' => 5, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '6 Sem', 'name' => 'Sixth Semester', 'semester_number' => 6, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '7 Sem', 'name' => 'Seventh Semester', 'semester_number' => 7, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15ug_id, 'short_name' => '8 Sem', 'name' => 'Eighth Semester', 'semester_number' => 8, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            
            // R15PG - M.Tech
            ['regulation_id' => $r15pg_id, 'short_name' => '1 Sem', 'name' => 'First Semester', 'semester_number' => 1, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15pg_id, 'short_name' => '2 Sem', 'name' => 'Second Semester', 'semester_number' => 2, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15pg_id, 'short_name' => '3 Sem', 'name' => 'Third Semester', 'semester_number' => 3, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r15pg_id, 'short_name' => '4 Sem', 'name' => 'Fourth Semester', 'semester_number' => 4, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],

            // R18UG - B.Tech
            ['regulation_id' => $r18ug_id, 'short_name' => '1 Sem', 'name' => 'First Semester', 'semester_number' => 1, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '2 Sem', 'name' => 'Second Semester', 'semester_number' => 2, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '3 Sem', 'name' => 'Third Semester', 'semester_number' => 3, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '4 Sem', 'name' => 'Fourth Semester', 'semester_number' => 4, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '5 Sem', 'name' => 'Fifth Semester', 'semester_number' => 5, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '6 Sem', 'name' => 'Sixth Semester', 'semester_number' => 6, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '7 Sem', 'name' => 'Seventh Semester', 'semester_number' => 7, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18ug_id, 'short_name' => '8 Sem', 'name' => 'Eighth Semester', 'semester_number' => 8, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],

            // R18PG - M.Tech
            ['regulation_id' => $r18pg_id, 'short_name' => '1 Sem', 'name' => 'First Semester', 'semester_number' => 1, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18pg_id, 'short_name' => '2 Sem', 'name' => 'Second Semester', 'semester_number' => 2, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18pg_id, 'short_name' => '3 Sem', 'name' => 'Third Semester', 'semester_number' => 3, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r18pg_id, 'short_name' => '4 Sem', 'name' => 'Fourth Semester', 'semester_number' => 4, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // R20UG - B.Tech
            ['regulation_id' => $r20ug_id, 'short_name' => '1 Sem', 'name' => 'First Semester', 'semester_number' => 1, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '2 Sem', 'name' => 'Second Semester', 'semester_number' => 2, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '3 Sem', 'name' => 'Third Semester', 'semester_number' => 3, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '4 Sem', 'name' => 'Fourth Semester', 'semester_number' => 4, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '5 Sem', 'name' => 'Fifth Semester', 'semester_number' => 5, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '6 Sem', 'name' => 'Sixth Semester', 'semester_number' => 6, 'in_force' => false, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '7 Sem', 'name' => 'Seventh Semester', 'semester_number' => 7, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
            ['regulation_id' => $r20ug_id, 'short_name' => '8 Sem', 'name' => 'Eighth Semester', 'semester_number' => 8, 'in_force' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('semesters')->insert($data);


        /**
         * table: departments
         */
        $data = [
            ['short_name' => 'CED', 'name' => 'Civil Engineering Department', 'office_email' => 'office.ce@ksrmce.ac.in', 'hod_email' => 'hod.ce@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'EEED', 'name' => 'Electrical and Electronics Engineering Department', 'office_email' => 'office.eee@ksrmce.ac.in', 'hod_email' => 'hod.eee@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'ECED', 'name' => 'Electronics and Communications Engineering Department', 'office_email' => 'office.ece@ksrmce.ac.in', 'hod_email' => 'hod.ece@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'MED', 'name' => 'Mechanical Engineering Department', 'office_email' => 'office.me@ksrmce.ac.in', 'hod_email' => 'hod.me@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'CSED', 'name' => 'Computer Science and Engineering Department', 'office_email' => 'office.cse@ksrmce.ac.in', 'hod_email' => 'hod.cse@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'CRI', 'name' => 'Center for Research and Innovation', 'office_email' => 'cri@ksrmce.ac.in', 'hod_email' => 'cri@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()],
            ['short_name' => 'HSD', 'name' => 'Humanities and Sciences Department', 'office_email' => 'office.hs@ksrmce.ac.in', 'hod_email' => 'hod.hs@ksrmce.ac.in', 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('departments')->insert($data);

        /**
         * table: subject_offering_types
         */

        $data = [
            ['type_name' => 'CORE', 'created_at' => now(), 'updated_at' => now()],
            ['type_name' => 'ELECTIVE', 'created_at' => now(), 'updated_at' => now()],
            ['type_name' => 'AUDIT', 'created_at' => now(), 'updated_at' => now()],
            ['type_name' => 'MANDATORY', 'created_at' => now(), 'updated_at' => now()],
            ['type_name' => 'SKILL', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('subject_offering_types')->insert($data);

        /**
         * table: subjects
         */
        

        /**
         * table: specializations
         */
        $data = [
            ['CE', 'Civil Engineering', 'CED', 'BTech', true, 1980],
            ['EEE', 'Electrical and Electronics Engineering', 'EEED', 'BTech', true, 1980],
            ['ECE', 'Electronics and Comminications Engineering', 'ECED', 'BTech', true, 1980],
            ['ME', 'Mechanical Engineering', 'MED', 'BTech', true, 1980],
            ['CSE', 'Computer Science and Engineering', 'CSED', 'BTech', true, 1980],
            ['AIML', 'Artificial Intelligence and Machine Learning', 'CSED', 'BTech', true, 2021]
        ];
        $dept = '';
        $dept_id = '';
        $prog = '';
        $prog_id = '';
        foreach($data as $d) {
            if ($dept != $d[2]) {
                $dept_id = DB::table('departments')->where('short_name', '=', $d[2])->get()[0]->id;
            };
            if ($prog != $d[3]) {
                $prog_id = DB::table('programs')->where('short_name', '=', $d[3])->get()[0]->id;
            };
            DB::table('specializations')->insert([
                'short_name' => $d[0],
                'name' => $d[1],
                'department_id' => $dept_id,
                'program_id' => $prog_id,
                'in_force' => $d[4],
                'start_year' => $d[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        
        /**
         * table: subject_categories
         */
        $data = [
            ['R15UG', 'BS', 'Basic sciences'],
            ['R15UG', 'ED', 'Engineering design'],
            ['R15UG', 'HS', 'Humanities and social sciences'],
            ['R15UG', 'PJ', 'Professional major'],
            ['R15UG', 'PN', 'Professional minor'],
            ['R18UG', 'BSC', 'Basic Sciences'],
            ['R18UG', 'ESC', 'Engineering Sciences'],
            ['R18UG', 'HSMS', 'Humanities and social sciences'],
            ['R18UG', 'PCC', 'Professional Core'],
            ['R18UG', 'PEC', 'Professional elective'],
            ['R18UG', 'OEC', 'Open elective'],
            ['R18UG', 'MC', 'Mandatory'],
            ['R18UG', 'PROJ', 'Project']
        ];
        $r = '';
        $r_id ='';
        foreach($data as $d) {
            if ($r != $d[0]) {
                $r = $d[0];
                $r_id = DB::table('regulations')->where('short_name', '=', $d[0])->get()[0]->id;
            }
            DB::table('subject_categories')->insert([
                'regulation_id' => $r_id,
                'short_name' => $d[1],
                'name' => $d[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        /**
         * table: subjects
         */
        $subjects = Excel::toCollection(null, storage_path('subjects.csv'))[0];
        $dept = '';
        $dept_id = '';
        foreach($subjects->splice(1) as $s) {
            if ($dept != $s[3]) {
                $dept = $s[3];
                $dept_id = DB::table('departments')->where('short_name', '=', $s[3])->get()[0]->id;
            }
            DB::table('subjects')->insert([
                'subject_code' => $s[0],
                'short_name' => $s[1],
                'name' => $s[2],
                'department_id' => $dept_id,
                'is_theory' => $s[4],
                'is_lab' => $s[5],
                'is_project' => $s[6],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /**
         * table: curricula
         */
        $curriculum = Excel::toCollection(null, storage_path('curriculum.csv'))[0];
        $specialization = '';
        $specialization_id = '';
        $semester = '';
        $semester_id ='';
        $subject_categoty = '';
        $subject_categoty_id = '';
        $subject_offering_type = '';
        $subject_offering_type_id = '';
        $regulation = '';
        $r_id = '';
 
        foreach ($curriculum->splice(1) as $c) {
            try {
                if ($regulation != $c[1]) {
                    $regulation = $c[1];
                    $r_id = DB::table('regulations')->where('short_name', '=', $c[1])->get()[0]->id;
                }

                if ($specialization != $c[0]) {
                    $specialization = $c[0];
                    $specialization_id = DB::table('specializations')->where('short_name', '=', $c[0])->get()[0]->id;
                }
                if ($semester != $c[2]) {
                    $semester = $c[2];
                    $semester_id = DB::table('semesters')->where('regulation_id', '=', $r_id)->where('semester_number', '=', $c[2])->get()[0]->id;
                }

                if ($subject_categoty != $c[3]) {
                    $subject_categoty = $c[3];
                    $subject_categoty_id = DB::table('subject_categories')->where('regulation_id', '=', $r_id)->where('short_name', '=', $c[3])->get()[0]->id;
                }

                if ($subject_offering_type != $c[4]) {
                    $subject_offering_type = $c[4];
                    $subject_offering_type_id = DB::table('subject_offering_types')->where('type_name', '=', $c[4])->get()[0]->id;
                }

                DB::table('curricula')->insert([
                    'specialization_id' => $specialization_id,
                    'semester_id' => $semester_id,
                    'subject_category_id' => $subject_categoty_id,
                    'subject_offering_type_id' => $subject_offering_type_id,
                    'lectures' => $c[5],
                    'tutorials' => $c[6],
                    'practicals' => $c[7],
                    'internal_exam_marks' => $c[8],
                    'end_exam_marks' => $c[9],
                    'credits' => $c[10],
                    'sequence_number' => $c[11],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                echo $c[0] . "\n";
            }
        }

        /**
         * join table: curriculum_subject
         */

        $curriculum_subject = Excel::toCollection(null, storage_path('curriculum-subjects.csv'))[0];
        $specialization = '';
        $specialization_id = '';
        $semester = '';
        $semester_id ='';
        $regulation = '';
        $r_id = '';
        foreach($curriculum_subject->splice(1) as $cs) {
            if ($regulation != $cs[1]) {
                $regulation = $cs[1];
                $r_id = DB::table('regulations')->where('short_name', '=', $cs[1])->get()[0]->id;
            }
            if ($specialization != $cs[0]) {
                $specialization = $cs[0];
                $specialization_id = DB::table('specializations')->where('short_name', '=', $cs[0])->get()[0]->id;
            }
            if ($semester != $cs[2]) {
                $semester = $cs[2];
                $semester_id = DB::table('semesters')->where('regulation_id', '=', $r_id)->where('semester_number', '=', $cs[2])->get()[0]->id;
            }

            $curriculum_id = DB::table('curricula')->where('specialization_id', '=', $specialization_id)
                ->where('semester_id', '=', $semester_id)
                ->where('sequence_number', '=', $cs[3])
                ->get()[0]->id;
            $subject_id = DB::table('subjects')->where('subject_code', '=', $cs[4])->get()[0]->id;

            DB::table('curriculum_subject')->insert([
                'curriculum_id' => $curriculum_id,
                'subject_id' => $subject_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
