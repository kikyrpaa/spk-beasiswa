<?php

use App\Http\Controllers\Admin\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Siswa\HomeController as HomeSiswaController;
use App\Http\Controllers\Admin\BeasiswaSiswaController;


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

/* ----------------------- Admin Routes START -------------------------------- */

Route::prefix('/administrator')->name('admin.')->namespace('Admin')->group(function (){

    /**
     * Admin Auth Route(s)
     */
    Route::namespace('Auth')->group(function () {
        //Login Routes
        Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[LoginController::class, 'login']);
        Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::post('/changePassword',[HomeController::class, 'changePassword'])->name('home.changePassword');

    //Admin Management
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.list');
    Route::get('/admin/form/{id?}', [AdminController::class, 'form'])->name('admin.form');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/detail/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::post('/admin/delete/', [AdminController::class, 'delete'])->name('admin.delete');

    //Beasiswa Management
    Route::get('/beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.list');
    Route::get('/beasiswa/form/{id?}', [BeasiswaController::class, 'form'])->name('beasiswa.form');
    Route::post('/beasiswa/store', [BeasiswaController::class, 'store'])->name('beasiswa.store');
    Route::get('/beasiswa/detail/{id}', [BeasiswaController::class, 'detail'])->name('beasiswa.detail');
    Route::post('/beasiswa/delete/', [BeasiswaController::class, 'delete'])->name('beasiswa.delete');
    Route::post('/beasiswa/decide/', [BeasiswaController::class, 'decide'])->name('beasiswa.decide');

    //Siswa Management
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.list');
    Route::get('/siswa/form/{id?}', [SiswaController::class, 'form'])->name('siswa.form');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/detail/{id}', [SiswaController::class, 'detail'])->name('siswa.detail');
    Route::post('/siswa/delete/', [SiswaController::class, 'delete'])->name('siswa.delete');
    Route::post('/siswa/verify/', [SiswaController::class, 'verify'])->name('siswa.verify');
    Route::post('/siswa/verify-prestasi/', [SiswaController::class, 'verifyPrestasi'])->name('siswa.verify-prestasi');
    Route::post('/siswa/verify-hafidh/', [SiswaController::class, 'verifyHafidh'])->name('siswa.verify-hafidh');

    //Beasiswa Siswa
    Route::get('/beasiswa-siswa', [BeasiswaSiswaController::class, 'index'])->name('beasiswa-siswa');
});

/* ----------------------- Admin Routes END -------------------------------- */

/* ----------------------- Siswa Routes START -------------------------------- */
Route::prefix('/siswa')->name('siswa.')->namespace('Siswa')->group(function () {
    /**
     * Siswa Auth Route(s)
     */
    Route::namespace('Auth')->group(function () {
        //Login Routes
        Route::get('/login',[\App\Http\Controllers\Siswa\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login',[\App\Http\Controllers\Siswa\Auth\LoginController::class, 'login']);
        Route::post('/logout',[\App\Http\Controllers\Siswa\Auth\LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/',[HomeSiswaController::class, 'index'])->name('home');
    Route::get('edit/{id?}',[HomeSiswaController::class, 'form'])->name('edit');
    Route::post('store',[HomeSiswaController::class, 'store'])->name('store');
    Route::post('/changePassword',[HomeSiswaController::class, 'changePassword'])->name('home.changePassword');

    Route::get('/beasiswa',[\App\Http\Controllers\Siswa\BeasiswaController::class, 'index'])->name('beasiswa');
    Route::get('/beasiswa/detail/{id}', [\App\Http\Controllers\Siswa\BeasiswaController::class, 'detail'])->name('beasiswa.detail');
    Route::post('/beasiswa/apply/', [\App\Http\Controllers\Siswa\BeasiswaController::class, 'apply'])->name('beasiswa.apply');
});

Route::get('/', [\App\Http\Controllers\Controller::class, 'home']);
// Route::view('/', 'starter')->name('starter');
Route::get('large-compact-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'compact']);
    return view('dashboard.dashboardv1');
})->name('compact');

Route::get('large-sidebar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'normal']);
    return view('dashboard.dashboardv1');
})->name('normal');

Route::get('horizontal-bar/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'horizontal']);
    return view('dashboard.dashboardv1');
})->name('horizontal');

Route::get('vertical/dashboard/dashboard1', function () {
    // set layout sesion(key)
    session(['layout' => 'vertical']);
    return view('dashboard.dashboardv1');
})->name('vertical');


Route::view('dashboard/dashboard1', 'dashboard.dashboardv1')->name('dashboard_version_1');
Route::view('dashboard/dashboard2', 'dashboard.dashboardv2')->name('dashboard_version_2');
Route::view('dashboard/dashboard3', 'dashboard.dashboardv3')->name('dashboard_version_3');
Route::view('dashboard/dashboard4', 'dashboard.dashboardv4')->name('dashboard_version_4');

// uiKits
Route::view('uikits/alerts', 'uiKits.alerts')->name('alerts');
Route::view('uikits/accordion', 'uiKits.accordion')->name('accordion');
Route::view('uikits/buttons', 'uiKits.buttons')->name('buttons');
Route::view('uikits/badges', 'uiKits.badges')->name('badges');
Route::view('uikits/bootstrap-tab', 'uiKits.bootstrap-tab')->name('bootstrap-tab');
Route::view('uikits/carousel', 'uiKits.carousel')->name('carousel');
Route::view('uikits/collapsible', 'uiKits.collapsible')->name('collapsible');
Route::view('uikits/lists', 'uiKits.lists')->name('lists');
Route::view('uikits/pagination', 'uiKits.pagination')->name('pagination');
Route::view('uikits/popover', 'uiKits.popover')->name('popover');
Route::view('uikits/progressbar', 'uiKits.progressbar')->name('progressbar');
Route::view('uikits/tables', 'uiKits.tables')->name('tables');
Route::view('uikits/tabs', 'uiKits.tabs')->name('tabs');
Route::view('uikits/tooltip', 'uiKits.tooltip')->name('tooltip');
Route::view('uikits/modals', 'uiKits.modals')->name('modals');
Route::view('uikits/NoUislider', 'uiKits.NoUislider')->name('NoUislider');
Route::view('uikits/cards', 'uiKits.cards')->name('cards');
Route::view('uikits/cards-metrics', 'uiKits.cards-metrics')->name('cards-metrics');
Route::view('uikits/typography', 'uiKits.typography')->name('typography');

// extra kits
Route::view('extrakits/dropDown', 'extraKits.dropDown')->name('dropDown');
Route::view('extrakits/imageCroper', 'extraKits.imageCroper')->name('imageCroper');
Route::view('extrakits/loader', 'extraKits.loader')->name('loader');
Route::view('extrakits/laddaButton', 'extraKits.laddaButton')->name('laddaButton');
Route::view('extrakits/toastr', 'extraKits.toastr')->name('toastr');
Route::view('extrakits/sweetAlert', 'extraKits.sweetAlert')->name('sweetAlert');
Route::view('extrakits/tour', 'extraKits.tour')->name('tour');
Route::view('extrakits/upload', 'extraKits.upload')->name('upload');


// Apps
Route::view('apps/invoice', 'apps.invoice')->name('invoice');
Route::view('apps/inbox', 'apps.inbox')->name('inbox');
Route::view('apps/chat', 'apps.chat')->name('chat');
Route::view('apps/calendar', 'apps.calendar')->name('calendar');
Route::view('apps/task-manager-list', 'apps.task-manager-list')->name('task-manager-list');
Route::view('apps/task-manager', 'apps.task-manager')->name('task-manager');
Route::view('apps/toDo', 'apps.toDo')->name('toDo');
Route::view('apps/ecommerce/products', 'apps.ecommerce.products')->name('ecommerce-products');
Route::view('apps/ecommerce/product-details', 'apps.ecommerce.product-details')->name('ecommerce-product-details');
Route::view('apps/ecommerce/cart', 'apps.ecommerce.cart')->name('ecommerce-cart');
Route::view('apps/ecommerce/checkout', 'apps.ecommerce.checkout')->name('ecommerce-checkout');


Route::view('apps/contacts/lists', 'apps.contacts.lists')->name('contacts-lists');
Route::view('apps/contacts/contact-details', 'apps.contacts.contact-details')->name('contact-details');
Route::view('apps/contacts/grid', 'apps.contacts.grid')->name('contacts-grid');
Route::view('apps/contacts/contact-list-table', 'apps.contacts.contact-list-table')->name('contact-list-table');

// forms
Route::view('forms/basic-action-bar', 'forms.basic-action-bar')->name('basic-action-bar');
Route::view('forms/multi-column-forms', 'forms.multi-column-forms')->name('multi-column-forms');
Route::view('forms/smartWizard', 'forms.smartWizard')->name('smartWizard');
Route::view('forms/tagInput', 'forms.tagInput')->name('tagInput');
Route::view('forms/forms-basic', 'forms.forms-basic')->name('forms-basic');
Route::view('forms/form-layouts', 'forms.form-layouts')->name('form-layouts');
Route::view('forms/form-input-group', 'forms.form-input-group')->name('form-input-group');
Route::view('forms/form-validation', 'forms.form-validation')->name('form-validation');
Route::view('forms/form-editor', 'forms.form-editor')->name('form-editor');

// Charts
Route::view('charts/echarts', 'charts.echarts')->name('echarts');
Route::view('charts/chartjs', 'charts.chartjs')->name('chartjs');
Route::view('charts/apexLineCharts', 'charts.apexLineCharts')->name('apexLineCharts');
Route::view('charts/apexAreaCharts', 'charts.apexAreaCharts')->name('apexAreaCharts');
Route::view('charts/apexBarCharts', 'charts.apexBarCharts')->name('apexBarCharts');
Route::view('charts/apexColumnCharts', 'charts.apexColumnCharts')->name('apexColumnCharts');
Route::view('charts/apexRadialBarCharts', 'charts.apexRadialBarCharts')->name('apexRadialBarCharts');
Route::view('charts/apexRadarCharts', 'charts.apexRadarCharts')->name('apexRadarCharts');
Route::view('charts/apexPieDonutCharts', 'charts.apexPieDonutCharts')->name('apexPieDonutCharts');
Route::view('charts/apexSparklineCharts', 'charts.apexSparklineCharts')->name('apexSparklineCharts');
Route::view('charts/apexScatterCharts', 'charts.apexScatterCharts')->name('apexScatterCharts');
Route::view('charts/apexBubbleCharts', 'charts.apexBubbleCharts')->name('apexBubbleCharts');
Route::view('charts/apexCandleStickCharts', 'charts.apexCandleStickCharts')->name('apexCandleStickCharts');
Route::view('charts/apexMixCharts', 'charts.apexMixCharts')->name('apexMixCharts');

// datatables
Route::view('datatables/basic-tables', 'datatables.basic-tables')->name('basic-tables');

// sessions
Route::view('sessions/signIn', 'sessions.signIn')->name('signIn');
Route::view('sessions/signUp', 'sessions.signUp')->name('signUp');
Route::view('sessions/forgot', 'sessions.forgot')->name('forgot');

// widgets
Route::view('widgets/card', 'widgets.card')->name('widget-card');
Route::view('widgets/statistics', 'widgets.statistics')->name('widget-statistics');
Route::view('widgets/list', 'widgets.list')->name('widget-list');
Route::view('widgets/app', 'widgets.app')->name('widget-app');
Route::view('widgets/weather-app', 'widgets.weather-app')->name('widget-weather-app');

// others
Route::view('others/notFound', 'others.notFound')->name('notFound');
Route::view('others/user-profile', 'others.user-profile')->name('user-profile');
Route::view('others/starter', 'starter')->name('starter');
Route::view('others/faq', 'others.faq')->name('faq');
Route::view('others/pricing-table', 'others.pricing-table')->name('pricing-table');
Route::view('others/search-result', 'others.search-result')->name('search-result');

// Auth::routes();
//Route::view('auth/login', 'auth.login')->name('login');

//Route::get('/home', 'HomeController@index')->name('home');
