<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalForm extends Component
{
    public $titulo;

    public function __construct($titulo = 'Formulario')
    {
        $this->titulo = $titulo;
    }

    public function render()
    {
        return view('components.modal-form');
    }
}
