<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ZeffryReynando\Statistic
 *
 * @property int $id
 * @property string|null $method
 * @property string|null $request
 * @property string|null $url
 * @property string|null $referer
 * @property string|null $languages
 * @property string|null $useragent
 * @property string|null $headers
 * @property string|null $device
 * @property string|null $platform
 * @property string|null $browser
 * @property string|null $ip
 * @property string|null $visitable_type
 * @property int|null $visitable_id
 * @property string|null $visitor_type
 * @property int|null $visitor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Statistic newModelQuery()
 * @method static Builder|Statistic newQuery()
 * @method static Builder|Statistic query()
 * @method static Builder|Statistic whereBrowser($value)
 * @method static Builder|Statistic whereCreatedAt($value)
 * @method static Builder|Statistic whereDevice($value)
 * @method static Builder|Statistic whereHeaders($value)
 * @method static Builder|Statistic whereId($value)
 * @method static Builder|Statistic whereIp($value)
 * @method static Builder|Statistic whereLanguages($value)
 * @method static Builder|Statistic whereMethod($value)
 * @method static Builder|Statistic wherePlatform($value)
 * @method static Builder|Statistic whereReferer($value)
 * @method static Builder|Statistic whereRequest($value)
 * @method static Builder|Statistic whereUpdatedAt($value)
 * @method static Builder|Statistic whereUrl($value)
 * @method static Builder|Statistic whereUseragent($value)
 * @method static Builder|Statistic whereVisitableId($value)
 * @method static Builder|Statistic whereVisitableType($value)
 * @method static Builder|Statistic whereVisitorId($value)
 * @method static Builder|Statistic whereVisitorType($value)
 * @mixin \Eloquent
 */
class Statistic extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_STATISTIC;
    protected $guarded = [];
}
