<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificationPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'justification_id',
        'picture_name',
    ];
}
