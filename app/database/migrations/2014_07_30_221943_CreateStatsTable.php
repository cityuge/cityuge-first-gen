<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('code', 10);
            $table->string('semester', 20);
            $table->integer('total_student');
            $table->decimal('mean', 3, 2)->nullable();
            $table->decimal('median', 3, 2)->nullable();
            $table->decimal('sd', 5, 2)->nullable();
            $table->decimal('max', 3, 2)->nullable();
            $table->decimal('min', 3, 2)->nullable();

            $table->index('course_id');
            $table->index('semester');

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
        Schema::drop('stats');
    }

}
