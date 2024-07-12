<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployersController;
use App\Http\Controllers\Admin\HomepageSliderController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\RealityNewsController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CompanyController;
use App\Http\Controllers\Front\ContactUsController;
use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\OurTeamController;
use App\Http\Controllers\Front\PropertiesController as FrontPropertiesController;
use App\Http\Controllers\Front\ShoppingCenterController;
use App\Http\Controllers\Front\SitemapXmlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Route::prefix("admin")->group(function () {

    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*PropertiesController*/
        // Route::get('properties_all', [PropertiesController::class, 'properties_list'])->name('properties_all');
        // Route::get('property_add', [PropertiesController::class, 'property_add'])->name('property_add');
        // Route::get('add_category', [PropertiesController::class, 'add_category'])->name('add_category');

        Route::post('properties_creat', 'App\Http\Controllers\Admin\PropertiesController@properties_create')->name('properties_creat');
        Route::DELETE('/ delete_property/{id}', 'App\Http\Controllers\Admin\PropertiesController@delete_property');
        Route::get('/edit_from/{id}', 'App\Http\Controllers\Admin\PropertiesController@edit_from');
        Route::post('/properties_update', 'App\Http\Controllers\Admin\PropertiesController@properties_update')->name('properties_update');
        Route::get('/ view_property/{id}', 'App\Http\Controllers\Admin\PropertiesController@view_property');

        /*category*/
        // Route::get('add_category', [PropertiesController::class, 'add_category'])->name('add_category');

        /*Agent*/
        Route::resource('agents', AgentController::class);
        Route::post('agents/bulk-delete', [AgentController::class, 'bulkDelete'])->name('agents.bulkDelete');

        /*Properties*/
        Route::resource('properties', PropertiesController::class);
        Route::post('properties/bulk-delete', [PropertiesController::class, 'bulkDelete'])->name('properties.bulkDelete');
        Route::get('properties/delete-image/{id}', [PropertiesController::class, 'deleteImage'])->name('properties.deleteImage');
        Route::get('properties/delete-anchor-tenant/{id}/{name}', [PropertiesController::class, 'deleteAnchorTenant'])->name('properties.deleteAnchorTenant');
        Route::get('properties/remove-document/{id}/{name}', [PropertiesController::class, 'removeDocument'])->name('properties.removeDocument');
        Route::post('properties/change-image-order/{id}', [PropertiesController::class, 'changeImageOrder'])->name('properties.changeImageOrder');

        /*Users*/
        Route::match(['GET', 'POST'], 'change-password', [AdministratorController::class, 'changePassword'])->name('administrator.changePassword');
        Route::resource('administrator', AdministratorController::class);

        /*Reality News*/
        Route::resource('reality-news', RealityNewsController::class);
        Route::post('reality-news/bulk-delete', [RealityNewsController::class, 'bulkDelete'])->name('reality-news.bulkDelete');

        /*Employers*/
        Route::resource('employers', EmployersController::class);

        /*Categories*/
        Route::resource('categories', CategoriesController::class);

        /*Property Type*/
        Route::resource('property-type', PropertyTypeController::class);

        /*Authors*/
        Route::resource('authors', AuthorsController::class);

        /*Settings*/
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('settings/update', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('company-page-settings', [SettingsController::class, 'companyPage'])->name('settings.companyPage');
        Route::get('company-page-settings/remove-image/{id}/', [SettingsController::class, 'deleteCompanyPageAvatar'])->name('settings.deleteCompanyPageAvatar');
        Route::post('company-page-settings/change-image-color/{id}', [SettingsController::class, 'changeImageColorAndOrder'])->name('settings.changeImageColorAndOrder');
        Route::put('company-page-settings/update', [SettingsController::class, 'updateCompanyPageSetting'])->name('settings.updateCompanyPageSetting');

        /*Homepage Slider*/
        Route::get('homepage-slider', [HomepageSliderController::class, 'index'])->name('homepageSlider');
        Route::put('homepage-slider/update', [HomepageSliderController::class, 'update'])->name('homepageSlider.update');
        Route::get('homepage-slider/delete/{id}/{name}', [HomepageSliderController::class, 'deleteSlider'])->name('homepageSlider.delete');
        Route::post('homepage-slider/change-order/{id}/{name}', [HomepageSliderController::class, 'changeSliderOrder'])->name('homepageSlider.changeSliderOrder');
    });

    require __DIR__ . '/auth.php';
});

//
//
///*UserController*/
//// Route::get('/', 'App\Http\Controllers\Admin\UserController@login');
//
//Route::post('login', [UserController::class, 'adminlogin']); //->name('member_list')
//Route::get('login', function () {
//    if (session()->has('user')) {
//        return Redirect('index');
//    }
//    return view('login');
//});
//Route::get('/logout', [UserController::class, 'logout']);

/* Start front route */
Route::get('/', [HomeController::class, 'landingPage'])->name('landingPage')->middleware('UrlRedirection');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('search-properties-list', [HomeController::class, 'propertySearch'])->name('home.propertySearch');

/*Properties*/
Route::get('properties', [FrontPropertiesController::class, 'index'])->name('properties');
Route::get('properties-view/{slug}', [FrontPropertiesController::class, 'propertiesView'])->name('properties.view');
Route::get('properties-search/{search?}', [FrontPropertiesController::class, 'propertiesSearch'])->name('properties.search');
Route::get('properties-map-view', [FrontPropertiesController::class, 'splitView'])->name('properties.mapview');
Route::get('properties-under-development', [FrontPropertiesController::class, 'underDevelopment'])->name('properties.underDevelopment');
Route::get('properties-type/{type?}', [FrontPropertiesController::class, 'getProperties'])->name('properties.getProperties');
// Route::get('properties-split-view', [FrontPropertiesController::class, 'splitView'])->name('properties.splitView');

/*Our Team*/
Route::get('team', [OurTeamController::class, 'index'])->name('team');

/*News*/
Route::get('news', [NewsController::class, 'index'])->name('news');
Route::get('news-view/{slug}', [NewsController::class, 'newsView'])->name('news.view');

/*Company*/
Route::get('companies', [CompanyController::class, 'index'])->name('company');

/*Contact US*/
Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactUs');
Route::post('send-email', [ContactUsController::class, 'sendMail'])->name('contactUs.sendMail');
Route::get('reload-captcha', [ContactUsController::class, 'reloadCaptcha'])->name('reloadCaptcha');

/* sitemap.xml */
Route::get('sitemap.xml', [SitemapXmlController::class, 'index']);

/*Shopping Center*/
// Route::get('shopping-center', [ShoppingCenterController::class, 'index'])->name('shoppingCenter');
// Route::get('shopping-center-view/{slug}', [ShoppingCenterController::class, 'shoppingCenterView'])->name('shoppingCenter.view');

/*Start image cache route*/
Route::get('/assets/front/images/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/site_plan/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/property_image/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/news_image/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/gallery/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/employer_image/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/images/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/authors/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/homepage/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/news/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/setting/company/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/brochure_relative/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/properties/anchor_tenant/{src}/', [HomeController::class, 'setImageCached']);
Route::get('/uploads/agents/{id}/pictures/{src}/', [HomeController::class, 'setImageCached']);

/* End front route */



//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//
