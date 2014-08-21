<?php

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('id' => '1', 'username' => 'eric', 'password' => Hash::make('password')),
        );

        DB::table('users')->insert($users);
    }

}
