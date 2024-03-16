<?php

namespace App\Livewire\Landing;

use App\Models\CourseClass;
use Carbon\Carbon;
use Livewire\Component;
use Str;
use Usernotnull\Toast\Concerns\WireToast;

class Timetable extends Component
{
    use WireToast;

    public $user;

    public function generateExportUUID()
    {
        $this->user->calendarUUID = Str::uuid()->toString();
        $this->user->save();
    }

    public function deleteExportUUID()
    {
        $this->user->calendarUUID = null;
        $this->user->save();
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function test()
    {
        toast()->info('Hello')->push();
    }

    public function getEvents($from, $to)
    {
        // TODO fix merging error
        $fromDate = Carbon::parse($from);
        $toDate = Carbon::parse($to);

        $studentClasses = CourseClass::whereBetween('start_time', [$fromDate, $toDate])
            ->whereHas('Course', function ($query) {
                $query->whereHas('Students', function ($query) {
                    $query->where('users.id', $this->user->id);
                });
            })
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'title' => $class->Course->Subject->name.' - '.$class->Course->course_id.' ('.($class->Place != null ? $class->Place->name : '-').')',
                    'start' => $class->start_time->toISOString(),
                    'end' => $class->end_time->toISOString(),
                    'color' => $this->getColor($class),
                    'allowClick' => false,
                    'className' => 'break-all',
                ];
            });

        $teacherClasses = CourseClass::whereBetween('start_time', [$fromDate, $toDate])
            ->whereHas('Course', function ($query) {
                $query->whereHas('Teachers', function ($query) {
                    $query->where('users.id', $this->user->id);
                });
            })
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'title' => $class->Course->Subject->name.' - '.$class->Course->course_id.' ('.($class->Place != null ? $class->Place->name : '-').')',
                    'start' => $class->start_time->toISOString(),
                    'end' => $class->end_time->toISOString(),
                    'color' => 'teal',
                    'allowClick' => true,
                    'className' => 'break-all',
                ];
            });

        $classes = array_merge($studentClasses->toArray(), $teacherClasses->toArray());

        return json_encode($classes);
    }

    private function getColor($class)
    {
        switch ($class->GetStudent($this->user->id)->first()->pivot->attendance) {
            case 'present':
            case 'justified':
                return 'green';
            case 'late':
                return 'orange';
            case 'missing':
                return 'red';
            default:
                return 'blue';
        }
    }

    public function render()
    {
        return view('livewire.landing.timetable');
    }
}
