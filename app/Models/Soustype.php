<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soustype extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

}
