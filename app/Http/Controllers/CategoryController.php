<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store new category to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()->back()->with('success', 'New category has been saved!');
    }

    /**
     * Delete specified category from database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->back()->with('success', 'Category has been removed!');
    }
}
