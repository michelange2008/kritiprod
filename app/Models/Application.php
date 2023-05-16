<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Application
 *
 * @property int $id
 * @property string $nom
 * @method static \Illuminate\Database\Eloquent\Builder|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Application whereNom($value)
 * @mixin \Eloquent
 */
class Application extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function brutesdatas(): HasMany
    {
        return $this->hasMany(Brutedata::class);
    }
}
