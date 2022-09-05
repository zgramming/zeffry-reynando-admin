<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PortfolioImages
 *
 * @property int $id
 * @property string|null $image
 * @property int|null $portfolio_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|PortfolioImages newModelQuery()
 * @method static Builder|PortfolioImages newQuery()
 * @method static Builder|PortfolioImages query()
 * @method static Builder|PortfolioImages whereCreatedAt($value)
 * @method static Builder|PortfolioImages whereCreatedBy($value)
 * @method static Builder|PortfolioImages whereId($value)
 * @method static Builder|PortfolioImages whereImage($value)
 * @method static Builder|PortfolioImages wherePortfolioId($value)
 * @method static Builder|PortfolioImages whereUpdatedAt($value)
 * @method static Builder|PortfolioImages whereUpdatedBy($value)
 * @mixin Eloquent
 */
class PortfolioImages extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = Constant::TABLE_PORTFOLIO_IMAGE;

    protected $guarded = [];
}
