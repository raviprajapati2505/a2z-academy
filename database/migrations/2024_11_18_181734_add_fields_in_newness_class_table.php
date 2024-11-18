<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInNewnessClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('newness_classes', function (Blueprint $table) {
            // $table->unsignedBigInteger('delivery_mode_id')->nullable();
            // $table->foreign('delivery_mode_id')->references('id')->on('course_types');
            $table->unsignedBigInteger('course_type_id')->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types');
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->foreign('child_category_id')->references('id')->on('child_categories');
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
            //
        });
    }
}
