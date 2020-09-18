<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrizesTable extends Migration
{

    public function up()
    {
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('description');
            $table->string('image');
            $table->string('status');
            $table->timestamps();

            $table->foreignId('artist_id')->constrained()->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
