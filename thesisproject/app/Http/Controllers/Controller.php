<?php

namespace App\Http\Controllers;

use App\Models\CourseClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function UserSettings()
    {
        return view('settings.user_settings');
    }

    public function getTimetable()
    {
        return view('timetable');
    }

    public function exportTimetable($uuid)
    {
        $user = User::where('calendarUUID', $uuid)->first();
        $filename = 'timetable.ics';

        $studentClasses = CourseClass::whereHas('Course', function ($query) use ($user) {
            $query->whereHas('Students', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            });
        })
            ->get()
            ->map(function ($class) {
                return [
                    'title' => $class->Course->Subject->name.' - '.$class->Course->course_id,
                    'start' => $class->start_time->format('Ymd\THis\Z'),
                    'end' => $class->end_time->format('Ymd\THis\Z'),
                    'location' => $class->Place->name,
                    'stamp' => Carbon::now()->format('Ymd\THis\Z'),
                ];
            });

        $teacherClasses = CourseClass::whereHas('Course', function ($query) use ($user) {
            $query->whereHas('Teachers', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            });
        })
            ->get()
            ->map(function ($class) {
                return [
                    'title' => $class->Course->Subject->name.' - '.$class->Course->course_id,
                    'start' => $class->start_time->subHour()->format('Ymd\THis\Z'),
                    'end' => $class->end_time->subHour()->format('Ymd\THis\Z'),
                    'location' => $class->Place->name,
                    'stamp' => Carbon::now()->format('Ymd\THis\Z'),
                ];
            });

        $classes = $studentClasses->merge($teacherClasses);

        $content = $this->getExportData($classes->toArray());

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename);
    }

    private function getExportData($classes)
    {
        $content = "BEGIN:VCALENDAR\n";
        $content .= "PRODID:-//hacksw/handcal//NONSGML v2.0//HU\n";
        $content .= "VERSION:2.0\n";
        $content .= "METHOD:PUBLISH\n";
        $content .= "X-WR-CALNAME:Timetable\n";
        $content .= "X-WR-TIMEZONE:Europe/Budapest\n";
        $content .= "CALSCALE:GREGORIAN\n";

        foreach ($classes as $class) {
            $content .= "BEGIN:VEVENT\n";
            $content .= 'UID:'.uniqid()."\n";
            $content .= 'DTSTAMP:'.$class['stamp']."\n";
            $content .= 'DTSTART:'.$class['start']."\n";
            $content .= 'DTEND:'.$class['end']."\n";
            $content .= 'SUMMARY:'.$class['title']."\n";
            $content .= 'LOCATION:'.$class['location']."\n";
            $content .= "END:VEVENT\n";
        }

        $content .= 'END:VCALENDAR';

        return $content;
    }

    public function manifest()
    {
        $manifest = [
            'name' => config('app.name'),
            'short_name' => config('app.name'),
            'start_url' => '/',
            'display' => 'fullscreen',
            'background_color' => '#1e232a',
            'theme_color' => '#407a5d',
            'icons' => [
                [
                    'src' => '/rsz_def_logo.png',
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any maskable',
                ],
            ],
        ];

        return response()->streamDownload(function () use ($manifest) {
            echo json_encode($manifest, JSON_UNESCAPED_SLASHES);
        }, 'manifest.json');
    }
}
