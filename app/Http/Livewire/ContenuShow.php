<?php

namespace App\Http\Livewire;

use App\Models\Brutesdata;
use App\Models\Contenu;
use Livewire\Component;

class ContenuShow extends Component
{
    public $contenu;
    public $essai = "bonjour";
    public $brutesdatas;

    public function mount($id)
    {
        $this->contenu = Contenu::find($id);
        $this->brutesdatas = Brutesdata::where('contenu_id', $id)->get();

    }
    public function render()
    {
        return view('livewire.contenu-show');
    }
}
