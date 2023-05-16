<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Brutetype
 *
 * @property int $id
 * @property string $nom
 * @method static \Illuminate\Database\Eloquent\Builder|Brutetype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutetype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutetype query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutetype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutetype whereNom($value)
 * @mixin \Eloquent
 */
class Brutetype extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function brutesdatas(): HasMany
    {
        return $this->hasMany(Brutedata::class);
    }
}
