<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackLectureVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_lecture_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('time_in_seconds')->default('0');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('curriculam_lecture_id')->nullable();
            $table->foreign('curriculam_lecture_id')->references('id')->on('curriculam_lectures');
            $table->foreign('student_id')->references('id')->on('users');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->enum('is_fully_watched', ['0', '1'])->default('0');
            $table->softDeletes();
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
        Schema::dropIfExists('track_lecture_videos');
    }
}
