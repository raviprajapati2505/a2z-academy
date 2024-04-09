<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->integer('sorting');
            $table->double('price');
            $table->double('special_price')->nullable();
            $table->date('special_price_till_date')->nullable();
            $table->enum('status', ['Enabled', 'Disabled'])->default('Disabled');
            $table->enum('is_able_to_sold_seperate', ['0', '1'])->default('1');
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('newness_classes')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
