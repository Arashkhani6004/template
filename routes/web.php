<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FirstPageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Shop\AddressController;
use App\Http\Controllers\Shop\BasketController;
use App\Http\Controllers\Shop\BrandController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\OrderController as OrderControllerAlias;
use App\Http\Controllers\Panel\AddressController as AddressControllerAlias;
use App\Http\Controllers\Panel\OrderController ;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\SiteConfigController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;




Route::get('/', [FirstPageController::class, 'index'])->name('index');
Route::get('sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('index');


//Service
Route::controller(ServiceController::class)->name('service.')->group(function () {
    Route::get('/services', 'index')->name('list');
    Route::get('/service/{url}', 'detail')->name('detail');
});

//Us
Route::controller(UsController::class)->name('us.')->group(function () {
    Route::get('/about-us', 'about')->name('about');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/post-contact', 'postContact')->name('post-contact');
    //flush-cache
    Route::get('/flush-cache', 'flushCache')->name('flush-cache');
});

//Comment
Route::post('/post-comment', [CommentController::class, 'postComment'])->name('post-comment');

//Blogs
Route::controller(BlogController::class)->name('blog.')->group(function () {
    Route::get('/posts', 'index')->name('category-list');
    Route::get('/posts/{url}', 'list')->name('list');
    Route::get('/post/{url}', 'detail')->name('detail');
});

//Samples
Route::controller(SampleController::class)->name('portfolio.')->group(function () {
    Route::get('/portfolios', 'index')->name('list');
    Route::get('/portfolio/{url}', 'detail')->name('detail');
    Route::get('/portfolio-filters', 'getServiceForFilter')->name('portfolio-filters');
//    Route::post('/portfolio-vue', 'getListForVue')->name('portfolio-vue');
});

//Gallery
Route::controller(GalleryController::class)->name('gallery.')->group(function () {
    Route::get('/galleries', 'category')->name('category');
    Route::get('/gallery/{url}', 'list')->name('list');
});

//Package
Route::controller(PackageController::class)->name('package.')->group(function () {
    Route::get('/packages', 'list')->name('list');
    Route::get('/package/{url}', 'detail')->name('detail');
});


//category
Route::controller(CategoryController::class)->name('category.')->group(function () {
    Route::get('/categories', 'list')->name('list');
    Route::get('/category/{url}', 'detail')->name('detail');
});

//brand
Route::controller(BrandController::class)->name('brand.')->group(function () {
    Route::get('/brands', 'list')->name('list');
    Route::get('/brand/{url}', 'detail')->name('detail');
});

//product
Route::controller(ProductController::class)->name('product.')->group(function () {
    Route::get('/product/{url}', 'detail')->name('detail');
    Route::get('/discounted-list', 'getDiscountedProducts')->name('get-discounted-list');
});

//tag
Route::controller(TagController::class)->name('tag.')->group(function () {
    Route::get('/tags', 'index')->name('list');
    Route::get('/tag/{url}', 'detail')->name('detail');
});

//search
Route::controller(SearchController::class)->name('search.')->group(function () {
    Route::get('/search', 'detail')->name('detail');
});
//auth
Route::controller(AuthController::class)->prefix('/panel')->name('auth.')->group(function () {
    Route::get('/login', 'index')->name('index');
    Route::post('/post-login', 'login')->name('login');
    Route::get('/check-user-exists', 'checkUserExisting')->name('check-user-exists');
    Route::post("/register", "postRegister")->name('register');
    Route::get('/mobile-code', 'getCode')->name('mobile-code');
    Route::post("/confirm-code", "postCode")->name('confirm-code');
    Route::get('/logout', 'logout')->name('logout');
});
//panel
Route::middleware('panel')->prefix('/panel')->name('panel.')->group(function () {

    // PanelController routes
    Route::controller(PanelController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/edit-profile', 'editProfile')->name('edit-profile');
    });

    // OrderController routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders');
        Route::get('/order/{id}', 'detail')->name('order-detail');
        Route::get('/order-factor/{id}', 'factor')->name('order-factor');
    });

    // AddressController routes
    Route::controller(AddressControllerAlias::class)->group(function () {
        Route::get('/address', 'index')->name('address');
        Route::post('/address-create', 'create')->name('address-create');
        Route::post('/address-update', 'update')->name('address-update');
        Route::get('/address-list', 'userAddresses')->name('address-list'); // vue
        Route::post('/city', 'city')->name('cities'); // vue
        Route::get('/states', 'states')->name('states'); // vue
        Route::post('/address-edit', 'edit')->name('address-edit'); // vue
    });

});


//step-one-shop
Route::controller(BasketController::class)->prefix('/checkout')->name('basket.')->group(function () {
    Route::post('/add-to-basket', 'add')->name('add');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/cart-delete', 'delete')->name('cart-delete');
    Route::post('/cart-item-remove', 'removeItem')->name('cart-item-remove');//vue
    Route::get('/cart-item-list', 'cartItems')->name('cart-items'); //vue
    Route::get('/list-price', 'listPrice')->name('list-price'); //vue
});
Route::middleware('panel')->prefix('/checkout')->name('basket.')->group(function () {
    //step-two-shop
    Route::controller(AddressController::class)->group(function () {
        Route::get('/shipping', 'list')->name('shipping');
        Route::post('/address-create', 'create')->name('address-create');
        Route::post('/address-update', 'update')->name('address-update');
        Route::get('/address-list', 'userAddresses')->name('address-list'); //vue
        Route::post('/city', 'city')->name('cities'); //vue
        Route::get('/states', 'states')->name('states'); //vue
        Route::post('/address-edit', 'edit')->name('address-edit'); //vue
        Route::post('/shipments', 'shipments')->name('shipments'); //vue
        Route::post('/set-shipments', 'setShipments')->name('set-shipments'); //vue
        Route::get('/address-price', 'addressPrice')->name('address-price'); //vue
    });
    //step-three-shop
    Route::controller(OrderControllerAlias::class)->group(function () {
        Route::get('/payment', 'cart')->name('payment');
        Route::post('/add-discount', 'addDiscount')->name('add-discount'); //vue
        Route::get('/delete-discount', 'deleteDiscount')->name('delete-discount'); //vue
        Route::get('/order-price', 'orderPrice')->name('order-price'); //vue
        //create
        Route::post('/create', 'create')->name('order-create');
        Route::any('/finish', 'finishZarinPal')->name('finish.zarin-pal');
        //end Order
        Route::get('/order-details-success/{id}', 'success')->name('success');
        Route::get('/order-details-failed/', 'failed')->name('failed');
    });

});



Route::get('/favorites', function () {
    return view('pages.panel.favorites.index');
});



Route::get('/tickets', function () {
    return view('pages.panel.ticket.list');
});
Route::get('/tickets/id', function () {
    return view('pages.panel.ticket.detail');
});
Route::get('/my-packages', function () {
    return view('pages.panel.package.index');
});
Route::get('/my-addresses', function () {
    return view('pages.panel.addresses.index');
});



Route::get('/set-config-sites', [SiteConfigController::class, "setConfigSitesData"])
    ->name('set-config-data');
