<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brutesdata extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function accessible(): BelongsTo
    {
        return $this->belongsTo(Accessible::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function brutetype(): BelongsTo
    {
        return $this->belongsTo(Brutetype::class);
    }

    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class);
    }

    public function format(): BelongsTo
    {
        return $this->belongsTo(Format::class);
    }

}
