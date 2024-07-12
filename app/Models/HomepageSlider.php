<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HomepageSlider
 * 
 * @property int $id
 * @property string|null $title
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class HomepageSlider extends Model
{
	protected $table = 'homepage_slider';

	protected $fillable = [
		'title',
		'key',
		'value'
	];
}
