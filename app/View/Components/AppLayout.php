<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class AppLayout extends Component
{
    public $breadcrumbs;

    /**
     * Create a new component instance.
     */
    public function __construct($breadcrumbs = null)
    {
        // If breadcrumbs not passed as prop, try to get from view data
        if ($breadcrumbs === null) {
            $breadcrumbs = ViewFacade::shared('breadcrumbs', []);
        }
        
        $this->breadcrumbs = $breadcrumbs ?: [];
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
