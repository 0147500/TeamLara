<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solutions', function($table)
		{
		    $table->increments('id');
		    $table->integer('challenge_id')->unsigned();;
		    $table->integer('user_id')->unsigned();
		    $table->longText('body');
		    $table->boolean('correct');
		    $table->integer('rating');
		    $table->date('reviewed_at');
		    $table->integer('reviewed_by')->unsigned()->nullable();
		    $table->timestamps();
		    
		    $table->foreign('user_id')
      			  ->references('id')->on('users');
      		$table->foreign('challenge_id')
      			  ->references('id')->on('challenges');
      		$table->foreign('reviewed_by')
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
		Schema::drop('solutions');
	}

}
