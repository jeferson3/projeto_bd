<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class FormLogin extends Component
{
    /**
     * @var string
     */
    public string $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.login');
    }
}
