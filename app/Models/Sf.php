<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sf
 * 
 * @property int $id
 * @property int $value
 * @property int $property_id
 *
 * @package App\Models
 */
class Sf extends Model
{
	protected $table = 'sf';
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
