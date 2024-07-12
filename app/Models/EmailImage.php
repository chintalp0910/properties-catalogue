<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailImage
 * 
 * @property int $id
 * @property string $image
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class EmailImage extends Model
{
	protected $table = 'email_images';

	protected $fillable = [
		'image'
	];
}
