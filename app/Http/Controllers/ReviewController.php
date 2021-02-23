<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Review;
use Session;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(Review $review)
    {
        $this->middleware('auth');
        $this->review = $review;
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->data['reviews'] = $this->review->all();
        return view('pages.review.index', $this->data);
    }

    public function store()
    {
        // TODO
    }

    public function edit(Review $review)
    {
        return view('pages.review.edit', compact('review'));
    }

    /**
     * Update specified data
     *
     * @param ReviewRequest $request
     * @param Review $review
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $this->data = $request->all();
        $review->update($this->data);

        return redirect()->back()->with('success', 'Data has been updated!');
    }

    /**
     * Delete specified data
     *
     * @param \App\Review $review
     *
     * @return \Illuminate\Support\Facades\Session
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return Session::flash('success', 'Data has been deleted!');
    }
}
