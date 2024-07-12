<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $url
 * @property string $location
 * @property Carbon $date
 * @property string $seotitle
 * @property string $seodescription
 * @property string $seourl
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';

	protected $casts = [
		'a4a_sort' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'title',
		'content',
		'image',
		'url',
		'location',
		'date',
		'seotitle',
		'seodescription',
		'seourl',
		'a4a_sort'
	];
}
