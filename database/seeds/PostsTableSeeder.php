<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::truncate(); //清空資料庫
        for($i=0;$i<20;$i++){

        \App\Post::create([
        'title' => '標題'.$i,
        'content' => '內容'.$i,
        'user_id' => rand(1,20),
        'views' =>'0',
        'created_at'=>now(), 
        'updated_at'=>now(),

    ]);

        }
    	
    }
}
