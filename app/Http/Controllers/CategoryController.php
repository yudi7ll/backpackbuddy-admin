<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->category = $category;
    }

    /**
     * Display all category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['categories'] = $this->category->all();

        return view('category.index', $this->data);
    }

    /**
     * Show create category form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store new category to database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(CategoryRequest $request)
    {
        $this->category->create($request->all());

        return redirect()->back()->with('success', 'New category has been saved!');
    }

    /**
     * Show edit category form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $this->data['category'] = $this->category->find($id);

        return view('category.edit', $this->data);
    }

    /**
     * Update the specified category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->category->find($id)->update($request->all());

        return redirect()->back()->with('success', 'Category has been updated!');
    }

    /**
     * Delete specified category from database
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy($id)
    {
        $this->category->destroy($id);

        return redirect()->back()->with('success', 'Category has been removed!');
    }
}
