<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id')->unsigned();
		    $table->integer('votable_id');
		    $table->string('votable_type');
		    $table->integer('value');
		    $table->timestamps();
		    
		    $table->foreign('user_id')
      			  ->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('votes');
	}

}
