<?php

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

use App\Http\Middleware\CheckAdmin;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', CheckAdmin::class]],
    function (){
    Route::get('/', 'DashboardController@dashboard')->name('admin');

    Route::prefix('university')->group(function () {
        Route::get('/', 'UniversityController@index')->name('admin.vuz');
        Route::get('/add', 'UniversityController@getAdd');
        Route::get('/add/{id}', 'UniversityController@getAdd');
        Route::post('/add', 'UniversityController@postAdd');
        Route::post('/add/{id}', 'UniversityController@postAdd');
        Route::get('/view/{id}', 'UniversityController@getView');
        Route::get('/delete/{id}', 'UniversityController@getDelete');
    });
    Route::prefix('college')->group(function () {
        Route::get('/', 'CollegeController@index')->name('admin.college');
        Route::get('/add', 'CollegeController@getAdd');
        Route::get('/add/{id}', 'CollegeController@getAdd');
        Route::post('/add', 'CollegeController@postAdd');
        Route::post('/add/{id}', 'CollegeController@postAdd');
        Route::get('/view/{id}', 'CollegeController@getView');
        Route::get('/delete/{id}', 'CollegeController@getDelete');
    });
    Route::prefix('degree')->group(function (){
        Route::get('/', 'DegreeController@index');
        Route::get('/add', 'DegreeController@getAdd');
        Route::get('/add/{id}', 'DegreeController@getAdd');
        Route::post('/add', 'DegreeController@postAdd');
        Route::post('/add/{id}', 'DegreeController@postAdd');
        Route::get('/delete/{id}', 'DegreeController@getDelete');
    });
    Route::prefix('sphere')->group(function () {
        Route::get('/', 'SpheresController@index');
        Route::get('/add', 'SpheresController@getAdd');
        Route::get('/add/{id}', 'SpheresController@getAdd');
        Route::post('/add', 'SpheresController@postAdd');
        Route::post('/add/{id}', 'SpheresController@postAdd');
        Route::get('/delete/{id}', 'SpheresController@getDelete');
    });
    Route::prefix('direction')->group(function () {
        Route::get('/', 'DirectionController@index');
        Route::get('/add', 'DirectionController@getAdd');
        Route::get('/add/{id}', 'DirectionController@getAdd');
        Route::post('/add', 'DirectionController@postAdd');
        Route::post('/add/{id}', 'DirectionController@postAdd');
        Route::get('/view/{id}', 'DirectionController@getView');
        Route::get('/delete/{id}', 'DirectionController@getDelete');
    });
    Route::prefix('subdirection')->group(function () {
        Route::get('/', 'SubdirectionController@index');
        Route::get('/add', 'SubdirectionController@getAdd');
        Route::get('/add/{id}', 'SubdirectionController@getAdd');
        Route::post('/add', 'SubdirectionController@postAdd');
        Route::post('/add/{id}', 'SubdirectionController@postAdd');
        Route::get('/view/{id}', 'SubdirectionController@getView');
        Route::get('/delete/{id}', 'SubdirectionController@getDelete');
    });
    Route::prefix('group')->group(function () {
        Route::get('/{d}', 'LearnProgramGroupsController@index')->name('admin.group');
        Route::get('/{d}/add', 'LearnProgramGroupsController@getAdd');
        Route::get('/{d}/add/{id}', 'LearnProgramGroupsController@getAdd');
        Route::post('/{d}/add', 'LearnProgramGroupsController@postAdd');
        Route::post('/{d}/add/{id}', 'LearnProgramGroupsController@postAdd');
        Route::get('/{d}/delete/{id}', 'LearnProgramGroupsController@getDelete');
    });
    Route::prefix('income')->group(function (){
        Route::get('/{t}', 'IncomesController@index');
        Route::get('/add/{t}', 'IncomesController@getAdd');
        Route::get('/add/{t}/{id}', 'IncomesController@getAdd');
        Route::post('/add/{t}', 'IncomesController@postAdd');
        Route::post('/add/{t}/{id}', 'IncomesController@postAdd');
        Route::get('/delete/{t}/{id}', 'IncomesController@getDelete');
    });
    Route::prefix('education-form')->group(function (){
        Route::get('/', 'EducationFormsController@index');
        Route::get('/add', 'EducationFormsController@getAdd');
        Route::get('/add/{id}', 'EducationFormsController@getAdd');
        Route::post('/add', 'EducationFormsController@postAdd');
        Route::post('/add/{id}', 'EducationFormsController@postAdd');
        Route::get('/delete/{id}', 'EducationFormsController@getDelete');
    });
    Route::prefix('type')->group(function (){
        Route::get('/', 'TypesController@index');
        Route::get('/add', 'TypesController@getAdd');
        Route::get('/add/{id}', 'TypesController@getAdd');
        Route::post('/add', 'TypesController@postAdd');
        Route::post('/add/{id}', 'TypesController@postAdd');
        Route::get('/delete/{id}', 'TypesController@getDelete');
    });
    Route::prefix('subject')->group(function () {
        Route::get('/{t}', 'SubjectController@index')->name('admin.subject');
        Route::get('/{t}/add', 'SubjectController@getAdd');
        Route::get('/{t}/add/{id}', 'SubjectController@getAdd');
        Route::post('/{t}/add', 'SubjectController@postAdd');
        Route::post('/{t}/add/{id}', 'SubjectController@postAdd');
        Route::get('/{t}/delete/{id}', 'SubjectController@getDelete');
    });
    Route::prefix('specialty')->group(function () {
        Route::get('/', 'SpecialtyController@index');
        Route::get('/add', 'SpecialtyController@getAdd');
        Route::get('/add/{id}', 'SpecialtyController@getAdd');
        Route::post('/add', 'SpecialtyController@postAdd');
        Route::post('/add/{id}', 'SpecialtyController@postAdd');
        Route::get('/view/{id}', 'SpecialtyController@getView');
        Route::get('/delete/{id}', 'SpecialtyController@getDelete');
    });
    Route::prefix('qualification')->group(function () {
        Route::get('ajax', 'QualificationsController@ajax');
        Route::get('/{t}', 'QualificationsController@index')->name('admin.qualification');
        Route::get('/{t}/add', 'QualificationsController@getAdd');
        Route::get('/{t}/add/{id}', 'QualificationsController@getAdd');
        Route::post('/{t}/add', 'QualificationsController@postAdd');
        Route::post('/{t}/add/{id}', 'QualificationsController@postAdd');
        Route::get('/{t}/view/{id}', 'QualificationsController@getView');
        Route::get('/{t}/delete/{id}', 'QualificationsController@getDelete');
    });
    Route::prefix('qualification-in')->group(function () {
        Route::get('/{t}', 'QualificationsInController@index')->name('admin.qualification-in');
        Route::get('/{t}/add', 'QualificationsInController@getAdd');
        Route::get('/{t}/add/{id}', 'QualificationsInController@getAdd');
        Route::post('/{t}/add', 'QualificationsInController@postAdd');
        Route::post('/{t}/add/{id}', 'QualificationsInController@postAdd');
        Route::get('/{t}/view/{id}', 'QualificationsInController@getView');
        Route::get('/{t}/delete/{id}', 'QualificationsInController@getDelete');
    });
    Route::prefix('rating')->group(function () {
        Route::get('/{t}', 'RatingController@index');
        Route::get('/{t}/add', 'RatingController@getAdd');
        Route::get('/{t}/add/{id}', 'RatingController@getAdd');
        Route::post('/{t}/add', 'RatingController@postAdd');
        Route::post('/{t}/add/{id}', 'RatingController@postAdd');
//        Route::post('/source', 'RatingController@postSource');
//        Route::post('/source/{id}', 'RatingController@postSource');
        Route::get('/{t}/view/{id}', 'RatingController@getView');
        Route::get('/{t}/delete/{id}', 'RatingController@getDelete');
    });
    Route::prefix('list')->group(function () {
        Route::get('/', 'ListController@index')->name('admin.vuz.page');
        Route::prefix('/university')->group(function (){
            Route::get('/add', 'UniversityController@getPageAdd');
            Route::get('/add/{id}', 'UniversityController@getPageAdd');
            Route::post('/add', 'UniversityController@postPageAdd');
            Route::post('/add/{id}', 'UniversityController@postPageAdd');
            Route::get('/view/{id}', 'UniversityController@getPageView');
            Route::get('/delete/{id}', 'UniversityController@getPageDelete');
        });
        Route::prefix('/college')->group(function (){
            Route::get('/', 'CollegeController@list')->name('admin.college.page');
            Route::get('/add', 'CollegeController@getPageAdd');
            Route::get('/add/{id}', 'CollegeController@getPageAdd');
            Route::post('/add', 'CollegeController@postPageAdd');
            Route::post('/add/{id}', 'CollegeController@postPageAdd');
            Route::get('/view/{id}', 'CollegeController@getPageView');
            Route::get('/delete/{id}', 'CollegeController@getPageDelete');
});
        Route::get('/add', 'ListController@getAdd');
        Route::get('/add/{id}', 'ListController@getAdd');
        Route::post('/add', 'ListController@postAdd');
        Route::post('/add/{id}', 'ListController@postAdd');
        Route::post('/source', 'ListController@postSource');
        Route::post('/source/{id}', 'ListController@postSource');
        Route::get('/view/{id}', 'ListController@getView');
        Route::get('/delete/{id}', 'ListController@getDelete');
    });
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::get('/add', 'CategoryController@getAdd');
        Route::get('/add/{id}', 'CategoryController@getAdd');
        Route::post('/add', 'CategoryController@postAdd');
        Route::post('/add/{id}', 'CategoryController@postAdd');
        Route::get('/view/{id}', 'CategoryController@getView');
        Route::get('/delete/{id}', 'CategoryController@getDelete');
    });
    Route::prefix('language')->group(function () {
        Route::get('/', 'LanguageController@index');
        Route::get('/add', 'LanguageController@getAdd');
        Route::get('/add/{id}', 'LanguageController@getAdd');
        Route::post('/add', 'LanguageController@postAdd');
        Route::post('/add/{id}', 'LanguageController@postAdd');
        Route::get('/view/{id}', 'LanguageController@getView');
        Route::get('/delete/{id}', 'LanguageController@getDelete');
    });
    Route::prefix('rating-category')->group(function () {
        Route::get('/', 'RatingController@indexCategory');
        Route::get('/add', 'RatingController@getAddCategory');
        Route::get('/add/{id}', 'RatingController@getAddCategory');
        Route::post('/add', 'RatingController@postAddCategory');
        Route::post('/add/{id}', 'RatingController@postAddCategory');
        Route::get('/delete/{id}', 'RatingController@getDeleteCategory');
    });
    Route::prefix('cost')->group(function () {
        Route::get('/', 'CostController@index');
        Route::get('/add', 'CostController@getAdd');
        Route::get('/add/{id}', 'CostController@getAdd');
        Route::post('/add', 'CostController@postAdd');
        Route::post('/add/{id}', 'CostController@postAdd');
        Route::get('/view/{id}', 'CostController@getView');
        Route::get('/delete/{id}', 'CostController@getDelete');
    });
    Route::prefix('faq')->group(function () {
        Route::get('/', 'FaqController@index');
        Route::get('/add', 'FaqController@getAdd');
        Route::get('/add/{id}', 'FaqController@getAdd');
        Route::post('/add', 'FaqController@postAdd');
        Route::post('/add/{id}', 'FaqController@postAdd');
        Route::get('/view/{id}', 'FaqController@getView');
        Route::get('/delete/{id}', 'FaqController@getDelete');
    });
    Route::prefix('requirement')->group(function () {
        Route::get('/', 'RequirementController@index');
        Route::get('/add', 'RequirementController@getAdd');
        Route::get('/add/{id}', 'RequirementController@getAdd');
        Route::post('/add', 'RequirementController@postAdd');
        Route::post('/add/{id}', 'RequirementController@postAdd');
        Route::get('/view/{id}', 'RequirementController@getView');
        Route::get('/delete/{id}', 'RequirementController@getDelete');
    });
    Route::prefix('cityslider')->group(function () {
        Route::get('/', 'CitySliderController@index');
        Route::get('/add', 'CitySliderController@getAdd');
        Route::get('/add/{id}', 'CitySliderController@getAdd');
        Route::post('/add', 'CitySliderController@postAdd');
        Route::post('/add/{id}', 'CitySliderController@postAdd');
        Route::get('/view/{id}', 'CitySliderController@getView');
        Route::get('/delete/{id}', 'CitySliderController@getDelete');
    });
    Route::prefix('region')->group(function () {
        Route::get('/', 'RegionController@index');
        Route::get('/add', 'RegionController@getAdd');
        Route::get('/add/{id}', 'RegionController@getAdd');
        Route::post('/add', 'RegionController@postAdd');
        Route::post('/add/{id}', 'RegionController@postAdd');
        Route::get('/view/{id}', 'RegionController@getView');
        Route::get('/delete/{id}', 'RegionController@getDelete');
    });
    Route::prefix('navigator')->group(function () {
        Route::get('/', 'NavigatorController@index');
        Route::get('/add', 'NavigatorController@getAdd');
        Route::get('/add/{id}', 'NavigatorController@getAdd');
        Route::post('/add', 'NavigatorController@postAdd');
        Route::post('/add/{id}', 'NavigatorController@postAdd');
        Route::get('/view/{id}', 'NavigatorController@getView');
        Route::get('/delete/{id}', 'NavigatorController@getDelete');
    });
    Route::prefix('social')->group(function () {
        Route::get('/', 'SocialController@index');
        Route::get('/add', 'SocialController@getAdd');
        Route::get('/add/{id}', 'SocialController@getAdd');
        Route::post('/add', 'SocialController@postAdd');
        Route::post('/add/{id}', 'SocialController@postAdd');
        Route::get('/view/{id}', 'SocialController@getView');
        Route::get('/delete/{id}', 'SocialController@getDelete');
    });
    Route::prefix('meta')->group(function () {
        Route::get('/', 'MetaController@index');
        Route::get('/add', 'MetaController@getAdd');
        Route::get('/add/{id}', 'MetaController@getAdd');
        Route::post('/add', 'MetaController@postAdd');
        Route::post('/add/{id}', 'MetaController@postAdd');
        Route::get('/view/{id}', 'MetaController@getView');
        Route::get('/delete/{id}', 'MetaController@getDelete');
    });
    Route::prefix('partner')->group(function () {
        Route::get('/', 'PartnerController@index');
        Route::get('/add', 'PartnerController@getAdd');
        Route::get('/add/{id}', 'PartnerController@getAdd');
        Route::post('/add', 'PartnerController@postAdd');
        Route::post('/add/{id}', 'PartnerController@postAdd');
        Route::get('/view/{id}', 'PartnerController@getView');
        Route::get('/delete/{id}', 'PartnerController@getDelete');
    });
    Route::prefix('callback')->group(function () {
        Route::get('/', 'CallbackController@index');
        Route::get('/add', 'CallbackController@getAdd');
        Route::get('/add/{id}', 'CallbackController@getAdd');
        Route::post('/add', 'CallbackController@postAdd');
        Route::post('/add/{id}', 'CallbackController@postAdd');
        Route::get('/view/{id}', 'CallbackController@getView');
        Route::get('/delete/{id}', 'CallbackController@getDelete');
    });
    Route::prefix('article')->group(function () {
        Route::get('/', 'ArticleController@index');
        Route::get('/add', 'ArticleController@getAdd');
        Route::get('/add/{id}', 'ArticleController@getAdd');
        Route::post('/add', 'ArticleController@postAdd');
        Route::post('/add/{id}', 'ArticleController@postAdd');
        Route::get('/view/{id}', 'ArticleController@getView');
        Route::get('/delete/{id}', 'ArticleController@getDelete');
    });
    Route::prefix('slider')->group(function () {
        Route::get('/', 'SliderController@index');
        Route::get('/add', 'SliderController@getAdd');
        Route::get('/add/{id}', 'SliderController@getAdd');
        Route::post('/add', 'SliderController@postAdd');
        Route::post('/add/{id}', 'SliderController@postAdd');
        Route::get('/view/{id}', 'SliderController@getView');
        Route::get('/delete/{id}', 'SliderController@getDelete');
    });
    Route::prefix('proposal')->group(function () {
        Route::get('/', 'ProposalController@index');
        Route::get('/view/{id}', 'ProposalController@getView');
        Route::get('/delete/{id}', 'ProposalController@getDelete');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/view/{id}', 'UserController@getView');
        Route::get('/delete/{id}', 'UserController@getDelete');
    });
    Route::prefix('calculator-ent')->group(function () {
        Route::get('/', 'ENTController@index')->name('admin.ent');
        Route::get('/add', 'ENTController@getAdd');
        Route::post('/add', 'ENTController@postAdd');
        Route::get('/add/{id}', 'ENTController@getAdd');
        Route::post('/add/{id}', 'ENTController@postAdd');
        Route::get('/delete/{id}', 'ENTController@getDelete');
        Route::get('/select', 'ENTController@entSelect')->name('admin.ent.select');
    });
});

Route::prefix('ajax')->group(function () {
    Route::post('city/', 'AjaxController@getCity');
    Route::get('specialty/', 'AjaxController@getSpecialty');
    Route::post('subdirection/', 'AjaxController@getSubdirection');
    Route::post('specialties/', 'AjaxController@getSpecialties');
    Route::post('university/', 'AjaxController@postUniversity');
    Route::post('un/', 'AjaxController@getUn');
});

Route::prefix('poisk/')->group(function () {
    Route::get('/', 'PoiskController@index');
    Route::post('/', 'PoiskController@index');
    Route::get('/view/{id}', 'PoiskController@getView');
});

Route::get('/cabinet', 'CabinetController@index')->name('cabinet');

Route::get('/poisk/bakalavriat/', 'PoiskController@index')->name('bakalavriat');
Route::get('/poisk/magistratura/', 'PoiskController@index')->name('magistratura');
Route::get('/poisk/doktorantura/', 'PoiskController@index')->name('doktorantura');
Route::get('/list/', 'ListController@index')->name('list');
Route::get('/fmain/{degree_id}/{direction_id}/{city_id}/{query}', 'ListController@getFmain')->name('list');
Route::get('/faqs', 'FaqController@index')->name('faqs');

Route::get('verify/{email}/{verify_token}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::get('/', 'IndexController@index')->name('index');

Route::get('/qazaqstan/city/view/{id?}', 'IndexController@getCity')->name('city');
Route::get('/navigator/view/{id}', 'IndexController@getNavigator')->name('navigator');
Route::get('/navigator', 'IndexController@getNavigator1')->name('navigator');
Route::get('/qazaqstan/college/vuz', 'IndexController@getArticle')->name('college-vuz');
Route::get('/qazaqstan/add', 'IndexController@getArticle')->name('vuz.add');
Route::get('/qazaqstan/about', 'IndexController@getArticle')->name('about');
Route::get('/qazaqstan/advertisers', 'IndexController@getArticle')->name('advertisers');
Route::get('/qazaqstan/agreement', 'IndexController@getArticle')->name('agreement');
Route::get('/qazaqstan/confidential', 'IndexController@getArticle')->name('confidential');
//Route::get('/test/', 'IndexController@getTest')->name('test');
Route::get('/qazaqstan/callback', 'IndexController@getCallback')->name('callback');
Route::post('/qazaqstan/callback', 'IndexController@postCallback')->name('callbackPost');
Route::post('/proposal', 'IndexController@postProposal');
Route::get('/login', 'LoginController@showLoginForm');
Route::post('/logging', 'CustomAuthController@login')->name('logging');
Route::get('/forgot-passwd', 'PagesController@showForgotPasswd');
Route::get('/registration', 'PagesController@showRegistrationForm');
Route::get('/cabinet', 'PagesController@showCabinet');
Route::get('/change-pwd', 'PagesController@changePassword')->name('change-pwd');
Route::prefix('')->group(function (){
    Route::get('/qazaqstan/search/colleges', 'PagesController@showDoctor')->name('doctor.college');
    Route::get('/qazaqstan/search/colleges/view/{sid}/uid/{uid}', 'PagesController@viewCollege');
});
Route::prefix('/qazaqstan/search/bachelor')->group(function (){
    Route::get('/', 'PagesController@showDoctor')->name('doctor.under');
    Route::get('/view/{sid}/uid/{uid}', 'PagesController@viewCollege');
});
Route::prefix('/qazaqstan/search/master')->group(function (){
    Route::get('/', 'PagesController@showDoctor')->name('doctor.magistracy');
    Route::get('/view/{sid}/uid/{uid}', 'PagesController@viewCollege');
});
Route::prefix('/qazaqstan/search/doctor')->group(function () {
    Route::get('/', 'PagesController@showDoctor')->name('doctor.doctor');
    Route::get('/view/{sid}/uid/{uid}', 'PagesController@viewCollege');
});
//Route::get('/doctor/{pages}/{degree?}', 'PagesController@showDoctor')->name('doctor');
Route::get('/vuz', 'PagesController@showDoctor')->name('doctor.vuz');

Route::prefix('/qazaqstan/navigator/rating')->group(function(){
    Route::get('college/{type}/{id?}', 'PagesController@multiRating');
    Route::get('universities/{type}/{id?}', 'PagesController@multiRating');
});
Route::get('qazaqstan/navigator/faq/1', 'PagesController@showFAQ')->name('faq');
Route::get('qazaqstan/navigator/faq/{id}', 'PagesController@showFAQ')->name('faq.view');
Route::get('qazaqstan/navigator/list/partner', 'PagesController@partnerList')->name('partner');
Route::get('/qazaqstan/navigator/list/universities', 'PagesController@univerList')->name('list.vuz');
Route::get('/qazaqstan/navigator/list/college', 'PagesController@collegeList')->name('list.college');
Route::prefix('qazaqstan/navigator/list/{name}')->group(function (){
    Route::get('/view/{id}/{nav?}', 'PagesController@attributesCollegeFromList')->name('college.view');
});
Route::post('cabinet/edit', 'UserController@edit');
Route::post('change-pwd/reset', 'UserController@resetPassword');
Route::get('cabinet/edit', 'UserController@update');
Route::get('/univer/view/{id}', 'PagesController@viewUniver');
//Route::get('sfsdghjjhgfgd', 'EpayController@requestResult');
Route::get('/qazaqstan/calculator-ent', 'PagesController@entCalculator')->name('calculator-ent');
Route::post('/result-ent', 'PagesController@entResult')->name('result-ent');
Route::get('result-ent/{score}/{profs1}/{profs2}/{lang}/{map}', 'PagesController@showENTResult')->name('ent-show');
Route::get('/result-ent2/{prob}/{score}/{profs1}/{profs2}/{lang}/{p?}', 'PagesController@entResult2')->name('result-ent2');
Route::get('/callback-view', 'PagesController@showCallback');
Route::post('/forgot-password', 'IndexController@resetPassword')->name('forgot-password');
Route::post('payment', 'EpayController@payment')->name('payment');
Route::get('/sign-in/google', 'CustomAuthController@loginWithGoogle');
Route::get('/sign-in/facebook', 'CustomAuthController@loginWithFacebook');
Route::get('/sign-in/google/redirect', 'CustomAuthController@googleRedirect');
Route::get('/sign-in/facebook/redirect', 'CustomAuthController@facebookRedirect');
Route::get('success-payment/{m}/{sum}', 'PagesController@successPayment')->name('success-payment');
Route::get('fail-payment/{m}', 'PagesController@failPayment')->name('fail-payment');
Route::get('show-payment/{m}', 'PagesController@showPayment')->name('show-payment');
Route::get('ajax-filter/{pages}/{query?}', 'AjaxController@doctorFilter')->name('ajax-filter');
Route::get('testt', function (){
    return view('emails.forgot');
});
Route::get('result/filter/{sid}/{uid}/{sub1}/{sub2}', 'AjaxController@resToSearch')->name('resToSearch');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Auth::routes();
Route::get('clear-cache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
});
Route::get('storage-link', function (){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});


//Route::get('/home', 'HomeController@index')->name('home');
