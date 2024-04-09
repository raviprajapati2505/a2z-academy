<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->enum('marital_status', ['Married', 'Unmarried', 'Separated', 'Divorced'])->default('Unmarried');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('country_code')->nullable();
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
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('marital_status');
            $table->dropColumn('nationality');
            $table->dropColumn('religion');
            $table->dropColumn('country_code');
        });
    }
}
