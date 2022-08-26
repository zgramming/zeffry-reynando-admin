<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ZeffryReynando\Profile
 *
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @property string $motto
 * @property string $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|Profile whereCreatedAt($value)
 * @method static Builder|Profile whereCreatedBy($value)
 * @method static Builder|Profile whereDescription($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile whereImage($value)
 * @method static Builder|Profile whereMotto($value)
 * @method static Builder|Profile whereName($value)
 * @method static Builder|Profile whereUpdatedAt($value)
 * @method static Builder|Profile whereUpdatedBy($value)
 */
class Profile extends Model
{
    use HasFactory;
    protected $table = Constant::TABLE_PROFILE;
    protected $guarded = [];
}
