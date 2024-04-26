<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public $count = 1;

    public function render()
    {
        return view('livewire.counter');
    }

    public function increase()
    {
        $this->count++;
    }

    public function decrease()
    {
        if ($this->count > 1) {
            $this->count--;
        }
    }
}
