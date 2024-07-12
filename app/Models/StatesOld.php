<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatesOld
 * 
 * @property int $id
 * @property string $state
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class StatesOld extends Model
{
	protected $table = 'states_old';

	protected $fillable = [
		'state'
	];
}
