<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DemographicMile
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|PropertyDemographic[] $property_demographics
 *
 * @package App\Models
 */
class DemographicMile extends Model
{
	protected $table = 'demographic_mile';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function property_demographics()
	{
		return $this->hasMany(PropertyDemographic::class);
	}
}
