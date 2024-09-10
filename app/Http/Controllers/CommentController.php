<?php

namespace App\Http\Controllers;
use App\Models\JobPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createComment;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createComment $request )
    // public function store(Request $request)

    {
        // dd($request->all());
        // $validatedData =$request->all();
        $user = Auth::User();
        $validatedData = $request->validated();
        $post =JobPost::find($validatedData['commentable_id'] );

        // $validatedData['commentable_type'] = "App\\Models\\JobPost";
        // $commentable = $commentableModel::findOrFail($commentableId);
// dd($validatedData);
        // $post->comments->create(['body' => $validatedData['comment'] , 'user_id' => Auth::id()]);
        // dd($validatedData['comment']);
        $post->comments()->create([
            'body' => $validatedData['comment'], 
            'user_id' => Auth::id()
        ]);
      
        return back()->with('success', 'Comment added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment){
        $comment->delete();
        return back()->with('success', 'Comment Deleted successfully!');

    }
}
