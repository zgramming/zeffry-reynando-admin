<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CurriculumVitae
 *
 * @property int $id
 * @property string $name
 * @property int $version
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae query()
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CurriculumVitae whereVersion($value)
 * @mixin \Eloquent
 */
class CurriculumVitae extends Model
{
    use HasFactory;
    protected $table = Constant::TABLE_CV;

    protected $guarded = [];
}
