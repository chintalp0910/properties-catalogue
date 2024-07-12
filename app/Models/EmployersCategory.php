<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployersCategory
 * 
 * @property int $id
 * @property string $title
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class EmployersCategory extends Model
{
	protected $table = 'employers_categories';

	protected $casts = [
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'title',
		'a4a_sort'
	];
}
