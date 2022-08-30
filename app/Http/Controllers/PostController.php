<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{

    public function index() {
        $posts = Post::orderBy('created_at', 'desc')
        ->with(['comments', 'comments.user', 'user'])
        ->paginate(9);
        return response()->json($posts);
    }

    public function create(Request $request) {
        /*
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);
        //*/
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => '폼 검증 실패', 'errors' => $validator->errors()], 422);
        }

        $params = $request->only(['subject', 'content', 'category']);
        $params['user_id'] = $request->user()->id;
        // $subject = $request->input('subject');
        // $content = $request->input('content');
        // $category = $request->input('category');

        // $post = new Post();
        // $post->subject = $subject;
        // $post->content = $content;
        // $post->content = $category;
        
        // $post->save();
        $post = Post::create($params);
        return response()->json($post);
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

        if($subject) $post->subject = $subject;
        if($content) $post->content = $content;
        $post->save();
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
        $comment=Comment::where('post_id', $id)->count();
        if($comment > 0){
            return response()
                ->json(['message' => '답글이 달린 질문은 삭제할 수 없습니다.'], 400);
        }
        $post->delete();
        return response()->json(['message' => '삭제되었습니다.']);
    }


}