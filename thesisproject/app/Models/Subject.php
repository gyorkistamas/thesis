<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'credit',
        'manager',
    ];

    public function Manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
