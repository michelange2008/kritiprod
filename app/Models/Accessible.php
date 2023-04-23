<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accessible extends Model
{

    public $timestamps = false;
    protected $guarded = [];

    public function brutedatas(): HasMany
    {
        return $this->hasMany(Brutedata::class);
    }
}
