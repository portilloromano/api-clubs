<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('uuid_club')->nullable()->index();
            $table->enum('type', ['PLAYER', 'TRAINER'])->index();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->integer('salary')->default(0);
            $table->timestamps();
            $table->foreign('uuid_club')->references('uuid')->on('clubs');
            $table->index(['uuid_club', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
