<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\Posts;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\DB;
use App\Post;//切記controller內使用到model需use//

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        /*$posts = DB::select('select * from posts order by id DESC');
        $data=['posts'=>$posts,];
        return view('posts.index',$data);*/
        $posts = Post::orderBy('updated_at','DESC')->paginate(5);/*以更新時間做排序(DESC由大到小)*/
            $data = [
        'posts'=>$posts,
                    ];
        return view('posts.index',$data);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(/*Request*/PostsRequest $request)
    {
        //需先將model需儲存的資料欄位存入att//
        $att['title']= $request->input('title');
        $att['content']= $request->input('content');
        $att['user_id']= auth()->user()->id;
        $att['views'] = 0;
        //$att['created_at'] =now(); 
        //$att['updated_at'] =now();
        //因為eloquent已自動加入故不需要建入
        $post = Post::create($att);

        //處理檔案上傳
        if($request->hasFile('files')){
            $files = $request->file('files');

            foreach ($files as $file ) {
             $info = [
            'mime-type' => $file->getMimeType(),//檔案型別
            'original_filename' => $file->getClientOriginalName(),//原始檔名
            'extension' => $file->getClientOriginalExtension(),//副檔名
            'size' => $file->getClientSize(),//檔案大小
        ];
        $file->storeAs('public/posts/'.$post->id, $info['original_filename']);//儲存的地方從public開始算

            }
        }

        //儲存後導入首頁
        return redirect()->route('posts.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        //點閱數使用SESSION控制
        $post_key = "post_".$post->id;

        
        if(!session($post_key)){
        $att['views'] = $post->views+1;
        $post->update($att);
        }
        session([$post_key => '1']);
        //

        $files = get_files(storage_path('app/public/posts/'.$post->id));


        $post->content = nl2br($post->content);
        $data = [
        'post'=>$post,
        'files'=>$files,
    ];
    return view('posts.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //確認是否為同一個發文者
        if($post->user_id !=auth()->user()->id)
        {
            abort('404','你沒有被授權');
        }
         $data = [
        
        'post'=>$post,
    ];
    return view('posts.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request,Post $post )
    {
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $post->update($att);
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');

    }

    public function download($id,$filename)
    {
        $file = storage_path('app/public/posts/'.$id."/".$filename);
        return response()->download($file);


    }
}
