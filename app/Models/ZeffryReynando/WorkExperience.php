<?php

namespace App\Models\ZeffryReynando;

use App\Constant\Constant;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ZeffryReynando\WorkExperience
 *
 * @method static Builder|WorkExperience newModelQuery()
 * @method static Builder|WorkExperience newQuery()
 * @method static Builder|WorkExperience query()
 * @mixin Eloquent
 * @property int $id
 * @property int|null $job_id
 * @property string $company_code
 * @property string $company_name
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $description
 * @property string|null $company_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @method static Builder|WorkExperience whereCompanyCode($value)
 * @method static Builder|WorkExperience whereCompanyImage($value)
 * @method static Builder|WorkExperience whereCompanyName($value)
 * @method static Builder|WorkExperience whereCreatedAt($value)
 * @method static Builder|WorkExperience whereCreatedBy($value)
 * @method static Builder|WorkExperience whereDescription($value)
 * @method static Builder|WorkExperience whereEndDate($value)
 * @method static Builder|WorkExperience whereId($value)
 * @method static Builder|WorkExperience whereJobId($value)
 * @method static Builder|WorkExperience whereStartDate($value)
 * @method static Builder|WorkExperience whereUpdatedAt($value)
 * @method static Builder|WorkExperience whereUpdatedBy($value)
 * @property int|null $company_id
 * @method static Builder|WorkExperience whereCompanyId($value)
 */
class WorkExperience extends Model
{
    use HasFactory;

    protected $table = Constant::TABLE_WORK_EXPERIENCE;
    protected $guarded = [];
}
