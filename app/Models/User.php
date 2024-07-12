<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $role_id
 * @property int|null $organization_id
 * @property string|null $phone
 * @property string|null $image_relative_url
 * 
 * @property Organization|null $organization
 * @property Role|null $role
 * @property Collection|Agent[] $agents
 * @property Collection|Property[] $properties
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'role_id' => 'int',
		'organization_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'role_id',
		'organization_id',
		'phone',
		'image_relative_url'
	];

	public function organization()
	{
		return $this->belongsTo(Organization::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function agents()
	{
		return $this->hasMany(Agent::class, 'created_by_id');
	}

	public function properties()
	{
		return $this->hasMany(Property::class, 'created_by_id');
	}
}
