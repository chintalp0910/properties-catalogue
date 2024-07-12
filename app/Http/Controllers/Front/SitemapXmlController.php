<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\ModelsExtended\News;
use App\ModelsExtended\Property;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function index()
    {
        $properties = Property::orderBy("gla", "desc")->get();
        $news_list = News::orderBy("date", "desc")->get();

        return response()->view('Front.sitemapxml', [
            'properties' => $properties,
            'news_list' => $news_list
        ])->header('Content-Type', 'text/xml');
    }
}
