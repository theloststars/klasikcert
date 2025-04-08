<?php

namespace App\View\Components\Navbar;

use App\Models\Contact;
use Illuminate\View\Component;

class OfficeEmails extends Component
{
    public $datas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->datas = Contact::where('url_slug','office-email')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.officeemails');
    }
}
