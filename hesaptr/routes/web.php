<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');
Route::get('/sitemap.xml', [App\Http\Controllers\Front\IndexController::class, 'sitemap'])->name('sitemap');

Route::controller(App\Http\Controllers\Front\IndexController::class)->group(function () {
    Route::POST('/product/view/', 'product_view')->name('product.view');
    Route::get('/live-preview/{slug}/{type}', 'live_preview')->name('live_preview');
    Route::get('/c/{slug}/{short?}', 'category')->name('category');
    Route::get('/p/{slug}', 'product')->name('product');

    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blog/{slug}', 'article')->name('article');

    Route::get('/contact', 'contact')->name('contact');
    Route::POST('/contact/send', 'contact_send')->name('page.contact.send');

    Route::get('/page/{slug}', 'page')->name('page');

    Route::get('/search', 'search')->name('product.search');
    Route::get('/', 'index')->name('index');

});

Route::controller(App\Http\Controllers\Front\OrderController::class)->group(function () {
    Route::get('/order/checkout', 'checkout')->name('checkout');
    Route::POST('/order/complete', 'complete')->name('order.complete')->middleware('ban.check');
    Route::post('/order/coupon_check', 'coupon_check')->name('order.coupon.check')->middleware('throttle:coupon_check');

    Route::POST('/wallet/store', 'wallet_store')->name('order.wallet.store')->middleware(['auth','ban.check']);

    Route::POST('/order/download', 'download')->name('download');

    Route::get('/order-details', 'order_details')->name('order.details')->middleware('throttle:order_details');

    Route::POST('/bank-notify', 'bank_notify')->name('bank.notify');
    Route::get('/banka-hesaplarimiz', 'ibans')->name('ibans');
});

Route::controller(App\Http\Controllers\Front\FavoriteController::class)->group(function () {
    Route::POST('/favorites', 'index')->name('favorites');
    Route::POST('/favorites/store', 'store')->name('favorites.store');
    Route::POST('/favorites/delete', 'delete')->name('favorites.delete');
});

Route::controller(App\Http\Controllers\Front\ProfileController::class)->middleware(['auth','ban.check'])->group(function () {
    Route::get('/profile', 'profile')->name('profile');
    Route::POST('/profile/edit_profile/info/update', 'edit_profile_info_update')->name('profile.edit_profile.info.update');
    Route::POST('/profile/edit_profile/password/update', 'edit_profile_password_update')->name('profile.edit_profile.password.update');

    Route::get('/profile/orders', 'orders')->name('profile.orders');
    Route::get('/profile/wallets', 'wallets')->name('profile.wallets');

});



Route::controller(App\Http\Controllers\Front\PaytrController::class)->group(function () {
    Route::POST('/paytr/callback', 'callback')->name('paytr.callback');
    Route::get('/paytr/callback_ok', 'callbackOk')->name('paytr.callback.ok');
    Route::get('/paytr/callback_fail', 'callbackFail')->name('paytr.callback.fail');
});
Route::controller(App\Http\Controllers\Front\StripeController::class)->group(function () {
    Route::POST('/stripe/callback', 'callback')->name('stripe.callback');
    Route::get('/stripe/callback_ok', 'callbackOk')->name('stripe.callback.ok');
});
Route::controller(App\Http\Controllers\Front\ShopierController::class)->group(function () {
    Route::POST('/shopier/callback', 'callback')->name('shopier.callback');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin.check','ban.check'])->group(function () {
    Route::get('/', [App\Http\Controllers\Back\IndexController::class, 'index'])->name('index');
    Route::POST('/tinymce/upload', [App\Http\Controllers\Back\IndexController::class, 'tinymce_upload'])->name('tinymce.upload');

    Route::controller(App\Http\Controllers\Back\ProductController::class)->group(function () {
        Route::get('/products/properties/index', 'properties_index')->name('products.properties');
        Route::post('/products/properties/store', 'properties_store')->name('products.properties.store');
        Route::post('/products/properties/update', 'properties_update')->name('products.properties.update');
        Route::post('/products/properties/destroy', 'properties_destroy')->name('products.properties.destroy');

        Route::get('/products/coupons/index', 'coupons_index')->name('products.coupons');
        Route::post('/products/coupons/store', 'coupons_store')->name('products.coupons.store');
        Route::post('/products/coupons/destroy', 'coupons_destroy')->name('products.coupons.destroy');

        Route::get('/products/stocks/index/{id?}', 'stocks_index')->name('products.stocks');
        Route::POST('/products/stocks/update', 'stocks_update')->name('products.stocks.update');

        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('products.create');
        Route::get('/products/edit/{id}', 'edit')->name('products.edit');
        Route::post('/products/store', 'store')->name('products.store');
        Route::post('/products/update', 'update')->name('products.update');
        Route::post('/products/delete', 'delete')->name('products.delete');

        Route::post('/products/delete_file', 'delete_file')->name('products.delete_file');
    });

    Route::controller(App\Http\Controllers\Back\CategoryController::class)->group(function () {
        Route::get('/categories/index', 'index')->name('categories');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::post('/categories/update', 'update')->name('categories.update');
        Route::post('/categories/destroy', 'destroy')->name('categories.destroy');
    });

    Route::controller(App\Http\Controllers\Back\ArticleController::class)->group(function () {
        Route::get('/article', 'index')->name('article');
        Route::get('/article/create', 'create')->name('article.create');
        Route::get('/article/edit/{id}', 'edit')->name('article.edit');

        Route::POST('/article/store', 'store')->name('article.store');
        Route::POST('/article/update', 'update')->name('article.update');
        Route::POST('/article/delete', 'delete')->name('article.delete');
    });

    Route::controller(App\Http\Controllers\Back\PageController::class)->group(function () {
        Route::get('/page', 'index')->name('page');
        Route::get('/page/create', 'create')->name('page.create');
        Route::get('/page/edit/{id}', 'edit')->name('page.edit');

        Route::POST('/page/store', 'store')->name('page.store');
        Route::POST('/page/update', 'update')->name('page.update');
        Route::POST('/page/delete', 'delete')->name('page.delete');

        Route::get('/page/contacts', 'contacts')->name('page.contacts');
        Route::POST('page/contacts/delete', 'contacts_delete')->name('page.contacts.delete');
    });

    Route::controller(App\Http\Controllers\Back\UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
        Route::get('/users/edit/{id}', 'edit')->name('users.edit');

        Route::POST('/users/update', 'update')->name('users.update');
        Route::POST('/users/delete', 'delete')->name('users.delete');
    });

    Route::controller(App\Http\Controllers\Back\LogController::class)->group(function () {
        Route::post('/log/clear', 'clear')->name('log.clear');
        Route::post('/log/download', 'download')->name('log.download');
    });

    Route::controller(App\Http\Controllers\Back\ModuleController::class)->group(function () {
        Route::get('/module/payment_method', 'payment_method')->name('module.payment_method');
        Route::POST('/module/payment_method/update', 'payment_method_update')->name('module.payment_method.update');
    });

    Route::controller(App\Http\Controllers\Back\SettingController::class)->group(function () {
        Route::get('/settings', 'index')->name('settings.general');
        Route::POST('/settings/update', 'update')->name('settings.update');

        Route::get('/settings/stories', 'stories')->name('settings.stories');
        Route::POST('/settings/stories/store', 'stories_store')->name('settings.stories.store');
        Route::POST('/settings/stories/delete', 'stories_delete')->name('settings.stories.delete');

        Route::get('/settings/sliders', 'sliders')->name('settings.sliders');
        Route::POST('/settings/sliders/store', 'sliders_store')->name('settings.sliders.store');
        Route::POST('/settings/sliders/delete', 'sliders_delete')->name('settings.sliders.delete');

        Route::get('/settings/footer_menu', 'footer_menu')->name('settings.footer_menu');
        Route::get('/settings/footer_menu/add', 'footer_menu_add')->name('settings.footer_menu.add');
        Route::POST('/settings/footer_menu/store', 'footer_menu_store')->name('settings.footer_menu_store');
        Route::POST('/settings/footer_menu/delete', 'footer_menu_delete')->name('settings.footer_menu.delete');

        Route::POST('/settings/footer_menu_column_update', 'footer_menu_column_update')->name('settings.footer_menu_column_update');

        Route::POST('/settings/telegram/test', 'telegram_test')->name('settings.test.telegram');
    });

    Route::controller(App\Http\Controllers\Back\OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders');
        Route::get('/order/create', 'create')->name('order.create');
        Route::get('/order/edit/{id}', 'edit')->name('order.edit');
        Route::POST('/order/store', 'store')->name('order.store');
        Route::POST('/order/update', 'update')->name('order.update');

        Route::POST('/order/edit_stock', 'edit_stock')->name('orders.edit.stock');

        Route::POST('/order/ok', 'ok')->name('order.ok');
        Route::POST('/order/change_payment', 'change_payment')->name('order.change_payment');

        Route::POST('/order/delete', 'delete')->name('order.delete');
        Route::POST('/order/cancel', 'cancel')->name('order.cancel');

        Route::POST('/orders/unpaid/destroy', 'unpaid_destroy')->name('orders.unpaid.destroy');

        Route::get('/payment_notifications', 'payment_notifications')->name('payment_notifications');
        Route::POST('/payment_notifications/confirm', 'payment_notifications_confirm')->name('payment_notifications_confirm');
        Route::POST('/payment_notifications/delete', 'payment_notifications_delete')->name('payment_notifications_delete');
        Route::POST('/payment_notifications/deleteAll', 'payment_notifications_deleteAll')->name('payment_notifications_deleteAll');
    });

});
