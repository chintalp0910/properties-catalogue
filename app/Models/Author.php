<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * 
 * @property int $id
 * @property string $name
 * @property string|null $short_description
 * @property string|null $image_relative_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|News[] $news
 *
 * @package App\Models
 */
class Author extends Model
{
	protected $table = 'authors';

	protected $fillable = [
		'name',
		'short_description',
		'image_relative_url'
	];

	public function news()
	{
		return $this->hasMany(News::class);
	}
}
