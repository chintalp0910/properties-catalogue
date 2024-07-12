<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Demographic
 * 
 * @property int $id
 * @property string $lable1
 * @property string $lable2
 * @property string $lable3
 * @property string $title
 * @property int $property_id
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Demographic extends Model
{
	protected $table = 'demographic';

	protected $casts = [
		'property_id' => 'int',
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'lable1',
		'lable2',
		'lable3',
		'title',
		'property_id',
		'a4a_sort'
	];
}
