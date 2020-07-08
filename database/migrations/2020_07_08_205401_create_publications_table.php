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
            $table->date('date_publication');
            $table->boolean('spoiler');

            //reference au contenu
            $table->unsignedBigInteger('contenu_message_id');
            $table->foreign('contenu_message_id')
                ->references('id')
                ->on('contenu_messages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //reference a l'auteur
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //reference a la communaute
            $table->unsignedBigInteger('communaute_id');
            $table->foreign('communaute_id')
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
