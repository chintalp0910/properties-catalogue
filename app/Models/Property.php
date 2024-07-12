<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Property
 * 
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string $state
 * @property string $city
 * @property string $square_foot
 * @property int $property_type_id
 * @property int $property_status_id
 * @property string|null $address
 * @property string|null $brochure_relative_url
 * @property string|null $site_plan_relative_url
 * @property string|null $longitude
 * @property string|null $latitude
 * @property int $created_by_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $image_relative_url
 * @property int $a4a_sort
 * @property string|null $country
 * @property string|null $municipality
 * @property float|null $gla
 * @property string|null $built
 * @property string|null $parking
 * @property string|null $zoning
 * @property string|null $description
 * @property string|null $seourl
 * @property string|null $seotitle
 * @property string|null $seodescription
 * @property bool $featured
 * @property string|null $comp_aerial
 * @property string|null $space
 * @property string|null $demographic_header
 * @property string|null $header_image
 * @property string|null $third_party_link
 * @property string|null $zip
 * @property bool $under_development
 * @property string|null $under_development_info
 * @property bool $self_storage
 * @property string|null $facebook
 * @property bool $sync
 * @property int|null $property_old_category_id
 * @property int|null $property_old_type_category_id
 * @property int|null $sort_position
 * @property string|null $anchor_tenant
 * @property int $show_in_map
 * @property int|null $orderby_featured
 * @property string|null $short_state_name
 * 
 * @property User $user
 * @property PropertyStatus $property_status
 * @property PropertyType $property_type
 * @property Collection|Agent[] $agents
 * @property Collection|PropertyDemographic[] $property_demographics
 * @property Collection|PropertyPicture[] $property_pictures
 *
 * @package App\Models
 */
class Property extends Model
{
	protected $table = 'property';

	protected $casts = [
		'property_type_id' => 'int',
		'property_status_id' => 'int',
		'created_by_id' => 'int',
		'a4a_sort' => 'int',
		'gla' => 'float',
		'featured' => 'bool',
		'under_development' => 'bool',
		'self_storage' => 'bool',
		'sync' => 'bool',
		'property_old_category_id' => 'int',
		'property_old_type_category_id' => 'int',
		'sort_position' => 'int',
		'show_in_map' => 'int',
		'orderby_featured' => 'int'
	];

	protected $fillable = [
		'name',
		'slug',
		'state',
		'city',
		'square_foot',
		'property_type_id',
		'property_status_id',
		'address',
		'brochure_relative_url',
		'site_plan_relative_url',
		'longitude',
		'latitude',
		'created_by_id',
		'image_relative_url',
		'a4a_sort',
		'country',
		'municipality',
		'gla',
		'built',
		'parking',
		'zoning',
		'description',
		'seourl',
		'seotitle',
		'seodescription',
		'featured',
		'comp_aerial',
		'space',
		'demographic_header',
		'header_image',
		'third_party_link',
		'zip',
		'under_development',
		'under_development_info',
		'self_storage',
		'facebook',
		'sync',
		'property_old_category_id',
		'property_old_type_category_id',
		'sort_position',
		'anchor_tenant',
		'show_in_map',
		'orderby_featured',
		'short_state_name'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function property_status()
	{
		return $this->belongsTo(PropertyStatus::class);
	}

	public function property_type()
	{
		return $this->belongsTo(PropertyType::class);
	}

	public function agents()
	{
		return $this->belongsToMany(Agent::class, 'property_agent')
					->withPivot('id')
					->withTimestamps();
	}

	public function property_demographics()
	{
		return $this->hasMany(PropertyDemographic::class);
	}

	public function property_pictures()
	{
		return $this->hasMany(PropertyPicture::class)->orderBy('image_order', 'ASC');
	}
}
