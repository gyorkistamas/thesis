#[On('echo:updatePresence.{pivot.id},.App\Events\ClassPresenceChanged')]
public function presenceUpdated()
{
    $this->pivot->refresh();
    $this->dispatch('refreshChart');
}