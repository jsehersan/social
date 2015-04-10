<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPost extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('social_post', function(Blueprint $table)
		{
			//
            $table->increments('id');
            $table->tinyInteger('id_item');
            $table->tinyInteger('status');
            $table->tinyInteger('channel_id');
            $table->string('type_item',150);
            $table->string('title',250);
            $table->text('text');
            $table->text('link');
            $table->text('img');
            $table->string('result_post',250);
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
		//
	}

}
