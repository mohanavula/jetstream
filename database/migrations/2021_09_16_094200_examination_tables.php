<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Constants;

class ExaminationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Table to model Designations. Eg: Assistant Professor
         */
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->timestamps();
        });

        /**
         * Table to model Faculty.
         */
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', Constants::REGDNO_LENGTH)->unique();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('designation_id')->constrained();
            $table->string('surname', Constants::TITLE_LENGTH);
            $table->string('given_name', Constants::TITLE_LENGTH);
            $table->string('email', Constants::EMAIL_LENGTH)->unique();
            $table->string('phone', Constants::PHONE_LENGTH)->unique();
            $table->enum('gender', ['FEMALE', 'MALE','OTHER']);
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        /**
         * Table to model Student.
         */
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('regulation_id')->constrained();
            $table->string('regdno', Constants::REGDNO_LENGTH)->unique();
            $table->string('surname', Constants::TITLE_LENGTH);
            $table->string('given_name', Constants::TITLE_LENGTH);
            $table->string('email', Constants::EMAIL_LENGTH)->unique();
            $table->string('phone', Constants::PHONE_LENGTH)->unique()->nullable();
            $table->date('dob')->nullable();
            $table->year('join_year');
            $table->enum('social_category', ['OC', 'BC-A', 'BC-B', 'BC-C', 'BC-D', 'BC-E', 'EWS', 'SC', 'ST', 'OTHER']);
            $table->enum('admission_category', ['CONVENER', 'MANAGEMENT', 'SPOT', 'OTHER']);
            $table->enum('residency', ['HOSTEL', 'DAYS'])->nullable();
            $table->enum('gender', ['FEMALE', 'MALE','OTHER']);
            $table->boolean('is_lateral_entry')->default(false);
            $table->timestamps();
        });

        /**
         * Table to model AcademicClass. Eg: 2020-21-R18UG-5-Sem-CE
         */
        Schema::create('academic_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->year('academic_year');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->unique(['academic_year', 'semester_id'], 'u_academic_classes');
        });

        /**
         * Table to model AcademicClassSection. Eg: 2020-21-R18UG-5-Sem-CE-A
         */
        Schema::create('academic_class_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_id')->constrained();
            $table->foreignId('specialization_id')->constrained();
            $table->enum('section', ['A', 'B', 'C', 'D']);
            $table->timestamps();
            $table->unique(['academic_class_id', 'specialization_id', 'section'], 'u_academic_class_sections');
        });

        /**
         * Table to model class enrollment.
         */
        Schema::create('enrollments', function(Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_section_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->date('join_date')->nullable();
            $table->timestamps();
            $table->unique(['academic_class_section_id', 'student_id'], 'u_enrollments');
        });

        /**
         * Table to model subject allocation.
         */
        Schema::create('subject_allocations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('academic_class_section_id')->constrained();
            $table->foreignId('faculty_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->date('from_date')->nullable();
            $table->timestamps();
            $table->unique(['academic_class_section_id', 'faculty_id', 'subject_id'], 'u_subject_allocations');
        });

        /**
         * Table to model Exam. Eg: R18UG-Regular-Exams-of-Nov-2020
         */
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->year('academic_year');
            $table->enum('exam_category', ['REGULAR', 'SUPPLEMENTARY', 'MIDTERM']);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        /**
         * Table to model ExamSchedule.
         */
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->date('schedule_date');
            $table->date('exam_date')->nullable();
            $table->timestamps();
            $table->unique(['exam_id', 'subject_id']);
        });

        /**
         * Table to model ExamRegistrationMarks.
         */
        Schema::create('exam_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_schedule_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->boolean('attended_exam')->nullable();
            $table->unsignedBigInteger('marks')->nullable();
            $table->timestamps();
            $table->unique(['exam_schedule_id', 'student_id']);
        });

        /**
         * Table to model Internal Examination marks
         */
        Schema::create('internal_exam_marks', function(Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->unsignedBigInteger('internal_marks');
            $table->timestamps();
            $table->unique(['student_id', 'subject_id']);
        });

        /**
         * Table to model End Examination marks
         */
        Schema::create('end_exam_marks', function(Blueprint $table) {
            $table->id('id');
            $table->foreignId('exam_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->unsignedBigInteger('end_exam_marks');
            $table->unique(['exam_id', 'student_id', 'subject_id'], 'u_end_exam_marks');
        });

        /**
         * Table to model StatsGrade.
         */
        Schema::create('stats_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->unsignedBigInteger('internal_marks');
            $table->unsignedBigInteger('end_exam_marks');
            $table->unsignedBigInteger('credits');
            $table->string('grade', 2);
            $table->boolean('passed');
            $table->timestamps();
            $table->unique(['student_id', 'subject_id']);
        });

        /**
         * Table to model StatsGPA.
         */
        Schema::create('stats_gpas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->unsignedDouble('sgpa');
            $table->unsignedDouble('cgpa');
            $table->unsignedDouble('semester_credits');
            $table->unsignedDouble('cumulative_credits');
            $table->timestamps();
            $table->unique(['semester_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
        Schema::dropIfExists('faculties');
        Schema::dropIfExists('students');
        Schema::dropIfExists('academic_classes');
        Schema::dropIfExists('academic_class_sections');
        Schema::dropIfExists('enrollments');
        Schema::dropIfExists('subject_allocations');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('exam_schedules');
        Schema::dropIfExists('exam_registrations');
        Schema::dropIfExists('internal_exam_marks');
        Schema::dropIfExists('end_exam_marks');
        Schema::dropIfExists('stats_grades');
        Schema::dropIfExists('stats_gpas');
    }
}
