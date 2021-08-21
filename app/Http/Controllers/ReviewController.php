<?php

namespace App\Http\Controllers;

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
}
