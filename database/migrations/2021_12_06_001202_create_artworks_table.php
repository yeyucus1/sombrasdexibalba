<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->mediumText('Synopsis');
            $table->string('image', 255)->nullable();
            $table->longText('content');
            $table->string('access');
            $table->string('publi_pref');
            $table->string('status');
            $table->unsignedBigInteger('creator');
            $table->foreign('creator')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('type');
            $table->foreign('type')
                ->references('id')
                ->on('types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('genere');
            $table->foreign('genere')
                ->references('id')
                ->on('generes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('character_id');
            $table->foreign('character_id')
                ->references('id')
                ->on('characters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('artworks');
    }
}
