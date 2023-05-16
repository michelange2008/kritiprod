<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Contenu
 *
 * @property int $id
 * @property int $localisation_id
 * @property int $source_id
 * @property int $soustype_id
 * @property int $periode_id
 * @property int $nature_id
 * @property string $description
 * @property string|null $formalisees
 * @property-read \App\Models\Localisation $localisation
 * @property-read \App\Models\Nature $nature
 * @property-read \App\Models\Periode $periode
 * @property-read \App\Models\Source $source
 * @property-read \App\Models\Soustype $soustype
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereFormalisees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereLocalisationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu wherePeriodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenu whereSoustypeId($value)
 * @mixin \Eloquent
 */
class Contenu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function brutesdatas()
    {
        return $this->hasMany(Brutedata::class);
    }

    public function localisation(): BelongsTo
    {
        return $this->belongsTo(Localisation::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function soustype(): BelongsTo
    {
        return $this->belongsTo(Soustype::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }
}
