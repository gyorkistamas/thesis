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
        'end_time',
        'description',
        'type',
        'created_at',
        'updated_at',
    ];

    public $casts = [
        'start_date' => 'datetime',
        'end_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function Pictures(): HasMany
    {
        return $this->hasMany(JustificationPicture::class);
    }

    public function GetTeachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'justification_acceptances')
            ->using(JustificationAcceptance::class)
            ->withPivot('status', 'comment');
    }

    public function GetTeacherResponse($user_id)
    {
        return $this->hasOne(JustificationAcceptance::class, 'justification_id', 'id')
            ->where('user_id', $user_id);
    }

    public function Acceptances()
    {
        return $this->hasMany(JustificationAcceptance::class, 'justification_id', 'id');
    }

    public function GetAffectedClasses(): BelongsToMany|_IH_CourseClass_QB
    {
        return User::find($this->user_id)
            ->GetClassesWithPresence()
            ->where('start_time', '>=', $this->start_date)
            ->where('end_time', '<=', $this->end_time);
    }
}
