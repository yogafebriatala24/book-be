<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $sortByTitle = $request->sortByTitle;
        $minYear = $request->minYear;
        $maxYear = $request->maxYear;

        $data = Book::query();
        $kategori = Category::get();

        if ($title) {
            $data->where("title", "LIKE", "%$title%");
        }

        if ($sortByTitle) {
            $data->orderBy("title", $sortByTitle);
        }

        if ($minYear) {
            $data->where("release_year", ">=", $minYear);
        }
        if ($maxYear) {
            $data->where("release_year", "<=", $maxYear);
        }


        return view('pages.book.index', [
            'data' => $data->get(),
            'kategori' => $kategori,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|image',
            'release_year' => 'required|int',
            'price' => 'required|int',
            'total_page' => 'required|int',
            'category_id' => 'required|string',
        ]);

        $formData = [
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url->store("book", "public"),
            'release_year' => $request->release_year,
            'price' => $request->price,
            'total_page' => $request->total_page,
            'category_id' => $request->category_id,
        ];

        $totalHalaman = $request->total_page;

        if ($totalHalaman <= 100) {
            $thickness = 'tipis';
        } elseif ($totalHalaman > 100 && $totalHalaman <= 200) {
            $thickness = 'sedang';
        } else {
            $thickness = 'tebal';
        }

        $formData['thickness'] = $thickness;

        $inserData = Book::create($formData);

        return redirect()
            ->back()
            ->with('success', 'Tambah data kategori berhasil');
    }

    public function destroy($id)
    {
        $item = Book::find($id);

        $item->delete();

        return redirect()
            ->back()
            ->with('success', 'Hapus data kategori berhasil');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $kategori = Category::get();

        return view('pages.books.edit', [
            'book' => $book,
            'kategori' => $kategori,
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|image',
            'release_year' => 'required|int',
            'price' => 'required|int',
            'total_page' => 'required|int',
            'category_id' => 'required|string',
        ]);

        $book = Book::find($id);

        $formData = [
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url->store("book", "public"),
            'release_year' => $request->release_year,
            'price' => $request->price,
            'total_page' => $request->total_page,
            'category_id' => $request->category_id,
        ];

        $totalHalaman = $request->total_page;

        if ($totalHalaman <= 100) {
            $thickness = 'tipis';
        } elseif ($totalHalaman > 100 && $totalHalaman <= 200) {
            $thickness = 'sedang';
        } else {
            $thickness = 'tebal';
        }

        $formData['thickness'] = $thickness;

        $inserData = $book->update($formData);

        return redirect('/books')
            ->with('success', 'Tambah data kategori berhasil');
    }
}