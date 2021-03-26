<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("logo");
            $table->string("address");
            $table->string("stamp");
            $table->timestamps();
        });

        Schema::create('college_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("college_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->foreign("college_id")->references("id")->on("colleges")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });

        Schema::create('college_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("college_id");
            $table->unsignedBigInteger("course_id");
            $table->timestamps();
            $table->foreign("college_id")->references("id")->on("colleges")->onDelete("cascade");
            $table->foreign("course_id")->references("id")->on("courses")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colleges');
    }
}
