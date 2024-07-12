<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\ModelsExtended\News;

class NewsController extends Controller
{
    public function index()
    {
        $latest = News::where('featured', 1)->orderBy("date", "desc")->first();
        $news_list = News::orderBy("date", "desc")->paginate(15);
        return view('Front.news', [
            'latest' => $latest,
            'news_list' => $news_list,
            'og_title' => 'News - Paramount Realty',
            'og_description' => 'News - Paramount Realty',
        ]);
    }

    public function newsView($slug)
    {
        $news = News::where('seourl', $slug)->first();
        return view('Front.news_view', [
            'news' => $news,
            'og_title' => $news->title,
            'og_description' => $news->short_content,
        ]);
    }
}
