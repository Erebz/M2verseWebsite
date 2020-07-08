<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_commentaire');

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

            //reference a la publication
            $table->unsignedBigInteger('publication_id');
            $table->foreign('publication_id')
                ->references('id')
                ->on('publications')
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
        Schema::dropIfExists('commentaires');
    }
}
