<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

use Datatables;

class DataTablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Book::select('*'))
            ->addColumn('action', 'book-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('book-list');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookId = $request->id;
        $book   =   Book::updateOrCreate(
                    [
                     'id' => $bookId
                    ],
                    [
                    'title' => $request->title,
                    'code' => $request->code,
                    'author' => $request->author
                    ]);
        return Response()->json($book);
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
        $book  = Book::where($where)->first();

        return Response()->json($book);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $book = Book::where('id',$request->id)->delete();

        return Response()->json($book);
    }
}
