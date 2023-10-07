<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ladder\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'neptun',
        'picture',
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
        return $this->belongsToMany(Justification::class, 'justification_acceptance')
            ->as('acceptance')
            ->withPivot('status');
    }

    public function GetClassWithPresence($class_id): BelongsToMany
    {
        return $this->belongsToMany(CourseClass::class, 'presences')
            ->as('presence_details')
            ->withPivot('presence', 'late_minutes')
            ->wherePivot('course_class', '=', $class_id);
    }
}
