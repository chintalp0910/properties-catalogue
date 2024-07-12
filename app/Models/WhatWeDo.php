<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WhatWeDo
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $image
 *
 * @package App\Models
 */
class WhatWeDo extends Model
{
	protected $table = 'what_we_do';

	protected $casts = [
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'a4a_sort',
		'image'
	];
}
