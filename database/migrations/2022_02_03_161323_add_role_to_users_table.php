<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('id');
            $table->string('firstname')->nullable()->after('username');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('phone')->after('lastname');
            $table->date('birthday')->nullable()->after('phone');
            $table->enum('is_verified', ['Verified', 'Not Verified'])->default('Not Verified')->after('birthday');
            $table->dateTime('last_verified_at')->nullable()->after('is_verified');
            $table->enum('role', ['Student', 'Teacher', 'Admin', 'Superadmin'])->default('Student')->after('last_verified_at');
            $table->enum('status', ['Enabled', 'Disabled'])->default('Disabled')->after('role');
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
            $table->dropColumn('username');
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('is_verified');
            $table->dropColumn('last_verified_at');
            $table->dropColumn('role');
            $table->dropColumn('status');
        });
    }
}
