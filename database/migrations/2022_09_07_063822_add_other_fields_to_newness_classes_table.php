<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherFieldsToNewnessClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newness_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('date')->nullable();
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->text('zoom_join_url')->nullable();
            $table->text('zoom_start_url')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('newness_classes', function (Blueprint $table) {
            $table->dropColumn('class_id');
            $table->dropColumn('subject_id');
            $table->dropColumn('teacher_id');
            $table->dropColumn('created_by');
            $table->dropColumn('date');
            $table->dropColumn('time_from');
            $table->dropColumn('time_to');
            $table->dropColumn('zoom_join_url');
            $table->dropColumn('zoom_start_url');
        });
    }
}
