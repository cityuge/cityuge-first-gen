<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('title_en', 200);
            $table->string('title_zh', 200)->nullable();
            $table->enum('category', array('AREA1', 'AREA2', 'AREA3', 'E', 'UNIREQ'));
            $table->string('level', 10);
            $table->integer('department_id')->unsigned();
            $table->enum('grading_pattern', array('PF', 'STD', 'STD-PF'))->default('STD');

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
