<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Redirect
 * 
 * @property int $id
 * @property string $from
 * @property string $to
 *
 * @package App\Models
 */
class Redirect extends Model
{
	protected $table = 'redirect';
	public $timestamps = false;

	protected $fillable = [
		'from',
		'to'
	];
}
