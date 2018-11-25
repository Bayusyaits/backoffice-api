<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\User;
        $user->name = "Bayu Syaits";
        $user->email = "bayusyaits@gmail.com";
        $user->password = Hash::make("limb8391+q-");
        $user->api_token = str_random(100);
        $user->save();
    }
}
