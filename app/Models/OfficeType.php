<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfficeType
 * 
 * @property int $id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Employer[] $employers
 *
 * @package App\Models
 */
class OfficeType extends Model
{
	protected $table = 'office_type';

	protected $fillable = [
		'description'
	];

	public function employers()
	{
		return $this->hasMany(Employer::class);
	}
}
