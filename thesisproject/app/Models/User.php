<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PasswordResetEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ladder\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'neptun',
        'picture',
        'calendarUUID',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify((new PasswordResetEmail($token))->locale($this->lang));
    }

    public function get_pic()
    {
        if ($this->picture) {
            return asset('storage/'.$this->picture);
        }

        return 'https://gravatar.com/avatar/'.hash('sha256', Str::lower($this->email)).'?d=identicon';
    }

    public function ManagedSubjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function Justifications(): HasMany
    {
        return $this->hasMany(Justification::class);
    }

    public function SignedUpCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_students');
    }

    public function TaughtCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_teachers');
    }

    public function AssignedJustifications(): BelongsToMany
    {
        return $this->belongsToMany(Justification::class, 'justification_acceptances')
            ->as('acceptance')
            ->withPivot('status');
    }

    public function GetClassWithPresence($class_id): BelongsToMany
    {
        return $this->belongsToMany(CourseClass::class, 'attendances')
            ->using(Attendance::class)
            ->withPivot('attendance', 'late_minutes')
            ->wherePivot('course_class_id', '=', $class_id);
    }

    public function GetClassesWithPresence(): BelongsToMany
    {
        return $this->belongsToMany(CourseClass::class, 'attendances')
            ->using(Attendance::class)
            ->withPivot('attendance', 'late_minutes');
    }
}
