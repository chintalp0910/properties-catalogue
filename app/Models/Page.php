<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $seotitle
 * @property string $seodescription
 * @property string $seourl
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $a4a_dynamicFields
 * @property string $file
 *
 * @package App\Models
 */
class Page extends Model
{
	protected $table = 'pages';

	protected $fillable = [
		'title',
		'content',
		'image',
		'seotitle',
		'seodescription',
		'seourl',
		'a4a_dynamicFields',
		'file'
	];
}
