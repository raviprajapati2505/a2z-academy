<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsInCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->date('expiry_date')->nullable();
            $table->string('reference_number')->nullable();
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
            $table->dropColumn('expiry_date');
            $table->dropColumn('reference_number');
        });
    }
}
