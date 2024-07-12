<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 * 
 * @property int $id
 * @property string $state
 * @property string $abbreviation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class State extends Model
{
	protected $table = 'states';

	protected $fillable = [
		'state',
		'abbreviation'
	];
}
