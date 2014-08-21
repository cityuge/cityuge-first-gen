<?php

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('DepartmentsTableSeeder');
        $this->call('CoursesTableSeeder');
        $this->call('OfferingsTableSeeder');
        $this->call('CourseAssessmentSeeder');
    }

}
