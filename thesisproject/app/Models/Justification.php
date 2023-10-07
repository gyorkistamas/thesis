<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelIdea\Helper\App\Models\_IH_CourseClass_QB;

class Justification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'description',
    ];

    public function GetPictures(): HasMany
    {
        return $this->hasMany(JustificationPicture::class);
    }

    public function GetTeachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->as('acceptance')
            ->withPivot('status');
    }

    public function GetAffectedClasses(): BelongsToMany|_IH_CourseClass_QB
    {
        return User::find($this->user_id)
            ->GetClassesWithPresence()
            ->where('start_time', '>=', $this->start_date)
            ->where('end_time', '<=', $this->end_time);
    }
}
