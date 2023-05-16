<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Accessible
 *
 * @property int $id
 * @property string $nom
 * @method static \Illuminate\Database\Eloquent\Builder|Accessible newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessible newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessible query()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessible whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accessible whereNom($value)
 * @mixin \Eloquent
 */
class Accessible extends Model
{

    public $timestamps = false;
    protected $guarded = [];

    public function brutesdatas(): HasMany
    {
        return $this->hasMany(Brutedata::class);
    }
}
