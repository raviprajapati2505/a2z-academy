<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculamLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculam_lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('video')->nullable();
            $table->string('display_order')->nullable();
            $table->text('description')->nullable();
            $table->enum('is_free', ['0', '1'])->default('0');
            $table->string('duration_in_hour')->nullable();
            $table->string('duration_in_seconds')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('course_curriculam_id')->nullable();
            $table->foreign('course_curriculam_id')->references('id')->on('course_curriculams');
            $table->enum('status', ['Enabled', 'Disabled'])->default('Enabled');
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
        Schema::dropIfExists('curriculam_lectures');
    }
}
