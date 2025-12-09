<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookModel;
use App\Models\WriterModel;

class BookController extends Controller
{
    public function index($author_id)
    {
        $books = BookModel::where('author_id', $author_id)->get();

        return response()->json(['books' => $books], 200);
    }
    public function store(Request $request, $author_id)
    {
        if (!WriterModel::find($author_id)) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $data = $request->all();
        $data['author_id'] = $author_id;

        $book = BookModel::create($data);

        return response()->json(['book' => $book], 200);
    }

    public function update(Request $request, $author_id, $id)
    {
        if (!WriterModel::find($author_id)) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $book = BookModel::where('author_id', $author_id)->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $book->update($request->all());

        return response()->json(['book' => $book], 200);
    }

    public function destroy($author_id, $id)
    {
        if (!WriterModel::find($author_id)) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $book = BookModel::where('author_id', $author_id)->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found!'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Deleted'], 410);
    }
}
