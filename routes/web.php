<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Billing\BillController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Billing\PaymentController;
use App\Http\Controllers\Helpdesk\TicketController;
use App\Http\Controllers\Package\PackageController;
use App\Http\Controllers\FrontSettings\FaqController;
use App\Http\Controllers\Helpdesk\TicketReplyController;
use App\Http\Controllers\FrontSettings\ServicesController;
use App\Http\Controllers\Package\PackageRequestController;
use App\Http\Controllers\CustomOrder\CustomOrderController;
use App\Http\Controllers\Customer\CustomerPackageController;
use App\Http\Controllers\Customers\ManageCustomerController;
use App\Http\Controllers\Customers\BlockedCustomerController;
use App\Http\Controllers\Helpdesk\HelpdeskCategoryController;
use App\Http\Controllers\Customers\PotentialCustomerController;
use App\Http\Controllers\GeneralSettings\SiteSettingsController;
use App\Http\Controllers\PurchasePackage\PurchasePackageController;
use App\Http\Controllers\SolutionCategoryController;
use App\Http\Controllers\SolutionController;

Auth::routes();

Route::controller(HomeController::class)->group(function ($routes) {
    $routes->get('/', 'welcomePage')->name('about-us');
    $routes->get('/about-us', 'aboutUs')->name('about-us');
    $routes->get('/services', 'services')->name('services');
    $routes->get('/service/details/{id}', 'serviceDetails')->name('service-details');
    $routes->get('/package', 'package')->name('package');
    $routes->get('/solution', 'solution')->name('solution');
    $routes->get('/faq', 'faq')->name('faq');
    $routes->get('/contact', 'contact')->name('contact');
    $routes->post('/contact-form', 'contactStore')->name('contactStore');

    $routes->middleware(['auth'])->group(function ($authRoutes) {
        $authRoutes->get('/component', 'component')->name('component');
    });
});

Route::controller(RegisterController::class)->group(function ($routes) {
    $routes->get('/user/register', 'index')->name('register-customer');
    $routes->post('/register/customer', 'store')->name('register-customer-store');
    $routes->post('/verify/customer/otp', 'verifyCustomer')->name('verify-customer-otp');
});

Route::controller(DashboardController::class)->middleware(['auth'])->group(function ($routes) {
    $routes->get('/dashboard', 'index')->name('dashboard');
});


Route::middleware(['auth'])->prefix('manage-package')->as('manage-package.')->group(function ($managePackageRoutes) {

    $managePackageRoutes->controller(PackageController::class)->prefix('package')->as('package.')->group(function ($routes) {
        $routes->get('list', 'index')->name('index')->middleware('permission:view_package');
        $routes->post('package/list', 'store')->name('store')->middleware('permission:create_package');
        $routes->get('package/list/{id}/edit', 'edit')->name('edit')->middleware('permission:edit_package');
        $routes->post('package/{id}/update', 'update')->name('update')->middleware('permission:edit_package');
        $routes->post('package/destroy', 'destroy')->name('delete')->middleware('permission:delete_package');
        $routes->post('package/status/change', 'changeStatus')->name('change-status');
        $routes->get('package/list/details/{id}', 'packageDetails')->name('package-details');
    });

    $managePackageRoutes->controller(PackageRequestController::class)->prefix('package-requests')->as('package-requests.')->group(function ($routes) {
        $routes->get('list', 'index')->name('index');
        $routes->post('/{id}/approve', 'approve')->name('approve');
        $routes->post('/{id}/reject', 'reject')->name('reject');
    });
});


Route::controller(PurchasePackageController::class)->middleware(['auth'])->prefix('purchase-package')->as('purchase-package.')->group(function ($routes) {
    $routes->get('inactive/package/index', 'inactiveIndex')->name('inactive-package-index');
    $routes->get('active/package/index', 'activeIndex')->name('active-package-index');
    $routes->get('add/package/to/user', 'addPackageToUserIndex')->name('add-package-to-user');
    $routes->post('add/package/to/user/store', 'addPackageToUserStore')->name('add-package-to-user-store');

    $routes->post('packages', 'store')->name('store');
    $routes->get('packages/{id}/edit', 'edit')->name('edit');
    $routes->post('packages/{id}/update', 'update')->name('update');
    $routes->post('packages/destroy', 'destroy')->name('delete');
    $routes->post('packages/status/change', 'changeStatus');
    $routes->get('packages/details/{id}', 'packageDetails');
});

Route::group(['prefix'=> 'customers', 'as' => 'customers.', 'middleware' => ['auth']], function ($groupRoutes)  {

    $groupRoutes->controller(PotentialCustomerController::class)->prefix('potential-customer')->as('potential-customer.')->group(function ($routes) {
        $routes->get('/', 'index')->name('index');
        $routes->get('/add-to-active-customer/{id}', 'addToActiveCustomer')->name('add-to-active-customer');
    });

    $groupRoutes->controller(ManageCustomerController::class)->prefix('manage-customer')->as('manage-customer.')->group(function ($routes) {
        $routes->get('/', 'index')->name('index');
        $routes->get('/create', 'create')->name('create');
        $routes->post('/store', 'store')->name('store');
        $routes->get('/edit/{id}', 'edit')->name('edit');
        $routes->post('/update/{id}', 'update')->name('update');
        $routes->post('/destroy', 'destroy')->name('delete');
        $routes->get('/details/{id}/{tab}', 'customerDetails')->name('details');
        $routes->post('/toggle-access', 'toggleAccess')->name('toggle-access');

        $routes->get('user/change-password/index', 'changePassword')->name('change-password-index');
        $routes->post('user/change-password/store', 'changePws')->name('change-password-store');
    });

    $groupRoutes->controller(BlockedCustomerController::class)->prefix('blocked-customer')->as('blocked-customer.')->group(function ($routes) {
        $routes->get('/', 'index')->name('index');
        $routes->get('/unblock/{id}', 'unblock')->name('unblock');
    });
});

Route::group(['prefix'=> 'customers', 'as' => 'customers.'], function ($groupRoutes)  {

    $groupRoutes->controller(ManageCustomerController::class)->prefix('manage-customer')->as('manage-customer.')->group(function ($routes) {
        // $routes->post('cutomer-store', 'store')->name('store');
    });
});

// Manage Bills
Route::prefix('manage-bills')->name('manage-bills.')->group(function ($manageBillsRoutes) {

    $manageBillsRoutes->controller(BillController::class)->prefix('bills')->as('bills.')->group(function ($routes) {
        $routes->get('/list', 'index')->name('index');
        $routes->get('/generate-bills', 'generateBills')->name('generate-bills');
    });

    // Payment Routes
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/create/{billId}', [PaymentController::class, 'create'])->name('create');
        Route::post('/', [PaymentController::class, 'store'])->name('store');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
        Route::get('/{id}/approve', [PaymentController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [PaymentController::class, 'reject'])->name('reject');
    });
});


Route::group(['prefix'=> 'general-settings', 'as' => 'general-settings.', 'middleware' => ['auth']], function ($groupRoutes)  {
    $groupRoutes->controller(SiteSettingsController::class)->prefix('site-settings')->as('site-settings.')->group(function ($route) {
        $route->get('site', 'index')->name('index');
        $route->post('site/update', 'update')->name('update');
    });

    $groupRoutes->group(['prefix'=> 'front-settings', 'as' => 'front-settings.'], function ($siteSettings)  {

        $siteSettings->controller(ServicesController::class)->prefix('services')->as('services.')->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->post('services', 'store')->name('store');
            $route->get('services/{id}/edit', 'edit')->name('edit');
            $route->post('services/{id}/update', 'update')->name('update');
            $route->post('services/delete', 'delete')->name('delete');
            $route->post('services/status/change', 'changeStatus')->name('change-status');
            $route->get('contact', 'contact')->name('contact');
            $route->post('contact/delete/{id}', 'contactDelete')->name('contact.delete');
        });

        $siteSettings->controller(FaqController::class)->prefix('faq')->as('faq.')->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->post('faq', 'store')->name('store');
            $route->get('faq/{id}/edit', 'edit')->name('edit');
            $route->post('faq/{id}/update', 'update')->name('update');
            $route->post('faq/{id}/delete', 'delete')->name('delete');
            $route->post('faq/status/change', 'changeStatus')->name('change-status');
        });

        // Solution Category Routes
        $siteSettings->controller(SolutionCategoryController::class)
            ->prefix('solution-categories')
            ->as('solution-categories.')
            ->group(function ($route) {
                $route->get('/', 'index')->name('index');
                $route->post('/', 'store')->name('store');
                $route->put('/{category}', 'update')->name('update');
                $route->delete('/{category}', 'destroy')->name('destroy');
            });

        // Solution Routes
        $siteSettings->controller(SolutionController::class)
            ->prefix('solutions')
            ->as('solutions.')
            ->group(function ($route) {
                $route->get('/', 'index')->name('index');
                $route->post('/', 'store')->name('store');
                $route->put('/{solution}', 'update')->name('update');
                $route->delete('/{solution}', 'destroy')->name('destroy');
            });
    });

    $groupRoutes->group(['prefix'=> 'email-settings', 'as' => 'email-settings.'], function ($emailSettings)  {
        $emailSettings->controller(\App\Http\Controllers\GeneralSettings\EmailSettingsController::class)->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->post('/', 'update')->name('update');
            $route->post('/test', 'testEmail')->name('test');
        });
    });
});

// Helpdesk Routes
Route::group(['prefix'=> 'helpdesk', 'as' => 'helpdesk.', 'middleware' => ['auth']], function ($groupRoutes)  {

    $groupRoutes->controller(HelpdeskCategoryController::class)->group(function ($routes) {
        $routes->get('/helpdesk-categories', 'index')->name('helpdesk-categories.index');
        $routes->post('/helpdesk-categories-store', 'store')->name('helpdesk-categories.store');
        $routes->get('/helpdesk-categories/{id}', 'edit')->name('helpdesk-categories.edit');
        $routes->post('/helpdesk-categories/{id}/update', 'update')->name('helpdesk-categories.update');
        $routes->post('/helpdesk-categories-destroy', 'destroy')->name('helpdesk-categories.delete');
        $routes->post('helpdesk/status/change', 'changeStatus')->name('helpdesk-categories.change-status');
    });
    $groupRoutes->controller(TicketController::class)->group(function ($routes) {
        $routes->get('/tickets', 'index')->name('tickets.index');
        $routes->get('/pending-tickets', 'pendingTicket')->name('tickets.pending');
        $routes->get('/closed-tickets', 'closedTicket')->name('tickets.closed');
        $routes->get('/answered-tickets', 'answeredTicket')->name('tickets.answered');
        $routes->get('/tickets-create', 'create')->name('tickets.create');
        $routes->post('/tickets-store', 'store')->name('tickets.store');
        $routes->get('/tickets/{id}', 'edit')->name('tickets.edit');
        $routes->post('/tickets/{id}/update', 'update')->name('tickets.update');
        $routes->post('/tickets-destroy', 'destroy')->name('tickets.delete');
        $routes->get('tickets/details/{id}/{tab}', 'details')->name('tickets.details');

    });

    $groupRoutes->controller(TicketReplyController::class)->group(function ($routes) {
        $routes->post('/tickets/{id}/reply', 'reply')->name('tickets.reply');

    });
});
Route::controller(CustomOrderController::class)->middleware(['auth'])->group(function ($routes) {
    $routes->get('custom-order', 'index')->name('custom-order.index');
    $routes->post('custom-order', 'store')->name('custom-order.store');
    $routes->get('custom-order/{id}/edit', 'edit')->name('custom-order.edit');
    $routes->post('custom-order/{id}/update', 'update')->name('custom-order.update');
    $routes->post('custom-order/destroy', 'destroy')->name('custom-order.delete');
    $routes->post('custom-order/status/change', 'changeStatus')->name('custom-order.change-status');
    $routes->get('custom-order/pending-custom-order', 'pendingCustomOrder')->name('pending-custom-order');
    $routes->get('custom-order/approved-custom-order', 'approvedCustomOrder')->name('approved-custom-order');
    $routes->get('custom-order/rejected-custom-order', 'rejectedCustomOrder')->name('rejected-custom-order');
    $routes->post('custom-order/approve', 'approve')->name('custom-order.approve');
    $routes->post('custom-order/reject', 'reject')->name('custom-order.reject');
});

// Package Purchase Management Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('purchase-package')->name('purchase-package.')->group(function () {
        Route::get('active', [PurchasePackageController::class, 'activeIndex'])->name('active');
        Route::get('inactive', [PurchasePackageController::class, 'inactiveIndex'])->name('inactive');
        Route::get('expired', [PurchasePackageController::class, 'expiredIndex'])->name('expired');
        Route::get('add', [PurchasePackageController::class, 'addPackageToUserIndex'])->name('add');
        Route::post('store', [PurchasePackageController::class, 'addPackageToUserStore'])->name('store');
    });

    Route::prefix('billing')->name('billing.')->group(function () {
        Route::get('bills', [BillController::class, 'index'])->name('index');
        Route::get('bills/generate', [BillController::class, 'generateBills'])->name('generate');
        Route::get('bills/{id}', [BillController::class, 'show'])->name('show');
        Route::get('bills/customer/{customerId}', [BillController::class, 'customerBills'])->name('customer');
        Route::post('bills/{id}/approve', [BillController::class, 'approvePayment'])->name('approve');
        Route::post('bills/{id}/reject', [BillController::class, 'reject'])->name('reject');
    });
});

// Customer Package Routes
Route::prefix('customer')->middleware(['auth'])->name('customer.')->group(function () {
    Route::get('/packages', [App\Http\Controllers\Package\PackageController::class, 'customerPackages'])->name('packages.index');
    Route::get('/my-packages', [App\Http\Controllers\Package\PackageController::class, 'myPackages'])->name('packages.my-packages');
    Route::get('/package/{uuid}/details', [App\Http\Controllers\Package\PackageController::class, 'customerPackageDetails'])->name('package.details');
    Route::get('/package-requests', [App\Http\Controllers\Package\PackageRequestController::class, 'myRequests'])->name('package-requests');
    Route::post('/package-requests', [App\Http\Controllers\Package\PackageRequestController::class, 'store'])->name('package-requests.store');

    // Customer Billing Routes
    Route::prefix('billing')->name('billing.')->group(function () {
        Route::get('/', [App\Http\Controllers\BillingController::class, 'myBills'])->name('index');
        Route::get('/{bill}', [App\Http\Controllers\BillingController::class, 'customerShow'])->name('show')->where('bill', '[0-9]+');
        Route::post('/{bill}/pay', [App\Http\Controllers\BillingController::class, 'customerPay'])->name('pay')->where('bill', '[0-9]+');
    });
});

// Package Purchase Routes
Route::prefix('package')->group(function () {
    Route::get('/confirm/{id}', [App\Http\Controllers\Package\PackageController::class, 'confirmPackage'])->name('package.confirm');
    Route::post('/purchase/{id}', [App\Http\Controllers\Package\PackageController::class, 'purchasePackage'])->name('package.purchase');
});

// Package Request Routes
Route::post('/package-requests', [App\Http\Controllers\Package\PackageRequestController::class, 'store'])->name('package-requests.store');

// Messaging Routes
Route::get('/messaging', [App\Http\Controllers\MessageController::class, 'index'])->name('messaging.index');
Route::post('/send-message', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('send.message');

// Admin Billing Routes
Route::prefix('admin/billing')->middleware(['auth'])->name('admin.billing.')->group(function () {
    Route::get('/', [App\Http\Controllers\BillingController::class, 'index'])->name('index');
    Route::get('/generate', [App\Http\Controllers\BillingController::class, 'generate'])->name('generate');
    Route::get('/customer/{customerId}', [App\Http\Controllers\BillingController::class, 'customerBills'])->name('customer');
    Route::get('/{bill}', [App\Http\Controllers\BillingController::class, 'show'])->name('show')->where('bill', '[0-9]+');
    Route::post('/{bill}/approve', [App\Http\Controllers\BillingController::class, 'approve'])->name('approve')->where('bill', '[0-9]+');
    Route::post('/{bill}/reject', [App\Http\Controllers\BillingController::class, 'reject'])->name('reject')->where('bill', '[0-9]+');
});

// Customer Billing Routes
Route::prefix('customer/billing')->middleware(['auth'])->name('customer.billing.')->group(function () {
    Route::get('/', [App\Http\Controllers\BillingController::class, 'myBills'])->name('index');
    Route::get('/bills/{bill}', [App\Http\Controllers\BillingController::class, 'customerShow'])->name('show');
    Route::post('/bills/{bill}/pay', [App\Http\Controllers\BillingController::class, 'customerPay'])->name('pay');
});
