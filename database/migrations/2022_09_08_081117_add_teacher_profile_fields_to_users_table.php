<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->string('education')->nullable();
            $table->string('language')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('availability')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('designation')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permananat_address')->nullable();
            $table->text('aboutme')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('education');
            $table->dropColumn('language');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
            $table->dropColumn('availability');
            $table->dropColumn('years_experience');
            $table->dropColumn('designation');
            $table->dropColumn('present_address');
            $table->dropColumn('permananat_address');
            $table->dropColumn('aboutme');
        });
    }
}
