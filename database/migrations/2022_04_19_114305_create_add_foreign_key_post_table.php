<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddForeignKeyPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // foreign key impostata nullable perché nel db esistono già dei post
            // che non hanno già associata alcuna categoria
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // onDelete definisce cosa deve fare il db quando viene eliminata una cateogoria;
            // di default, cancellerebbe anche i post associati per non violare il vincolo di integrità (cioè la relazione stabilita tra le due tabelle)
            // set null definisce che la colonna category_id di questi post va settata a null
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // cancello prima il vincolo di integrità
            $table->dropForeign('post_category_id_foreign');

            // cancello la colonna
            $table->dropColumn('category_id');
        });
    }
}
