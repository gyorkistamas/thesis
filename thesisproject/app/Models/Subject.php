<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'credit',
        'manager',
    ];

    public function Manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager', 'id');
    }

    public function Courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function CoursesInTerm($term_id): HasMany
    {
        return $this->hasMany(Course::class)
            ->where('term_id', '=', $term_id);
    }
}
