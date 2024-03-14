<?php

namespace App\Livewire\Teacher\Justifications;

use App\Models\Justification;
use Auth;
use Livewire\Component;

class JustificationList extends Component
{
    public $onlyNotResponded = true;

    public function render()
    {
        $justifications = Justification::whereHas('Acceptances', function ($query) {
            $query->where('user_id', Auth::user()->id);
            if ($this->onlyNotResponded) {
                $query->where('status', 'na');
            }
        })
            ->orderBy('created_at')
            ->paginate(10);

        return view('livewire.teacher.justifications.justification-list', compact('justifications'));
    }
}
