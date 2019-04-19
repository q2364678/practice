<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::truncate(); //清空資料庫
        for($i=0;$i<20;$i++){
        \App\User::create([
        'name' => '系統管理員'.$i,
        'username' => 'admin'.$i,
        'password' => bcrypt('demo1234'),
        'email' => str_random(5).'@chc.edu.tw',
        'admin' =>'1',]);


        }
    	

    }
}
