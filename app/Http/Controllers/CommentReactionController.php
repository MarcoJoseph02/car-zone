<?php

namespace App\Http\Controllers;

use App\Models\CommentReaction;
use App\Models\Comment;
// use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentReaction::all(); 
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
        // if (!auth()->check()) {
        //     return response()->json(['message' => 'You must be logged in to perform this action.'], 403);
        // }
        $request->validate([
            'user_id' => 'required|integer',
            'comment_id' => 'required|integer',
            'type' => 'required|string|in:like,love,haha,angry', // limit allowed types
        ]);

        $comment = Comment::findOrFail($request->comment_id);

        // Check if user already reacted
        $existingReaction = CommentReaction::where('user_id', Auth::id())
            ->where('comment_id', $comment)
            ->first();



        if ($existingReaction) {
            // If the type is the same, delete the reaction
            if ($existingReaction->type === $request->type) {
                $existingReaction->delete();
                return response()->json([
                    'message' => 'Reaction removed successfully',
                ], 200);
            } else {
                // Update existing reaction
                $existingReaction->update([
                    'type' => $request->type,
                ]);
            }
        } else {
            // Create new reaction
            CommentReaction::create([
                'user_id' => $request->user_id,
                'comment_id' => $comment->id,
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
     * @param  \App\Models\CommentReaction  $commentReaction
     * @return \Illuminate\Http\Response
     */
    public function show(CommentReaction $commentReaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentReaction  $commentReaction
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentReaction $commentReaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommentReaction  $commentReaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentReaction $commentReaction)
    {
        $data= $request->all();
        $commentReaction->update($data);
        return  $commentReaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentReaction  $commentReaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentReaction $commentReaction)
    {
        $commentReaction->delete();
        flash()->success("Deleted Succefully");
        return response()->json(null, 204);
    }
   
}
