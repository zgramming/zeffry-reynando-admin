<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ZeffryReynando\Portfolio
 *
 * @method static Builder|Portfolio newModelQuery()
 * @method static Builder|Portfolio newQuery()
 * @method static Builder|Portfolio query()
 * @mixin Eloquent
 * @property int $id
 * @property int|null $type_application
 * @property int|null $main_technology_id
 * @property string $title
 * @property string $title_slug
 * @property string $short_description
 * @property string $full_description
 * @property string|null $banner_image
 * @property string|null $github_url
 * @property string|null $web_url
 * @property string|null $google_playstore_url
 * @property string|null $app_store_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|Portfolio whereAppStoreUrl($value)
 * @method static Builder|Portfolio whereBannerImage($value)
 * @method static Builder|Portfolio whereCreatedAt($value)
 * @method static Builder|Portfolio whereCreatedBy($value)
 * @method static Builder|Portfolio whereFullDescription($value)
 * @method static Builder|Portfolio whereGithubUrl($value)
 * @method static Builder|Portfolio whereGooglePlaystoreUrl($value)
 * @method static Builder|Portfolio whereId($value)
 * @method static Builder|Portfolio whereMainTechnologyId($value)
 * @method static Builder|Portfolio whereShortDescription($value)
 * @method static Builder|Portfolio whereTitle($value)
 * @method static Builder|Portfolio whereTitleSlug($value)
 * @method static Builder|Portfolio whereTypeApplication($value)
 * @method static Builder|Portfolio whereUpdatedAt($value)
 * @method static Builder|Portfolio whereUpdatedBy($value)
 * @method static Builder|Portfolio whereWebUrl($value)
 */
class Portfolio extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_PORTFOLIO;
    protected $guarded = [];
}
