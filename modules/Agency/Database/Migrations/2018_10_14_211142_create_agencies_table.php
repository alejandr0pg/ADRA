<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->integer('director_id')->nullable()->unsigned();

            $table->foreign('director_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

            $table->integer('country_id')->nullable()->unsigned();

            $table->foreign('country_id')
                    ->references('id')
                    ->on('countries')
                    ->onDelete('set null');

            $table->text('mission');
            $table->text('vision');

            $table->integer('belong_to')->nullable();

            $table->boolean('vigency');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agencies');
    }
}
