

<?php

use App\Http\Controllers\Admin\OtherExpenseController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BouncerPDFController;
use App\Http\Controllers\Admin\VouncherPDFController;
use App\Http\Controllers\Admin\Account\UserAccountController;
use App\Http\Controllers\Admin\Account\AdminAccountController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Admin\Report\ReportController;

use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProfitController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SalaryController;

Route::middleware("guest:admin")->prefix("/admin")->name("admin.")->group(function () {
    Route::get('/register', [RegisteredAdminController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredAdminController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware("auth:admin")->prefix('/admin')->name("admin.")->group(function () {
    Route::get('/dashboard', [HomeController::class, "index"])->name("dashboard");

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::controller(CategoryController::class)->prefix('/category')->name("category.")->group(function () {
        Route::get("/", 'index')->name("index");
        Route::get("/create", 'create')->name("create");
        Route::post("/store", 'store')->name("store");
        Route::get("/show/{category}", 'show')->name("show");
        Route::get("/edit/{category}", 'edit')->name("edit");
        Route::put("/update/{category}", 'update')->name("update");
        Route::get("/destroy/{category}", 'destroy')->name("destroy");
    });

    Route::controller(ProductController::class)->prefix('/product')->name("product.")->group(function () {
        Route::get("/", 'index')->name("index");
        Route::get("/create", 'create')->name("create");
        Route::post("/store", 'store')->name("store");
        Route::get("/show/{product}", 'show')->name("show");
        Route::get("/edit/{product}", 'edit')->name("edit");
        Route::put("/update/{product}", 'update')->name("update");
        Route::get("/destroy/{product}", 'destroy')->name("destroy");
    });


    Route::controller(SaleController::class)->prefix('/sale')->name("sale.")->group(function () {
        Route::get("/index", "index")->name("index");
        Route::get("/show/{sale}", "show")->name("show");
        Route::get("/new", "new")->name("new");
        Route::get("/create/{sale}/{category}", "create")->name("create");
        Route::get("/all", "index")->name("index");
        Route::post("/product/add/{sale}", "addProduct")->name("product.add");
        Route::put("/product/update/{sale}", "updateProduct")->name("product.update");
        Route::post("/store/{sale}", "store")->name("store");
        Route::get("/drafts", "drafts")->name("drafts");
        Route::delete("/destory/{sale}", "destory")->name("destory");
    });

    Route::get('generate-pdf/{sale}', [VouncherPDFController::class, 'generatePDF'])->name("bouncer");

    Route::controller(AdminAccountController::class)->prefix("/account/admin")->name("account.admin.")->group(function () {
        Route::get("/index", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store");
        Route::get("/edit/{admin}", "edit")->name("edit");
        Route::put('/update/{admin}', "update")->name("update");
    });
    Route::controller(UserAccountController::class)->prefix("/account/user")->name("account.user.")->group(function () {
        Route::get("/index", "index")->name("index");
    });

    Route::controller(OrderController::class)->prefix("/order")->name("order.")->group(function () {
        Route::get("index/{type?}", "index")->name("index");
        Route::get("approve/{order}", "approve")->name("approve");
        Route::get("complete/{order}", "complete")->name("complete");
        Route::get("reject/{order}", "showRejectPage")->name("reject");
        Route::post("reject/{order}", "reject")->name("reject");
        Route::get("show/{order}", "show")->name("show");
    });

    Route::get("report/budget", [ReportController::class, "index"])->name("report.budget");

    Route::resource('employees',  EmployeeController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('salaries', SalaryController::class);
    route::prefix("expenses")->name("expenses.")->group(function () {
        Route::resource('others', OtherExpenseController::class);
    });

    Route::get("profits", [ProfitController::class, "analysis"])->name('profits');
});
Route::get('generate-order-pdf/{order}', [VouncherPDFController::class, 'generateOrderPDF'])->name("admin.order.vouncer");
Route::get("most-buy-customer", [OrderController::class, 'getMostBuyCustomer'])->name("users.most.buy");
