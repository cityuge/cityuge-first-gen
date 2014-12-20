<?php

use Illuminate\Database\Migrations\Migration;

class AddOfferingUnique extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offerings', function ($table) {
            $table->unique(array('course_id', 'semester'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offerings', function ($table) {
            $table->dropUnique('offerings_course_id_semester_unique');
        });
    }

}
