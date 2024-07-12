<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agent
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $created_by_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $fax
 * @property string|null $category
 * @property int|null $a4a_sort
 * @property string|null $image_relative_url
 * 
 * @property User $user
 * @property Collection|Property[] $properties
 *
 * @package App\Models
 */
class Agent extends Model
{
	protected $table = 'agent';

	protected $casts = [
		'created_by_id' => 'int',
		'a4a_sort' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'created_by_id',
		'first_name',
		'last_name',
		'fax',
		'category',
		'a4a_sort',
		'image_relative_url'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function properties()
	{
		return $this->belongsToMany(Property::class, 'property_agent')
					->withPivot('id')
					->withTimestamps();
	}
}
