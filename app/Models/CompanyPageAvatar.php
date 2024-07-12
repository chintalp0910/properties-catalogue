<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyPageAvatar
 * 
 * @property int $id
 * @property string $image_name
 * @property int $sort_order
 * @property string $image_color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class CompanyPageAvatar extends Model
{
	protected $table = 'company_page_avatar';

	protected $casts = [
		'sort_order' => 'int'
	];

	protected $fillable = [
		'image_name',
		'sort_order',
		'image_color'
	];
}
