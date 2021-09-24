<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Constants;

class AcademicTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Add category to Users table. Eg: Faculty, Student, Alumni, Admin
         */
        Schema::table('users', function(Blueprint $table) {
            $table->enum('category', ['FACULTY', 'STUDENT', 'ALUMNI', 'MANAGEMENT', 'ADMIN'])->nullable();
        });
        
        /**
         * Table to model Department. Eg: CE
         */
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->string('office_email', Constants::EMAIL_LENGTH);
            $table->string('hod_email', Constants::EMAIL_LENGTH);
            $table->json('info')->nullable();
            $table->timestamps();
        });

        /**
         * Table to model Program level. Eg: UG
         */
        Schema::create('program_levels', function (Blueprint $table) {
            $table->id();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->timestamps();
        });

        /**
         * Table to model Program. Eg: B.Tech
         */
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_level_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->json('pos')->nullable();
            $table->timestamps();
        });

        /**
         * Table to model Specialization (Branch). Eg: Civil Engineering
         */
        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('program_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->boolean('in_force')->default(false);
            $table->timestamps();
        });

        /**
         * Table to model Regulation. Eg: R14UG
         */
        Schema::create('regulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('name', Constants::TITLE_LENGTH);
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->unsignedBigInteger('total_semesters');
            $table->unsignedBigInteger('total_credits');
            $table->unsignedDecimal('pass_cgpa');
            $table->boolean('in_force')->default(false);
            $table->timestamps();
        });

        /**
         * Table to model Semester. Eg: First Semester
         */
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regulation_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH);
            $table->string('name', Constants::TITLE_LENGTH);
            $table->unsignedBigInteger('semester_number');
            $table->boolean('in_force')->default(false);
            $table->unique(['regulation_id', 'semester_number']);
            $table->timestamps();
        });

        /**
         * Table to model Subject. Eg: Engineering Mechanics
         */
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->string('subject_code', Constants::TITLE_SHORT_LENGTH)->unique();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH);
            $table->string('name', Constants::TITLE_LENGTH);
            $table->boolean('is_theory')->default(true);
            $table->boolean('is_lab')->default(false);
            $table->boolean('is_project')->default(false);
            $table->json('cos')->nullable();
            $table->json('mapping')->nullable();
            $table->json('syllabus')->nullable();
            $table->timestamps();
        });

        /**
         * Table to model Syllabus.
         */
        // Schema::create('syllabus', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->longText('excerpt');
        //     $table->longText('objectives');
        //     $table->longText('cos');
        //     $table->longText('syllabus');
        //     $table->longText('textbooks');
        //     $table->longText('reference_books');
        //     $table->unsignedBigInteger('subject_id');
        //     $table->timestamps();
        //     $table->foreign('subject_id', 'f_syllabus_subject_id')
        //         ->references('id')
        //         ->on('subjects')
        //         ->onDelete('cascade');
        // });

        /**
         * Table to model Subject offering type. Eg: Core
         */
        Schema::create('subject_offering_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->unique();
            $table->timestamps();
        });

        /**
         * Table to model subject category. Eg: PCC
         */
        Schema::create('subject_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regulation_id')->constrained();
            $table->string('short_name', Constants::TITLE_SHORT_LENGTH);
            $table->string('name', Constants::TITLE_LENGTH);
            $table->unique(['regulation_id', 'short_name']);
            $table->timestamps();
        });

        /**
         * Table to model curriculum. This is master table
         */
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->foreignId('subject_category_id')->constrained();
            $table->foreignId('subject_offering_type_id')->constrained();
            $table->unsignedInteger('lectures');
            $table->unsignedInteger('tutorials');
            $table->unsignedInteger('practicals');
            $table->unsignedInteger('internal_exam_marks');
            $table->unsignedInteger('end_exam_marks');
            $table->unsignedInteger('credits');
            $table->unsignedBigInteger('sequence_number');
            $table->timestamps();
        });

        /**
         * Table to model curriculum. This is join table b/w curriculum and subjects
         */
        Schema::create('curriculum_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curriculum_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->unique(['curriculum_id', 'subject_id']);
            $table->timestamps();
        });
                
        /**
         * Table to model feedback on Subject. Eg. Reviews, ratings
         */
        Schema::create('subject_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained();
            $table->json('data'); // keys: review, rating, email
            $table->unsignedFloat('rating');
            $table->timestamps();
        });
        
        /**
         * Table to model feedback on Regulation. Eg. Reviews, ratings
         */
        Schema::create('regulation_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regulation_id')->constrained();
            $table->json('data'); // keys: review, rating, email
            $table->unsignedFloat('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::dropIfExists('departments');
        Schema::dropIfExists('program_levels');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('regulations');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('subject_offering_types');
        Schema::dropIfExists('subject_categories');
        Schema::dropIfExists('curricula');
        Schema::dropIfExists('curriculum_subject');
        Schema::dropIfExists('subject_reviews');
        Schema::dropIfExists('regulation_reviews');
    }
}
