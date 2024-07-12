<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CopySf
 * 
 * @property int $id
 * @property int $value
 * @property int $property_id
 *
 * @package App\Models
 */
class CopySf extends Model
{
	protected $table = 'copy_sf';
	public $timestamps = false;

	protected $casts = [
		'value' => 'int',
		'property_id' => 'int'
	];

	protected $fillable = [
		'value',
		'property_id'
	];
}
