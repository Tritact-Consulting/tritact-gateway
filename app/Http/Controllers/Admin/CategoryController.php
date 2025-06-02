<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{

    function __construct(){
        $this->middleware('permission:view category|create category|edit category|delete category', ['only' => ['index','show']]);
        $this->middleware('permission:create category', ['only' => ['create','store']]);
        $this->middleware('permission:edit category', ['only' => ['edit','update']]);
        $this->middleware('permission:delete category', ['only' => ['destroy']]);

    }

    public function index(){
        $data = Category::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('data'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $tag = new Category();
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Category Added Successfully');
    }

    public function edit($id){
        $data = Category::find($id);
        return view('admin.category.edit', compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);

        $tag = Category::find($id);
        $tag->name = $request->name;
        $tag->status = $request->status;
        $tag->save();

        return redirect()->back()->with('success', 'Category Updated Successfully');
    }
    
    public function destroy($id){
        $data = Category::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
