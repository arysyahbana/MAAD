<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSubCategoryController extends Controller
{
    public function show()
    {
        $subCategories = SubCategory::with('rCategory')->get();
        return view('admin.subcategory.subcategory_show', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('admin.subcategory.subcategory_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subCategory_name' => 'required',
            'subCategory_order' => 'required',
            'category_menu' => 'required',
            'show_on_menu' => 'required',
        ]);

        $subCategory_store = new SubCategory();
        $subCategory_store->sub_category_name = $request->subCategory_name;
        $subCategory_store->sub_category_order = $request->subCategory_order;
        $subCategory_store->category_id = $request->category_menu;
        $subCategory_store->show_on_menu = $request->show_on_menu;
        $subCategory_store->save();
        return redirect()->route('admin_subCategory_show');
    }

    public function edit($id)
    {
        $edit = SubCategory::where('id', $id)->first();
        $category = Category::get();
        // dd($category);
        // die;
        return view('admin.subcategory.subcategory_edit', compact('edit', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subCategory_name' => 'required',
            'subCategory_order' => 'required',
            'category_menu' => 'required',
            'show_on_menu' => 'required',
        ]);

        $subCategory_update = SubCategory::where('id', $id)->first();
        // dd($subCategory_update);
        // die;
        $subCategory_update->sub_category_name = $request->subCategory_name;
        $subCategory_update->sub_category_order = $request->subCategory_order;
        $subCategory_update->category_id = $request->category_menu;
        $subCategory_update->show_on_menu = $request->show_on_menu;

        $subCategory_update->update();
        return redirect()->route('admin_subCategory_show');
    }

    public function delete($id)
    {
        SubCategory::where('id', $id)->delete();
        return redirect()->route('admin_subCategory_show');
    }
}
