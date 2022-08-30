<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function create(Request $request, $postId) {
        $post = Post::find($postId);
        $counter = Comment::where('post_id', $postId)->count();
        if(!$post) {
            return abort(404);
        }
        if($counter > 3){
            return abort(400);
        }
        logger($counter);
        $user = $request->user();
        $content = $request->input('content');
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id=$postId;
        $comment->content=$content;
        $comment->save();
        return response()->json($comment);
    }

    public function update(Request $request, $id) {
        
        $comment = Comment::find($id);

        if(!$comment) {
            return response()
                ->json([
                    'message' => '조회할 데이터가 존재하지 않습니다.'], 404);
        }

        $user = $request->user();
        $accepted = $request->input('accepted');
        if($user->id != $comment->user_id) {
            return response()
                ->json(['message' => '권한이 없습니다.'], 403);
        }
        if($accepted != 'n'){
            return response()
                ->json(['message' => '채택된 답변은 수정할 수 없습니다.'], 400);
        }
        $content = $request->input('content');
        if($content) $comment->content = $content;
        $content->save();
        return response()->json($content);
    }

    public function delete($postId, $id) {
        $comment = Comment::where('post_id', $postId)->where('id', $id)->first();
        if(!$comment) abort(404);
        $isAccepted=$comment->accepted;
        $user = $request->user();
        
        if($user->id != $comment->user_id){
            return resonse()->json(['message' => '권한이 없습니다.'], 403);
        }

        if($isAccepted != 'n'){
            return response()->json(['message' => '채택된 답변을 삭제할 수 없습니다.'], 400);
        }

        $comment->delete();
        return response()->json(['message' => '댓글이 삭제되었습니다.']);
    }
}
