<?php


use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ApponitmentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;




Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {

        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('permissions', PermissionsController::class);

        // Roles
        Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('roles', RolesController::class);

        // Users
        Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('users', UsersController::class);







        // Contacts routes
        Route::delete('contacts/destroy', [ContactsController::class, 'massDestroy'])->name('contacts.massDestroy');
        Route::resource('contacts', ContactsController::class);

        // Leads routes
        Route::delete('leads/destroy', [LeadsController::class, 'massDestroy'])->name('leads.massDestroy');
        Route::resource('leads', LeadsController::class);

        // Products
        Route::delete('products/destroy', [ProductsController::class, 'massDestroy'])->name('products.massDestroy');
        Route::resource('products', ProductsController::class);

         // ProductCategory
         Route::delete('productCategory/destroy', [ProductCategoryController::class, 'massDestroy'])->name('productCategory.massDestroy');
         Route::resource('productCategory', ProductCategoryController::class);

        // Quatation routes
        Route::delete('quotations/destroy', [QuotationController::class, 'massDestroy'])->name('quotations.massDestroy');
        Route::resource('quotations', QuotationController::class);
        Route::put('admin/quotations/{lead}', [QuotationController::class, 'update'])->name('quotations.update');

        Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
        Route::post('/send-quotation/{leadId}', [QuotationController::class, 'sendQuotationEmail'])->name('send.quotation');

        Route::post('/send-demo/{leadId}', [ApponitmentsController::class, 'sendDemoEmail'])->name('send.demo');

        // Appointments routes
        Route::delete('appointments/destroy', [ApponitmentsController::class, 'massDestroy'])->name('appointments.massDestroy');
        Route::resource('appointments', ApponitmentsController::class);


        Route::get('admin/leads/{lead}/products', [LeadsController::class, 'getProducts'])->name('leads.products');
//
        Route::get('/leads/get-assigned-name', [LeadsController::class, 'getAssignedName'])
        ->name('leads.getAssignedName');

        Route::get('/lead/{id}', [LeadsController::class, 'getLeadDetails']);
        Route::get('/leads/{id}/products', [LeadsController::class, 'getLeadProducts']);


});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::get('change-password', [ChangePasswordController::class, 'password'])->name('password.change-password');
    Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
    Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
    Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
});
