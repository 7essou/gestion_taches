<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tache extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'dateDebut',
        'datefin',
        'user_id',
        'etat'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
