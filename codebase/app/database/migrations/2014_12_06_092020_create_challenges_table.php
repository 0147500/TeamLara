<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenges', function($table)
		{
		    $table->increments('id');
		    $table->string('name');
		    $table->longText('body');
		    $table->mediumText('description');
		    $table->string('difficulty');
		    $table->integer('rating')->default(0);
		    $table->integer('attempted_count');
		    $table->integer('solved_count');
		    $table->integer('created_by')->unsigned();
		    $table->timestamps();
		    
		    $table->foreign('created_by')
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
		Schema::drop('challenges');
	}

}
