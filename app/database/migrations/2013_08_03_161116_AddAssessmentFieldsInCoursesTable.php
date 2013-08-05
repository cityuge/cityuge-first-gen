<?php

use Illuminate\Database\Migrations\Migration;

class AddAssessmentFieldsInCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('courses', function($table)
		{
			$table->boolean('assess_exam');
			$table->boolean('assess_quiz');
			$table->boolean('assess_report');
			$table->boolean('assess_project');

			$table->index('assess_exam');
			$table->index('assess_quiz');
			$table->index('assess_report');
			$table->index('assess_project');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('courses', function($table)
		{
			$table->dropColumn('assess_exam', 'assess_quiz', 'assess_report', 'assess_project');
		});
	}

}