<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Response|View
     */
    public function index()
    {
        // you could also declare a variable first like this
        // $post = Post::all; <- this one is equivalent to DB::select('SELECT * FROM posts')
        // return view('posts.index')->with('posts', $post);
        return view('posts.index')->with('posts', POST::orderBy('created_at', 'desc')->paginate(3)->OnEachSide(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // File Upload Handler
        if ($request->hasFile('cover_image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Created a new post.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|Response|View
     */
    public function show($id)
    {
        // returns a single row from the table using Post::find() method //
        return view('posts.show')->with('post', Post::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::findORFail($id);

        // Check for User Match
        if (auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Nice try, Gringo. You cannot edit someone else\'s post. -5 points for Gryffindor.');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // File Upload Handler
        if ($request->hasFile('cover_image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        // Checks if the post has a cover image, if yes, it automatically posts again its own cover image if
        // the user doesn't upload a new cover image.
        // if the user did upload again, it deletes the previous file and replaces it with the new one
        if ($request->hasFile('cover_image'))
        {
            if ($post->cover_image != 'no_image.png')
            {
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for User Match
        if (auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'Nice try, Gringo. You cannot delete someone else\'s post. -5 points for Gryffindor.');
        }

        if ($post->cover_image != 'noimage.jpg')
        {
            // Delete Image
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('error', 'Post deleted.');
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
}
