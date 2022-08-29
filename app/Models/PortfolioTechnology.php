<?php

namespace App\Models;

use App\Constant\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PortfolioTechnology
 *
 * @property int $id
 * @property int|null $portfolio_id
 * @property int|null $technology_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology query()
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology wherePortfolioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereTechnologyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PortfolioTechnology whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class PortfolioTechnology extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_PORTFOLIO_TECHNOLOGY;

    protected $guarded = [];
}
