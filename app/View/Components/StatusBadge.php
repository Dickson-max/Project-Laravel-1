<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatusBadge extends Component
{
    public string $status;

    public function __construct(string $status = 'Aktif')
    {
        $this->status = $status;
    }

    public function render()
    {
        return view('components.status-badge');
    }
}