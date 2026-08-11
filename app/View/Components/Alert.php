<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    // 1. Tambahkan variabel $type di sini
    public $type;

    /**
     * Create a new component instance.
     */
    // 2. Masukkan parameter $type di dalam __construct
    public function __construct($type = 'SUCCESS')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}