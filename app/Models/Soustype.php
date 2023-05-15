<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Soustype
 *
 * @property int $id
 * @property string $nom
 * @property int $type_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @property-read \App\Models\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype query()
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Soustype whereTypeId($value)
 * @mixin \Eloquent
 */
class Soustype extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

}
