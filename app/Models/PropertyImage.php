<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyImage
 * 
 * @property int $id
 * @property string $image
 * @property string $image_title
 * @property int $property_id
 * @property int $a4a_sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class PropertyImage extends Model
{
	protected $table = 'property_images';

	protected $casts = [
		'property_id' => 'int',
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'image',
		'image_title',
		'property_id',
		'a4a_sort'
	];
}
