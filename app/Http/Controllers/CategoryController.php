<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::get();
        
        return view("pages.category.index", [
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string"
        ]);

        $inserData = Category::create([
            "name" => $request->name
        ]);

        return redirect()->back()
            ->with("success", "Tambah data kategori berhasil");
    }

    public function destroy($id)
    {
        $item = Category::find($id);

        $item->delete();

        return redirect()->back()
            ->with("success", "Hapus data kategori berhasil");
    }

    public function edit($id) {
        $item = Category::find($id);

        return view('pages.category.edit', [
            'item' => $item
        ]);
        
    }
    public function update($id): RedirectResponse {
        $item = Category::find($id);

        $item->update(['name' =>request('name'),]);

        return redirect('/categories');
        
    }
}