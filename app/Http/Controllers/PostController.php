<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->with(['categories', 'comments', 'comments.user', 'user'])->paginate(10);
        logger($posts);
        return response()->json($posts);
    }

    public function create(Request $request) {
        /*
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);
        //*/

        $params = $request->only(['subject', 'content']);
        $params['user_id'] = $request->user()->id;
        $subject = $request->input('subject');
        $content = $request->input('content');
        $ids = $request->input('category_ids');

                /*
        $post = new Post();
        $post->subject = $subject;
        $post->content = $content;
        $post->save();
        //*/

        $post = Post::create($params);
        $post->categories()->sync($ids);
        $result = Post::where('id', $post->id)->with(['user', 'categories', 'comments.user', ])->first();
        return response()->json($result);
    }

    public function read($id) {
        $post = Post::where('id', $id)->with('comments')->first();
        if(!$post) {
            return response()
                ->json([
                    'message' => '조회할 데이터가 존재하지 않습니다.'], 404);
        }
        //$post = Post::find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id) {
        
        $post = Post::find($id);

        if(!$post) {
            return response()
                ->json([
                    'message' => '조회할 데이터가 존재하지 않습니다.'], 404);
        }

        $user = $request->user();
        if($user->id != $post->user_id) {
            return response()
                ->json(['message' => '권한이 없습니다.'], 403);
        }

        $subject = $request->input('subject');
        $content = $request->input('content');
        $ids = $request->input('category_ids');

        if($subject) $post->subject = $subject;
        if($content) $post->content = $content;
        $post->save();
        $post->categories()->sync($ids);
        return response()->json($post);
    }

    public function delete(Request $request, $id) {
        $post = Post::find($id);
        if(!$post) {
            return response()
                ->json([
                    'message' => '조회할 데이터가 존재하지 않습니다.'], 404);
        }
        
        $user = $request->user();
        if($user->id != $post->user_id) {
            return response()
                ->json(['message' => '권한이 없습니다.'], 403);
        }
        logger($user->id);
        logger($post->post_id);
        $post->delete();

        return response()->json(['message' => '삭제되었습니다.']);
    }


}