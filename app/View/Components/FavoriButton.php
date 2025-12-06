<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FavoriButton extends Component
{
    public $contenu;

    public function __construct($contenu)
    {
        $this->contenu = $contenu;
    }

    public function render()
    {
        return view('components.favori-button');
    }
}
