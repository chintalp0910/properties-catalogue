<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tenant
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $agents
 * @property string $image
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property int|null $lms_id
 *
 * @package App\Models
 */
class Tenant extends Model
{
	protected $table = 'tenant';

	protected $casts = [
		'a4a_sort' => 'int',
		'lms_id' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'agents',
		'image',
		'a4a_sort',
		'lms_id'
	];
}
