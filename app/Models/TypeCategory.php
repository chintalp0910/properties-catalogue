<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeCategory
 * 
 * @property int $id
 * @property string $title
 * @property string $seo_url
 *
 * @package App\Models
 */
class TypeCategory extends Model
{
	protected $table = 'type_categories';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'seo_url'
	];
}
