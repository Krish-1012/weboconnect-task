<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $alertType;
    public $alertIndicator;
    public $alertMessage;
    
    public function __construct($type,$indicator,$message)
    {
       $this->alertType = $type;
       $this->alertIndicator = $indicator;
       $this->alertMessage = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
