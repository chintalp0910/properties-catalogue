<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\ModelsExtended\HomepageSlider;
use App\ModelsExtended\News;
use App\ModelsExtended\Property;
use App\ModelsExtended\PropertyStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function landingPage()
    {
        return view('Front.landing_page');
    }

    public function home()
    {
        if (Property::getActiveFeaturedPropertyCount()) {
            $properties = Property::getActiveFeaturedProperties(6)
                //  ->latest()
                 ->orderBy('orderby_featured', 'ASC')
                 ->get();
                //   ->sortByDesc("gla");
        } else {
            $properties = Property::getActiveProperties(6)
                ->latest()
                ->get()
                ->sortByDesc("gla");
        }

        $homeSlider = HomepageSlider::getHomePageSliderImages();
        $carouselSlider = HomepageSlider::getCarouselSliderImages();

        $news_list = News::orderBy('date', 'desc')->take(4)->get();
        return view('Front.home', [
            'properties' => $properties,
            'news_list' => $news_list,
            'homepageSliderCollections' => HomepageSlider::get(),
            'homeSlider' => $homeSlider,
            'carouselSlider' => $carouselSlider,
            'og_title' => 'Paramount Realty',
            'og_description' => 'Paramount Realty, Shopping Center, Single Tenant, Medical Office, Under Development, Mixed Use, Warehouse, Pad Sites',
        ]);
    }

    public function setImageCached($src)
    {
        $cdn_image = $this->getImage($src);
        $img = Image::cache(function ($img) use ($cdn_image) {
            return $img->make($cdn_image);
        }, 10);
        return Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
    }

    public function propertySearch(Request $request)
    {
        $properties = Property::select('id', 'name', 'slug')
        ->where('name', 'like', '%' . $request->search . '%')
        ->orWhere('city', 'like', '%' . $request->search . '%')
        ->orWhere('state', 'like', '%' . $request->search . '%')
        ->orWhere('short_state_name', 'like', '%' . $request->search . '%')
        ->get();

        $html = '';
        $html .= '<div>';
        $html .= '<ul>';
        foreach ($properties as $property) {
            $html .= ' <li><a href="' . route('properties.view', $property->slug) . '">' . $property->name . ' </a></li>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        return response()->json([
            'status' => 'SUCCESS',
            'data' => $html,
        ]);
    }
}
