<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->dateTime('date_publication');
            $table->boolean('spoiler');
            $table->string('texte');
            $table->string('image');

            //reference a l'auteur
            $table->unsignedBigInteger('auteur');
            $table->foreign('auteur')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //reference a la communaute
            $table->unsignedBigInteger('communaute');
            $table->foreign('communaute')
                ->references('id')
                ->on('communautes')
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
        Schema::dropIfExists('publications');
    }
}
