<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run()
    {
        //
		DB::table('users')->insert([
            'user_id' => 'admin01',
    		'fullname'   => 'SET BME',
    		'email'      => 'setbme@gmail.com',
    		'mobile'    => '0987654321',
    		'password'   => Hash::make('123456'),
    		'remember_token'=> Str::random(10),
    		'rule'       => '1',
    		'address'    => 'Ha Noi',
    		'department_id'=> '2',
    	]);
    }
}
