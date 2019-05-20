<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('agency_id');
            $table->integer('country_id');
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('event_type_id');
            $table->integer('currency_id');
            $table->integer('director_national_id');
            $table->integer('director_regional_id');
            $table->integer('contribution_id'); 
            $table->integer('cordinator_id');
            $table->integer('budget')->default(0);
            $table->integer('total_cost')->default(0);
            $table->date('event_date');
            $table->date('start_date');
            $table->integer('status');
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
        Schema::dropIfExists('emergencies');
    }
}
