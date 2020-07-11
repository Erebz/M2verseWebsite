<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartenances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('communaute_id');

            $table->foreign('communaute_id')
                ->references('id')
                ->on('communautes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
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
        Schema::dropIfExists('appartenances');
    }
}
