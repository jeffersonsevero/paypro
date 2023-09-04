<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\View\{Component, View};

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): ViewView
    {
        return view('layouts.guest');
    }
}
