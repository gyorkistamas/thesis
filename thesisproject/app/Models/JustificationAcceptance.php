<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificationAcceptance extends Model
{
    use HasFactory;

    protected $fillable = [
        'justification_id',
        'user_id',
        'status',
    ];
}
