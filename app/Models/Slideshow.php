<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Slideshow
 * 
 * @property int $id
 * @property string $image
 * @property string $imagetitle
 * @property int $a4a_sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $content
 * @property string $link
 * @property string $title
 * @property string $link_title
 *
 * @package App\Models
 */
class Slideshow extends Model
{
	protected $table = 'slideshow';

	protected $casts = [
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'image',
		'imagetitle',
		'a4a_sort',
		'content',
		'link',
		'title',
		'link_title'
	];
}
