<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeliveryModeInCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_types', function (Blueprint $table) {
            $table->boolean('is_delivery_mode')->nullable();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_mode_id')->nullable();
            $table->foreign('delivery_mode_id')->references('id')->on('course_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_types', function (Blueprint $table) {
            $table->dropColumn('is_delivery_mode');
        });
    }
}
