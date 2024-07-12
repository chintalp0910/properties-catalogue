<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OldProperty
 * 
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $a4a_sort
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property string $country
 * @property string $municipality
 * @property string $type
 * @property int $show
 * @property float $gla
 * @property string $built
 * @property string $location
 * @property string $parking
 * @property string $zoning
 * @property string $a4a_map_mapLat
 * @property string $a4a_map_mapLng
 * @property string $description
 * @property string $seourl
 * @property string $seotitle
 * @property string $seodescription
 * @property string $agents
 * @property int $featured
 * @property string $comp_aerial
 * @property string $space
 * @property string $tenants
 * @property string $city
 * @property string|null $demographic_header
 * @property string $header_image
 * @property string $site_plan_jpg
 * @property string $brochure
 * @property string $third_party_link
 * @property int $availabilities
 * @property int $third_party
 * @property int $category
 * @property string $zip
 * @property bool $under_development
 * @property string $under_development_info
 * @property bool $self_storage
 * @property string|null $facebook
 * @property int $sync
 * @property int $type_category
 * @property int|null $sort_position
 *
 * @package App\Models
 */
class OldProperty extends Model
{
	protected $table = 'old_property';

	protected $casts = [
		'a4a_sort' => 'int',
		'show' => 'int',
		'gla' => 'float',
		'featured' => 'int',
		'availabilities' => 'int',
		'third_party' => 'int',
		'category' => 'int',
		'under_development' => 'bool',
		'self_storage' => 'bool',
		'sync' => 'int',
		'type_category' => 'int',
		'sort_position' => 'int'
	];

	protected $fillable = [
		'title',
		'image',
		'a4a_sort',
		'country',
		'municipality',
		'type',
		'show',
		'gla',
		'built',
		'location',
		'parking',
		'zoning',
		'a4a_map_mapLat',
		'a4a_map_mapLng',
		'description',
		'seourl',
		'seotitle',
		'seodescription',
		'agents',
		'featured',
		'comp_aerial',
		'space',
		'tenants',
		'city',
		'demographic_header',
		'header_image',
		'site_plan_jpg',
		'brochure',
		'third_party_link',
		'availabilities',
		'third_party',
		'category',
		'zip',
		'under_development',
		'under_development_info',
		'self_storage',
		'facebook',
		'sync',
		'type_category',
		'sort_position'
	];
}
