<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyPicture
 * 
 * @property int $id
 * @property int $property_id
 * @property string $image_relative_url
 * @property int|null $image_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Property $property
 *
 * @package App\Models
 */
class PropertyPicture extends Model
{
	protected $table = 'property_picture';

	protected $casts = [
		'property_id' => 'int',
		'image_order' => 'int'
	];

	protected $fillable = [
		'property_id',
		'image_relative_url',
		'image_order'
	];

	public function property()
	{
		return $this->belongsTo(Property::class);
	}
}
