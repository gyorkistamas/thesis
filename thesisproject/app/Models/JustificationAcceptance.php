<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JustificationAcceptance extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'justification_id',
        'user_id',
        'status',
        'comment',
    ];

    public $table = 'justification_acceptances';

    public $incrementing = true;

    public function Justification()
    {
        return $this->belongsTo(Justification::class, 'justification_id');
    }

    public function Teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
