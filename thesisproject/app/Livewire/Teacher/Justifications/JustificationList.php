<?php

namespace App\Livewire\Teacher\Justifications;

use App\Models\Justification;
use Auth;
use Livewire\Component;

class JustificationList extends Component
{
    public function render()
    {
        $justifications = Justification::whereHas('Acceptances', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->paginate(10);

        return view('livewire.teacher.justifications.justification-list', compact('justifications'));
    }
}
