<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollegeIdInCourseSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('college_id')->nullable(true);
            $table->foreign('college_id')->references('id')->on("colleges")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_subject', function (Blueprint $table) {
            //
        });
    }
}
