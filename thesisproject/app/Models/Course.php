<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'subject_id',
        'subject_id',
        'term_id',
        'course_limit',
    ];

    public function Teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_teachers');
    }

    public function Students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_students');
    }

    public function Classes(): HasMany
    {
        return $this->hasMany(CourseClass::class);
    }

    public function Subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function Term()
    {
        return $this->belongsTo(Term::class);
    }
}
