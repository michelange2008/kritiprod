<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contenu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function brutedatas()
    {
        return $this->hasMany(Brutedata::class);
    }

    public function localisation(): BelongsTo
    {
        return $this->belongsTo(Localisation::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function soustype(): BelongsTo
    {
        return $this->belongsTo(Soustype::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }
}
