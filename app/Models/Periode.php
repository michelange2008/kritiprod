<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Periode
 *
 * @property int $id
 * @property string $nom
 * @property string|null $dates
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereDates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Periode whereNom($value)
 * @mixin \Eloquent
 */
class Periode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }
}
