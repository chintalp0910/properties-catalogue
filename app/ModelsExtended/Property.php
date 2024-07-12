<?php

namespace App\ModelsExtended;

use App\Models\PropertyAgent;
use App\ModelsExtended\Traits\PropertyLocalImageRelativeTrait;
use App\Repositories\Maps\GoogleMaps\GoogleAddressComponent;
use App\Repositories\Maps\GoogleMaps\GoogleMapAddressAnalyzer;
use App\Repositories\Maps\GoogleMaps\GoogleMapGeoAddressAnalyzer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property Collection|PropertyPicture[] $property_pictures
 */
class Property extends \App\Models\Property
{

    use HasSlug;
    use PropertyLocalImageRelativeTrait;

    public function property_pictures()
    {
        return $this->hasMany(PropertyPicture::class);
    }

    /**
     * @param int $id
     * @return Property|null
     */
    public static function getById(int $id): ?Property
    {
        return self::find($id);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function agents()
	{
		return $this->hasMany(PropertyAgent::class);
	}

    /**
     * @return int
     */
    public static function getActiveFeaturedPropertyCount(): int
    {
        return self::getActiveFeaturedProperties()->count();
    }

    /**
     * @param int|null $limit
     * @return Builder|\Illuminate\Support\HigherOrderWhenProxy|mixed
     */
    public static function getActiveFeaturedProperties(?int $limit = null)
    {
        return self::getActiveProperties($limit)
            ->where('featured', true);
    }

    /**
     * @param int|null $limit
     * @return Builder|\Illuminate\Support\HigherOrderWhenProxy|mixed
     */
    public static function getActiveProperties(?int $limit = null)
    {
        return self::query()
            ->where('property_status_id', PropertyStatus::ACTIVE)
            ->when($limit, function (Builder $builder) use ($limit) {
                return $builder->limit($limit);
            });
    }

    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setShortStateNameUsingGoogleApi(): static
    {
        //    Checks if there is Lat and Log
        //      == Use this to fetch the Short State Name
        //      == > If found, use it
        //      ==>    else choose first 2 letters of the state.
        //    If NO Lat and Log
        //      == Use combination of [address zip city state ] to search
        //      == Use this to fetch the Short State Name
        //      == > If found, use it
        //      ==>    else choose first 2 letters of the state.
        if( $this->latitude && $this->longitude )
        {
            $analyzer  = new GoogleMapGeoAddressAnalyzer( $this->latitude, $this->longitude );
            return $this->setStateInfoUsingComponent( $analyzer->getAddressComponent() );
        }else{
            $analyzer  = new GoogleMapAddressAnalyzer( (string)
                    Str::of( sprintf( "%s %s %s %s" ,
                        $this->address, $this->zip, $this->city, $this->state ) )
                    ->replace("  ", " ")
            );
            return $this->setStateInfoUsingComponent( $analyzer->getAddressComponent() );
        }
    }

    /**
     * @param GoogleAddressComponent|null $addressComponent
     * @return $this
     */
    private function setStateInfoUsingComponent(?GoogleAddressComponent $addressComponent): static
    {
        if(  $addressComponent && $addressComponent->getState() )
        {
            $this->state = $addressComponent->getState();
            $this->short_state_name = $addressComponent->getStateComponent()->short_name;
            $this->zip = $addressComponent->getPostalCode();
            $this->longitude = $addressComponent->getLng();
            $this->latitude = $addressComponent->getLat();

        }else{
            $this->short_state_name = $this->short_state_name?? (string)Str::of($this->state)->upper()->substr(0,2);
        }

        return $this;
    }

//    public function images()
//    {
//        return $this->hasMany(PropertyImage::class, 'property_id', 'id' );
//    }
}