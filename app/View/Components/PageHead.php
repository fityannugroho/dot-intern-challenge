<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHead extends Component
{
    /**
     * The page title.
     *
     * The default value will follow the app name.
     *
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @return void
     */
    public function __construct($title = '')
    {
        $this->title = $title . ' | ' . config('app.name') ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-head');
    }
}
