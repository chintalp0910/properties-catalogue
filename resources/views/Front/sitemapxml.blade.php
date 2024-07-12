<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ URL::to('/home') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    <url>
        <loc>{{ URL::to('/companies') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    <url>
        <loc>{{ URL::to('/team') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    <url>
        <loc>{{ URL::to('/contact-us') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    <url>
        <loc>{{ URL::to('/properties') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    @foreach ($properties as $property)
        <url>
            <loc>{{ URL::to('/properties-view') . '/' . $property->slug }}</loc>
            <lastmod>{{ date('d-m-Y') }}</lastmod>
        </url>
    @endforeach

    <url>
        <loc>{{ URL::to('/news') }}</loc>
        <lastmod>{{ date('d-m-Y') }}</lastmod>
    </url>
    @foreach ($news_list as $news)
        <url>
            <loc>{{ URL::to('/news-view') . '/' . $news->seourl }}</loc>
            <lastmod>{{ date('d-m-Y') }}</lastmod>
        </url>
    @endforeach
</urlset>
