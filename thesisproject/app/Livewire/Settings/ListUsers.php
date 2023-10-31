<?php

namespace App\Livewire\Settings;

use App\Livewire\SimpleNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $search;

    public function redraw()
    {
        $this->resetPage();
    }

    public function deleteUser($id)
    {
        if (! Auth::user()->hasRole('superadmin')) {
            $this->dispatch('sendNotif', [
                'title' => __('general.noPermission'),
                'message' => __('general.noPermission'),
                'type' => SimpleNotification::TYPE_ALERT,
            ]);
            return;
        }
        $user = User::find($id);
        $user->delete();
        $this->dispatch('sendNotif', [
            'title' => __('general.success'),
            'message' => __('general.deleteSuccessful'),
            'type' => SimpleNotification::TYPE_SUCCESS,
        ]);
        $this->redraw();
    }

    //TODO szűrés csoport alapján
    public function render()
    {
        $users = User::where([
            ['id', '!=', \Auth::user()->id],
            ['neptun', 'like', '%'.$this->search.'%'],
        ])
            ->orWhere([
                ['id', '!=', \Auth::user()->id],
                ['name', 'like', '%'.$this->search.'%'],
            ])
            ->paginate(10);

        return view('livewire.settings.list-users', [
            'users' => $users,
        ]);
    }
}
