<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Datatables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Post::select('*'))
            ->addColumn('action', 'post-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('post-list');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postId = $request->id;
        $post   =   Post::updateOrCreate(
                    [
                     'id' => $postId
                    ],
                    [
                    'title' => $request->title,
                    'code' => $request->code,
                    'author' => $request->author
                    ]);
        return Response()->json($post);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $post  = post::where($where)->first();

        return Response()->json($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::where('id',$request->id)->delete();

        return Response()->json($post);
    }
}
