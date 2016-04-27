<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('item_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('cant', 8, 2)->default(0)->nullable();
            $table->decimal('cost', 8, 2)->default(0)->nullable();
            $table->boolean('approved')->default(false);

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('item_id')->references('id')->on('items')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orden_de_compra');
    }
}
