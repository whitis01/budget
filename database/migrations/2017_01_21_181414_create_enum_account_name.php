<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnumAccountName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_name_enums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('category_enum_id')->unsigned()->default(1);
            $table->foreign('category_enum_id')
                ->references('id')->on('category_enums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_name_enums');
    }
}
