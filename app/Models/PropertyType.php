<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyType
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|Property[] $properties
 *
 * @package App\Models
 */
class PropertyType extends Model
{
	protected $table = 'property_type';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function properties()
	{
		return $this->hasMany(Property::class);
	}
}
