<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration
{
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->string('description', 200);
            $table->string('og_title', 100);
            $table->string('og_description', 200);
            $table->unsignedBigInteger('og_image_id');
            $table->text('custom_tags');
            $table->timestamps();
        });

        Schema::create('metables', function (Blueprint $table) {
            $table->unsignedBigInteger('meta_id')->index();
            $table->unsignedBigInteger('metable_id')->index();
            $table->string('metable_type');
            $table->string('group');

            $table->foreign('meta_id')
                  ->references('id')
                  ->on('meta')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('metables');
        Schema::dropIfExists('meta');
    }
}
