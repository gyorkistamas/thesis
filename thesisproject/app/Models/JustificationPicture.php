<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JustificationPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'justification_id',
        'picture_name',
    ];

    public function GetJustification(): BelongsTo
    {
        return $this->belongsTo(Justification::class);
    }
}
