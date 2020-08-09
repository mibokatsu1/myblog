<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Eloquent用
use App\Post;

// Validator用
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = Auth::user(); // 認証ユーザー取得
        $items = Post::with('user')
            ->orderBy('id', 'desc')
            ->get();
        // $items = Post::all();
        // $items = Post::orderBy('id', 'desc')->get();
        // 「Post::all();」ではN+1問題発生する

        $params = [
            'authUser' => $authUser,
            'items' => $items,
        ];
        return view('post.index', $params); // ビューの描画
        // return view('post.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $form = $request->all();

        // バリデーション
        $rules = [
            'user_id' => 'integer|required', // 2項目以上条件がある場合は「 | 」を挟む
            'title' => 'required',
            'message' => 'required',
        ];
        $message = [
            'user_id.integer' => 'System Error',
            'user_id.required' => 'System Error',
            'title.required'=> 'タイトルが入力されていません',
            'message.required'=> 'メッセージが入力されていません'
        ];
        $validator = Validator::make($form, $rules, $message);

        if($validator->fails()){
            return redirect('/post')
                ->withErrors($validator)
                ->withInput();
        }else{
            unset($form['_token']);
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->message = $request->message;
            $post->save();
            return redirect('/post');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authUser = Auth::user(); // 認証ユーザー取得
        $item = Post::find($id);
        $params = [
            'authUser' => $authUser,
            'item' => $item,
        ];
        return view('post.show', $params);
        // return view('post.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $form = $request->all();

        unset($form['_token']);
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->message = $request->message;
        $post->save();
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Post::find($id)->delete();
        return redirect('/post');
    }
}
