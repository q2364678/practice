<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	// protected $table = "posts "; //指定資料表名稱
    // public $timestamps = false; //若要取消時間戳記
   protected $fillable=[//可建入之資料//

   	

   		'title',
   		'content',
   		'user_id',
   		'views',
   		'admin',

   ] ;
   //一個使用者可以發多個公告//
   //一個公告僅會是由一個使用者發布//

   public function user()
    {
        return $this->belongsTo(User::class);
        //這邊指上面的每一則公告隸屬於每一位user//
        //post的model中填入belongsTo User//
        //就得去User的model中對應填入hasMany(取決於一個User可以有多個公告)//
    }



}
