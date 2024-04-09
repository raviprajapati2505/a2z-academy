<?php

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
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('video')->nullable();
            $table->string('link')->nullable();
            $table->enum('is_paid', ['0', '1'])->default('0');
            $table->double('price')->nullable();
            $table->double('special_price')->nullable();
            $table->string('language')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->enum('status', ['Enabled', 'Disabled'])->default('Enabled');
            $table->string('type')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->text('short_description')->nullable();
            $table->text('what_you_learn')->nullable();
            $table->text('instructor_infromation')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
