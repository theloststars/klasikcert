<?php

namespace App\View\Components\Sidebar;

use App\Models\Standard;
use Illuminate\View\Component;

class Standards extends Component
{
    public $datas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->datas = Standard::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.standards');
    }
}
