<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQustionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qustions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_id');
            $table->foreign('sub_id')->references('id')->on('subjects')
                ->onDelete('cascade');
            $table->unsignedBigInteger('bd_id');
            $table->foreign('bd_id')->references('id')->on('boards')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->boolean('status')->default(false);
            $table->boolean('approve')->default(false);
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
        Schema::dropIfExists('qustions');
    }
}
