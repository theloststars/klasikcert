<?php

namespace App\View\Components\Navbar;

use App\Models\FooterLogo;
use Illuminate\View\Component;

class FooterLogos extends Component
{
    public $datas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->datas = FooterLogo::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.footerlogos');
    }
}
