<?php

namespace App\Livewire\Teacher\Justifications;

use App\Models\Justification;
use Auth;
use Livewire\Component;

class JustificationList extends Component
{
    public $onlyNotResponded = true;

    public $studentName;

    public $dateFrom;

    public $dateTo;

    public function render()
    {
        $justifications = Justification::whereHas('Acceptances', function ($query) {
            $query->where('user_id', Auth::user()->id);
            if ($this->onlyNotResponded) {
                $query->where('status', 'na');
            }
        })
            ->where(function ($query) {
                if ($this->studentName != '') {
                    $query->whereHas('User', function ($query) {
                        $query->where('name', 'like', '%'.$this->studentName.'%')
                            ->orWhere('neptun', 'like', '%'.$this->studentName.'%');
                    });
                }
            })
            ->where(function ($query) {
                if ($this->dateFrom != '') {
                    $query->where('start_date', '>=', $this->dateFrom);
                }
                if ($this->dateTo != '') {
                    $query->where('start_date', '<=', $this->dateTo);
                }

            })
            ->orderBy('created_at')
            ->paginate(10);

        return view('livewire.teacher.justifications.justification-list', compact('justifications'));
    }
}
