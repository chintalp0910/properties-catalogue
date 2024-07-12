<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OldAgent
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $category
 * @property int $a4a_sort
 *
 * @package App\Models
 */
class OldAgent extends Model
{
	protected $table = 'old_agents';

	protected $casts = [
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'phone',
		'fax',
		'email',
		'category',
		'a4a_sort'
	];
}
