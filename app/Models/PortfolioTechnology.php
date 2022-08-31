<?php

namespace App\Models;

use App\Constant\Constant;
use App\Models\ZeffryReynando\Portfolio;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PortfolioTechnology
 *
 * @property int $id
 * @property int|null $portfolio_id
 * @property int|null $technology_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|PortfolioTechnology newModelQuery()
 * @method static Builder|PortfolioTechnology newQuery()
 * @method static Builder|PortfolioTechnology query()
 * @method static Builder|PortfolioTechnology whereCreatedAt($value)
 * @method static Builder|PortfolioTechnology whereCreatedBy($value)
 * @method static Builder|PortfolioTechnology whereId($value)
 * @method static Builder|PortfolioTechnology wherePortfolioId($value)
 * @method static Builder|PortfolioTechnology whereTechnologyId($value)
 * @method static Builder|PortfolioTechnology whereUpdatedAt($value)
 * @method static Builder|PortfolioTechnology whereUpdatedBy($value)
 * @mixin Eloquent
 */
class PortfolioTechnology extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_PORTFOLIO_TECHNOLOGY;
    public $incrementing = false;

    protected $guarded = [];

    public function technology(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MasterData::class,'technology_id','id');
    }

    public function portfolio(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Portfolio::class,'portfolio_id','id');
    }
}
