<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string|null $category
 * @property Carbon $date
 * @property string|null $seotitle
 * @property string|null $seodescription
 * @property string|null $seourl
 * @property int|null $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $short_content
 * @property int $featured
 * @property string|null $publish_by
 * @property string|null $tag
 * @property int|null $author_id
 * 
 * @property Author|null $author
 *
 * @package App\Models
 */
class News extends Model
{
	protected $table = 'news';

	protected $casts = [
		'a4a_sort' => 'int',
		'featured' => 'int',
		'author_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'title',
		'content',
		'image',
		'category',
		'date',
		'seotitle',
		'seodescription',
		'seourl',
		'a4a_sort',
		'short_content',
		'featured',
		'publish_by',
		'tag',
		'author_id'
	];

	public function author()
	{
		return $this->belongsTo(Author::class);
	}
}
