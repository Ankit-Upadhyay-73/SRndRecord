<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer("duration")->default(NULL);
            $table->timestamps();
        });

        Schema::create('course_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        Schema::create('course_user', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('courses');
    }
}
