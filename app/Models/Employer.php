<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employer
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string|null $fax
 * @property string $email
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $category
 * @property int $a4a_sort
 * @property string|null $position
 * @property string|null $image_relative_url
 * @property int|null $break_display_after
 * @property int|null $office_type_id
 * 
 * @property OfficeType|null $office_type
 *
 * @package App\Models
 */
class Employer extends Model
{
	protected $table = 'employers';

	protected $casts = [
		'a4a_sort' => 'int',
		'break_display_after' => 'int',
		'office_type_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'phone',
		'fax',
		'email',
		'category',
		'a4a_sort',
		'position',
		'image_relative_url',
		'break_display_after',
		'office_type_id'
	];

	public function office_type()
	{
		return $this->belongsTo(OfficeType::class);
	}
}
