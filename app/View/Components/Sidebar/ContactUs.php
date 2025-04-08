<?php

namespace App\View\Components\Sidebar;

use App\Models\ApplicationForm;
use Illuminate\View\Component;

class ContactUs extends Component
{
    public $application_form;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->application_form = ApplicationForm::first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.contact-us');
    }
}
