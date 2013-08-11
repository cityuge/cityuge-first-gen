<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';
			
			$table->increments('id')->unsigned();
			$table->integer('course_id')->unsigned();
			$table->string('semester', 20);
			$table->string('instructor', 100);
			$table->string('grade', 2)->nullable();
			$table->integer('workload');
			$table->text('body');
			$table->text('admin_note')->nullable();
			$table->string('ip_address', 15);
			$table->string('password', 60)->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->index('semester');
			$table->index('grade');
			$table->index('workload');
			$table->index('created_at');
			$table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
