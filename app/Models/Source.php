<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Source
 *
 * @property int $id
 * @property string $nom
 * @property int $annee
 * @property string $auteur
 * @property string $reference
 * @property string|null $lien
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereAnnee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereAuteur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereLien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Source whereReference($value)
 * @mixin \Eloquent
 */
class Source extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }
}
