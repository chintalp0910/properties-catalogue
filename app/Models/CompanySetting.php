<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanySetting
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $p_image
 * @property string|null $map_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CompanySetting extends Model
{
	protected $table = 'company_settings';

	protected $fillable = [
		'title',
		'description',
		'p_image',
		'map_image'
	];
}
