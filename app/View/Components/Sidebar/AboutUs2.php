<?php

namespace App\View\Components\Sidebar;

use App\Models\About;
use DOMDocument;
use Illuminate\View\Component;

class AboutUs2 extends Component
{
    public $about;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $about = About::first();
        $dom = new DOMDocument();
        @$dom->loadHTML($about->content, LIBXML_HTML_NODEFDTD);
        $this->about = $dom->textContent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.about-us2');
    }
}
