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

    /*
     * The gallery target name
     *
     * @var string
     */
    public $target;

    /*
     * The gallery type
     *
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Media $media, $target, $type = '')
    {
        $this->media = $media->latest()->get();
        $this->target = $target;
        $this->type = $type;
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
