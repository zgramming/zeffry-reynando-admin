<?php

namespace App\Models;

use App\Constant\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PortfolioImages
 *
 * @property int $id
 * @property string|null $image
 * @property int|null $portfolio_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages wherePortfolioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioImages whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PortfolioImages extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_PORTFOLIO_IMAGE;

    protected $guarded = [];
}
