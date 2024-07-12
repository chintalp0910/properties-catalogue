<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyDemographic
 * 
 * @property int $id
 * @property int $property_id
 * @property int $demographic_category_id
 * @property int $demographic_mile_id
 * @property string|null $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property DemographicCategory $demographic_category
 * @property DemographicMile $demographic_mile
 * @property Property $property
 *
 * @package App\Models
 */
class PropertyDemographic extends Model
{
	protected $table = 'property_demographic';

	protected $casts = [
		'property_id' => 'int',
		'demographic_category_id' => 'int',
		'demographic_mile_id' => 'int'
	];

	protected $fillable = [
		'property_id',
		'demographic_category_id',
		'demographic_mile_id',
		'value'
	];

	public function demographic_category()
	{
		return $this->belongsTo(DemographicCategory::class);
	}

	public function demographic_mile()
	{
		return $this->belongsTo(DemographicMile::class);
	}

	public function property()
	{
		return $this->belongsTo(Property::class);
	}
}
