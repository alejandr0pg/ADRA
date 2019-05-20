<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasuries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('agency_id')->nullable()->unsigned();

            $table->foreign('agency_id')
                    ->references('id')
                    ->on('agencies')
                    ->onDelete('set null');

            $table->integer('receiver_id')->nullable()->unsigned();

            $table->foreign('receiver_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

            $table->integer('counter_id')->nullable()->unsigned();

            $table->foreign('counter_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');

            $table->integer('currency_id')->nullable()->unsigned();

            $table->foreign('currency_id')
                    ->references('id')
                    ->on('currencies')
                    ->onDelete('set null');

            $table->string('bank_name');
            $table->string('bank_route');
            $table->text('ivan')->nullable();
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
        Schema::dropIfExists('treasuries');
    }
}
