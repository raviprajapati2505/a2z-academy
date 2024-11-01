<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
          $table->text('year')->nullable();
          $table->text('qualification')->nullable();
          $table->text('organization')->nullable();
          $table->text('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
          $table->dropColumn('year');
          $table->dropColumn('qualification');
          $table->dropColumn('organization');
          $table->dropColumn('name');
        });
    }
}
