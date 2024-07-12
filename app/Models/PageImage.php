<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageImage
 * 
 * @property int $id
 * @property string $image
 * @property string $image_title
 * @property int $page_id
 * @property int $a4a_sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class PageImage extends Model
{
	protected $table = 'page_images';

	protected $casts = [
		'page_id' => 'int',
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'image',
		'image_title',
		'page_id',
		'a4a_sort'
	];
}
