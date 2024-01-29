<?php

namespace App\Livewire\Administration;

use App\Models\Term;
use Auth;
use Illuminate\Contracts\View\Factory;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class SemesterList extends Component
{
    use WireToast, WithPagination;

    public $newName;

    public $newStart;

    public $newEnd;

    protected $listeners = ['semesterRefresh' => '$refresh'];

    public function newSemester(): void
    {
        if (Auth::user()->cannot('create', Term::class)) {
            toast()->danger(__('general.noPermission'), __('general.error'))->push();

            return;
        }

        $this->validate([
            'newName' => 'required',
            'newStart' => 'required|date',
            'newEnd' => 'required|date|after:newStart',
        ]);

        foreach (Term::all() as $term) {
            if ($term->start <= $this->newStart && $term->end >= $this->newStart) {
                toast()->danger(__('general.overlap'), __('general.error'))->push();

                return;
            }
            if ($term->start <= $this->newEnd && $term->end >= $this->newEnd) {
                toast()->danger(__('general.overlap'), __('general.error'))->push();

                return;
            }
        }

        Term::create([
            'name' => $this->newName,
            'start' => $this->newStart,
            'end' => $this->newEnd,
        ]);

        $this->newName = '';
        $this->newStart = '';
        $this->newEnd = '';

        toast()->success(__('general.createTermSuccess'), __('general.success'))->push();
    }

    public function render(
    ): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application {
        $terms = Term::orderBy('start', 'desc')->paginate(5, pageName: 'termsPage');

        return view('livewire.administration.semester-list')->with(['terms' => $terms]);
    }
}
