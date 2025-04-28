<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // at the top if not already

    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to perform this action.'], 403);
        }
        $userId = Auth::id();
        $comments = Comment::with('user', 'reactions') // eager load user and reactions
            ->latest()
            ->get()
            ->map(function ($comment) use ($userId) {
                $userReaction = $comment->reactions
                    ->where('user_id', $userId)
                    ->first();
                return [
                    'id' => $comment->id,
                    'user' => [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                    ],
                    'body' => $comment->body,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'reactions' => [
                        'like' => $comment->reactions->where('type', 'like')->count(),
                        'love' => $comment->reactions->where('type', 'love')->count(),
                        'haha' => $comment->reactions->where('type', 'haha')->count(),
                        'angry' => $comment->reactions->where('type', 'angry')->count(),
                    ],
                    'user_reacted' => $userReaction ? true : false,
                    'user_reaction_type' => $userReaction ? $userReaction->type : null,
                ];
            });

        return response()->json([
            'comments' => $comments,
        ], 200);
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
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to cancel a booking.'], 403);
        }
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment,
        ], 200);
    }



    public function react(Request $request, $commentId)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to cancel a booking.'], 403);
        }
        $request->validate([
            'type' => 'required|string|in:like,love,haha,angry', // limit allowed types
        ]);

        $comment = Comment::findOrFail($commentId);

        // Check if user already reacted
        $existingReaction = CommentReaction::where('user_id', Auth::id())
            ->where('comment_id', $commentId)
            ->first();

        if ($existingReaction) {
            // Update existing reaction
            $existingReaction->update([
                'type' => $request->type,
            ]);
        } else {
            // Create new reaction
            CommentReaction::create([
                'user_id' => Auth::id(),
                'comment_id' => $commentId,
                'type' => $request->type,
            ]);
        }

        return response()->json([
            'message' => 'Reaction saved successfully',
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'You must be logged in to perform this action.'], 403);
        }

        // Check if the logged-in user is the owner of the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'You are not authorized to edit this comment.'], 403);
        }

        // Validate the new body
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Update the comment
        $comment->update([
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Comment updated successfully.',
            'comment' => $comment,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    public function removeReaction($commentId)
    {
        $reaction = CommentReaction::where('user_id', Auth::id())
            ->where('comment_id', $commentId)
            ->first();

        if ($reaction) {
            $reaction->delete();

            return response()->json([
                'message' => 'Reaction removed successfully',
            ]);
        }

        return response()->json([
            'message' => 'No reaction found',
        ], 404);
    }
}
