<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 * 
 * @property int $id
 * @property string $property_id
 * @property string $image
 * @property string $updated_by
 * @property string $created_by
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Gallery extends Model
{
	protected $table = 'galleries';

	protected $casts = [
		'status' => 'int'
	];

	protected $fillable = [
		'property_id',
		'image',
		'updated_by',
		'created_by',
		'status'
	];
}
