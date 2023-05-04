<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title, $layout;

    public $isFluid, $isComponent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title=null, $layout='app', $isFluid=false, $isComponent = false)
    {
        $this->title = $title;
        $this->layout = $layout;
        $this->isFluid = $isFluid;
        $this->isComponent = $isComponent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.'.$this->layout);
    }
}
