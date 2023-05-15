<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Type
 *
 * @property int $id
 * @property string $nom
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Soustype> $soustypes
 * @property-read int|null $soustypes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereNom($value)
 * @mixin \Eloquent
 */
class Type extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function soustypes(): HasMany
    {
        return $this->hasMany(Soustype::class);
    }
}
