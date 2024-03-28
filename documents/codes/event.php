public function broadcastOn(): array
{
    return [
        new Channel('updatePresence.'.$this->attendance->id),
    ];
}