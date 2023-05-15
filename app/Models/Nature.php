<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Nature
 *
 * @property int $id
 * @property string $nom
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereNom($value)
 * @mixin \Eloquent
 */
class Nature extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }
}
