<?php

namespace App\View\Components;

use App\Media;
use Illuminate\View\Component;

class Gallery extends Component
{
    /*
     * The media data
     *
     * @var App\Media
     */
    public $media;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        $this->media = $media->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.gallery');
    }
}
