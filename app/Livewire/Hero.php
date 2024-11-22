<?php

namespace App\Livewire;

use Livewire\Component;

class Hero extends Component
{

    public function redirectToAdmin(){
        return redirect('/admin');
    }
    public function render()
    {
        return view('livewire.hero');
    }
}
