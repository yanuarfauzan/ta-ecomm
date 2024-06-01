<?php

namespace App\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
