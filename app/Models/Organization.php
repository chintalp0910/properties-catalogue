<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organization
 * 
 * @property int $id
 * @property string $description
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Organization extends Model
{
	protected $table = 'organization';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
