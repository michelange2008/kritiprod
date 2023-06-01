<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Brutesdata
 *
 * @property int $id
 * @property int $contenu_id
 * @property int $brutetype_id
 * @property string $naturedatas
 * @property int $accessible_id
 * @property string|null $qualite
 * @property int|null $adventices
 * @property int|null $format_id
 * @property int $application_id
 * @property-read \App\Models\Accessible $accessible
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\Brutetype $brutetype
 * @property-read \App\Models\Contenu $contenu
 * @property-read \App\Models\Format|null $format
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata query()
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereAccessibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereAdventices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereBrutetypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereContenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereFormatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereNaturedatas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Brutesdata whereQualite($value)
 * @mixin \Eloquent
 */
class Brutesdata extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function accessible(): BelongsTo
    {
        return $this->belongsTo(Accessible::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function brutetype(): BelongsTo
    {
        return $this->belongsTo(Brutetype::class);
    }

    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class);
    }

    public function format(): BelongsTo
    {
        return $this->belongsTo(Format::class);
    }
}
