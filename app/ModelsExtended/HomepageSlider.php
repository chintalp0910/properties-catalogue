<?php

namespace App\ModelsExtended;

class HomepageSlider extends \App\Models\HomepageSlider
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getHomePageSliderImages()
    {
        $objectArray = self::getJsonObject('hero_slider');
        if( $objectArray )
            return collect($objectArray)->sortBy( function ($item){
                return $item->order??0;
            } );

        return collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getCarouselSliderImages()
    {
        $objectArray = self::getJsonObject('carousel_slider');
        if( $objectArray )
            return collect($objectArray)->sortBy( function ($item){
                return $item->order??0;
            } );

        return collect();
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    private static function getJsonObject(string $key)
    {
        $v = self::query()->where("key", $key)->first();
        return $v ? json_decode($v->value) : null;
    }
}
