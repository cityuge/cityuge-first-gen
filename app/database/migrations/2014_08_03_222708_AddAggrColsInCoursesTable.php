<?php

use Illuminate\Database\Migrations\Migration;

class AddAggrColsInCoursesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            $table->integer('total_comments');
            $table->decimal('mean_gp', 5, 4);
            $table->decimal('mean_workload', 5, 4);
            $table->decimal('bayesian_gp', 5, 4);
            $table->decimal('bayesian_workload', 5, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function ($table) {
            $table->dropColumn('total_comments');
            $table->dropColumn('mean_gp');
            $table->dropColumn('mean_workload');
            $table->dropColumn('bayesian_gp');
            $table->dropColumn('bayesian_workload');
        });
    }

}
