<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropertyAgent
 * 
 * @property int $id
 * @property int $property_id
 * @property int $agent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Agent $agent
 * @property Property $property
 *
 * @package App\Models
 */
class PropertyAgent extends Model
{
	protected $table = 'property_agent';

	protected $casts = [
		'property_id' => 'int',
		'agent_id' => 'int'
	];

	protected $fillable = [
		'property_id',
		'agent_id'
	];

	public function agent()
	{
		return $this->belongsTo(Agent::class);
	}

	public function property()
	{
		return $this->belongsTo(Property::class);
	}
}
