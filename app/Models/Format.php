<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Format
 *
 * @property int $id
 * @property string $nom
 * @method static \Illuminate\Database\Eloquent\Builder|Format newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Format newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Format query()
 * @method static \Illuminate\Database\Eloquent\Builder|Format whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Format whereNom($value)
 * @mixin \Eloquent
 */
class Format extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function brutedatas(): HasMany
    {
        return $this->hasMany(Brutedata::class);
    }
}
