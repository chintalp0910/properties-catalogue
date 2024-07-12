<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyCategory
 * 
 * @property int $id
 * @property string $title
 * @property int $a4a_sort
 *
 * @package App\Models
 */
class PropertyCategory extends Model
{
	protected $table = 'property_categories';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'id',
		'title',
		'a4a_sort'
	];
}
