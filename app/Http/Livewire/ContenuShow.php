<?php

namespace App\Http\Livewire;

use App\Models\Contenu;
use Livewire\Component;

class ContenuShow extends Component
{
    public $contenu;
    public $essai = "bonjour";

    public function mount()
    {
        $this->contenu = Contenu::find(1);

    }
    public function render()
    {
        return view('livewire.contenu-show');
    }
}
