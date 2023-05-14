<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Localisation
 *
 * @property int $id
 * @property string $nom
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Localisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Localisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Localisation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Localisation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Localisation whereNom($value)
 * @mixin \Eloquent
 */
class Localisation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }
}
