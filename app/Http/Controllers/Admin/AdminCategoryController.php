<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function show()
    {
        $categories = Category::get();
        return view('admin.category.category_show', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category_store = new Category();
        $category_store->name = $request->category_name;
        $category_store->show_on_menu = $request->show_on_menu;
        $category_store->save();
        return redirect()->route('admin_category_show');
    }

    public function edit($name)
    {
        $edit = Category::where('name', $name)->first();
        return view('admin.category.category_edit', compact('edit'));
    }

    public function update(Request $request, $name)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category_update = Category::where('name', $name)->first();
        $category_update->name = $request->category_name;
        $category_update->show_on_menu = $request->show_on_menu;
        $category_update->update();
        return redirect()->route('admin_category_show');
    }

    public function delete($name)
    {
        Category::where('name', $name)->delete();
        return redirect()->route('admin_category_show');
    }
}
