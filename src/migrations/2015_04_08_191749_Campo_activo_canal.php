<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CampoActivoCanal extends Migration {

	public function up()
	{
		//
         Schema::table('social_channel', function( Blueprint $table) {
         $table->boolean('principal')->default(0);
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
