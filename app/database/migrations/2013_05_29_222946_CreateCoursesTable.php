<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->engine = 'MyISAM';

			$table->increments('id')->unsigned();
			$table->string('code', 10)->unique();
			$table->string('title_en', 200);
			$table->string('title_zh', 200)->nullable();
			$table->string('category', 6);
			$table->string('level', 10);
			$table->integer('department_id')->unsigned();
			$table->string('grading_pattern', 6)->default('STD');

			$table->index('title_en');
			$table->index('title_zh');
			$table->index('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
