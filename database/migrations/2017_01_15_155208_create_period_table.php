<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
        });
        //
        // Schema::addColumn('accounts', function(Blueprint $table) {
        //   $table->integer('period_id')->unsigned()->index();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      // Schema::dropColumn('accounts', ['period_id']);
      Schema::dropIfExists('periods');
    }
}
