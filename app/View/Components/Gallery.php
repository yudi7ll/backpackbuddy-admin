<?php

namespace App\View\Components;

use App\Media;
use Illuminate\View\Component;

class Gallery extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $this->data['media'] = $this->media->latest()->get();
        return view('components.gallery', $this->data);
    }
}
