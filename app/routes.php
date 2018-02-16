<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'guest'), function() {

    Route::get('/auth/login', array(
        'as' => 'auth.login',
        'uses' => 'AuthController@login'
    ));

    Route::post('/auth/store', array(
        'as' => 'auth.store',
        'uses' => 'AuthController@store'
    ));

});

Route::group(array('before' => 'auth'), function() {

    /*
     * Common Routes
     */
    Route::get('/', array(
        'as' => 'dashboard.index',
        'uses' => 'DashboardController@index'
    ));

    Route::get('/auth/logout', array(
        'as' => 'auth.logout',
        'uses' => 'AuthController@logout'
    ));

    Route::get('/profile', array(
        'as' => 'profile.index',
        'uses' => 'ProfileController@index'
    ));

    Route::post('/profile/edit', array(
        'as' => 'profile.edit.post',
        'uses' => 'ProfileController@editPost'
    ));

    /*
     * System User Routes
     */
    Route::get('/system/users', array(
        'as' => 'system.users.index',
        'uses' => 'SystemUsersController@index'
    ));

    Route::get('/system/users/create', array(
        'as' => 'system.users.create',
        'uses' => 'SystemUsersController@create'
    ));

    Route::post('/system/users/create', array(
        'as' => 'system.users.create.post',
        'uses' => 'SystemUsersController@createPost'
    ));

    Route::get('/system/users/show/{id}', array(
        'as' => 'system.users.show',
        'uses' => 'SystemUsersController@show'
    ));

    Route::get('/system/users/edit/{id}', array(
        'as' => 'system.users.edit',
        'uses' => 'SystemUsersController@edit'
    ));

    Route::post('/system/users/edit', array(
        'as' => 'system.users.edit.post',
        'uses' => 'SystemUsersController@editPost'
    ));

    Route::post('/system/users/remove', array(
        'as' => 'system.users.remove.post',
        'uses' => 'SystemUsersController@removePost'
    ));

    /*
     * Log Routes
     */
    Route::get('/system/logs', array(
        'as' => 'system.logs.index',
        'uses' => 'SystemLogsController@index'
    ));

    /*
     * Customer Routes
     */
    Route::get('/customer', array(
        'as' => 'customer.index',
        'uses' => 'CustomerController@index'
    ));

    Route::get('/customer/create', array(
        'as' => 'customer.create',
        'uses' => 'CustomerController@create'
    ));

    Route::post('/customer/create', array(
        'as' => 'customer.create.post',
        'uses' => 'CustomerController@createPost'
    ));

    Route::get('/customer/show/{id}', array(
        'as' => 'customer.show',
        'uses' => 'CustomerController@show'
    ));

    Route::get('/customer/edit/{id}', array(
        'as' => 'customer.edit',
        'uses' => 'CustomerController@edit'
    ));

    Route::post('/customer/edit', array(
        'as' => 'customer.edit.post',
        'uses' => 'CustomerController@editPost'
    ));

    Route::post('/customer/remove', array(
        'as' => 'customer.remove.post',
        'uses' => 'CustomerController@removePost'
    ));

    Route::get('/customer/detail', array(
        'as' => 'customer.detail',
        'uses' => 'CustomerDetailController@index'
    ));

    Route::get('/customer/detail/create', array(
        'as' => 'customer.detail.create',
        'uses' => 'CustomerDetailController@create'
    ));

    Route::post('/customer/detail/create', array(
        'as' => 'customer.detail.create.post',
        'uses' => 'CustomerDetailController@store'
    ));

    Route::get('/customer/detail/edit/{id}', array(
        'as' => 'customer.detail.edit',
        'uses' => 'CustomerDetailController@edit'
    ));

    Route::post('/customer/detail/remove', array(
        'as' => 'customer.detail.remove',
        'uses' => 'CustomerDetailController@destroy'
    ));

    Route::post('/customer/detail/edit', array(
        'as' => 'customer.detail.edit.post',
        'uses' => 'CustomerDetailController@update'
    ));

    /*
     * Customer Group Routes
     */
    Route::get('/customer/group', array(
        'as' => 'customer.group.index',
        'uses' => 'CustomerGroupController@index'
    ));

    Route::get('/customer/group/create', array(
        'as' => 'customer.group.create',
        'uses' => 'CustomerGroupController@create'
    ));

    Route::post('/customer/group/create', array(
        'as' => 'customer.group.create.post',
        'uses' => 'CustomerGroupController@createPost'
    ));

    Route::get('/customer/group/show/{id}', array(
        'as' => 'customer.group.show',
        'uses' => 'CustomerGroupController@show'
    ));

    Route::get('/customer/group/edit/{id}', array(
        'as' => 'customer.group.edit',
        'uses' => 'CustomerGroupController@edit'
    ));

    Route::post('/customer/group/edit', array(
        'as' => 'customer.group.edit.post',
        'uses' => 'CustomerGroupController@editPost'
    ));

    Route::post('/customer/group/remove', array(
        'as' => 'customer.group.remove.post',
        'uses' => 'CustomerGroupController@removePost'
    ));

    /*
     * Customer Reminder Routes
     */
    Route::post('/customer/reminder/create', array(
        'as' => 'customer.reminder.create.post',
        'uses' => 'CustomerReminderController@createPost'
    ));

    Route::get('/customer/reminder/{id}', array(
        'as' => 'customer.reminder.passive',
        'uses' => 'CustomerReminderController@reminderPassive'
    ));

    /*
     * Meeting Routes
     */
    Route::get('/meeting/create/{id}', array(
        'as' => 'meeting.create',
        'uses' => 'MeetingController@create'
    ));

    /*
     * Meeting Detail Routes
     */
    Route::get('/meeting/detail/{id}', array(
        'as' => 'meeting.detail.index',
        'uses' => 'MeetingDetailController@index'
    ));

    Route::post('/meeting/detail/create', array(
        'as' => 'meeting.detail.create.post',
        'uses' => 'MeetingDetailController@createPost'
    ));

    /*
     * Project Routes
     */
    Route::get('/project', array(
        'as' => 'project.index',
        'uses' => 'ProjectController@index'
    ));

    Route::get('/project/create', array(
        'as' => 'project.create',
        'uses' => 'ProjectController@create'
    ));

    Route::post('/project/create', array(
        'as' => 'project.create.post',
        'uses' => 'ProjectController@createPost'
    ));

    Route::get('/project/show/{id}', array(
        'as' => 'project.show',
        'uses' => 'ProjectController@show'
    ));

    Route::get('/project/edit/{id}', array(
        'as' => 'project.edit',
        'uses' => 'ProjectController@edit'
    ));

    Route::post('/project/edit', array(
        'as' => 'project.edit.post',
        'uses' => 'ProjectController@editPost'
    ));

    Route::post('/project/remove', array(
        'as' => 'project.remove.post',
        'uses' => 'ProjectController@removePost'
    ));

    /*
     * Building Routes
     */
    Route::get('/building', array(
        'as' => 'building.index',
        'uses' => 'BuildingController@index'
    ));

    Route::get('/building/create', array(
        'as' => 'building.create',
        'uses' => 'BuildingController@create'
    ));

    Route::post('/building/create', array(
        'as' => 'building.create.post',
        'uses' => 'BuildingController@createPost'
    ));

    Route::get('/building/show/{id}', array(
        'as' => 'building.show',
        'uses' => 'BuildingController@show'
    ));

    Route::get('/building/edit/{id}', array(
        'as' => 'building.edit',
        'uses' => 'BuildingController@edit'
    ));

    Route::post('/building/edit', array(
        'as' => 'building.edit.post',
        'uses' => 'BuildingController@editPost'
    ));

    Route::post('/building/remove', array(
        'as' => 'building.remove.post',
        'uses' => 'BuildingController@removePost'
    ));

    Route::get('/pdf/qrcode/building/show/{id}', array(
        'as' => 'pdf.qrcode.building.show',
        'uses' => 'PDFController@qrcodeBuildingShow'
    ));

    /*
     * Apartment Routes
     */
    Route::get('/apartment', array(
        'as' => 'apartment.index',
        'uses' => 'ApartmentController@index'
    ));

    Route::get('/apartment/create', array(
        'as' => 'apartment.create',
        'uses' => 'ApartmentController@create'
    ));

    Route::post('/apartment/create', array(
        'as' => 'apartment.create.post',
        'uses' => 'ApartmentController@createPost'
    ));

    Route::get('/apartment/show/{id}', array(
        'as' => 'apartment.show',
        'uses' => 'ApartmentController@show'
    ));

    Route::get('/apartment/edit/{id}', array(
        'as' => 'apartment.edit',
        'uses' => 'ApartmentController@edit'
    ));

    Route::post('/apartment/edit', array(
        'as' => 'apartment.edit.post',
        'uses' => 'ApartmentController@editPost'
    ));

    Route::post('/apartment/remove', array(
        'as' => 'apartment.remove.post',
        'uses' => 'ApartmentController@removePost'
    ));

    /*
    * Reserved Routes
    */
    Route::get('/reserved', array(
        'as' => 'reserved.index',
        'uses' => 'ReservedController@index'
    ));
    Route::get('/reserved/create', array(
        'as' => 'reserved.create',
        'uses' => 'ReservedController@create'
    ));
    Route::post('/reserved/create', array(
        'as' => 'reserved.create.post',
        'uses' => 'ReservedController@store'
    ));
    Route::post('/reserved/remove', array(
        'as' => 'reserved.remove.post',
        'uses' => 'ReservedController@destroy'
    ));

    /*
     * Offer Routes
     */
    Route::get('/offer', array(
        'as' => 'offer.index',
        'uses' => 'OfferController@index'
    ));

    Route::get('/offer/create', array(
        'as' => 'offer.create',
        'uses' => 'OfferController@create'
    ));

    Route::post('/offer/create', array(
        'as' => 'offer.create.post',
        'uses' => 'OfferController@createPost'
    ));

    /*
     * Payment Routes
     */
    Route::get('/payment-plan', array(
        'as' => 'payment-plan.index',
        'uses' => 'PaymentPlanController@index'
    ));
    
    Route::get('/payment-plan/create', array(
        'as' => 'payment-plan.create',
        'uses' => 'PaymentPlanController@create'
    ));

    Route::post('/payment-plan/create', array(
        'as' => 'payment-plan.create.post',
        'uses' => 'PaymentPlanController@createPost'
    ));

    /*
     * Sales Routes
     */
    Route::get('/sales', array(
        'as' => 'sales.index',
        'uses' => 'SalesController@index'
    ));

    Route::get('/sales/create', array(
        'as' => 'sales.create',
        'uses' => 'SalesController@create'
    ));

    Route::post('/sales/create', array(
        'as' => 'sales.create.post',
        'uses' => 'SalesController@createPost'
    ));

    Route::get('/personal-report', array(
        'as' => 'personal-report.index',
        'uses' => 'PersonalReportController@index'
    ));

    /*
     * Call Center Routes
     */
    Route::get('/call-center', array(
        'as' => 'call.index',
        'uses' => 'CallCenterController@index'
    ));


    Route::post('/status-update', array(
        'as' => 'status.index',
        'uses' => 'CallCenterController@messageStatus'

    ));

    /*
     * Form Routes
     */
    Route::get('/form', array(
        'as' => 'form.index',
        'uses' => 'FormController@index'
    ));

    Route::post('/form-update', array(
        'as' => 'form-status.index',
        'uses' => 'FormController@messageStatus'

    ));
    /*
     * API Routes
     */
    Route::post('/api/get/buildings', array(
        'as' => 'api.get.buildings',
        'uses' => 'APIController@getBuildings'
    ));

    Route::post('/api/get/apartments', array(
        'as' => 'api.get.apartments',
        'uses' => 'APIController@getApartments'
    ));

    Route::post('/api/get/apartment', array(
        'as' => 'api.get.apartment',
        'uses' => 'APIController@getApartment'
    ));

    Route::get('/api/get/customer/groups', array(
        'as' => 'api.get.customer.groups',
        'uses' => 'APIController@getCustomerGroups'
    ));

    Route::post('/api/get/offers', array(
        'as' => 'api.get.offers',
        'uses' => 'APIController@getOffers'
    ));

    Route::post('/api/get/reminder', array(
        'as' => 'api.get.reminder',
        'uses' => 'APIController@getReminder'
    ));

});

/*
 * Qrcode Routes
 */
Route::get('/pdf/offer/show/{id}', array(
    'as' => 'pdf.offer.show',
    'uses' => 'PDFController@offerShow'
));

Route::get('/pdf/apartment/show/{id}', array(
    'as' => 'pdf.apartment.show',
    'uses' => 'PDFController@apartmentShow'
));

Route::get('/pdf/payment-plan/show/{id}', array(
    'as' => 'pdf.payment-plan.show',
    'uses' => 'PDFController@paymentPlanShow'
));

/*
 * API Routes
 */
Route::get('/api/get/customers',array(
    'as' => 'api.get.customers',
    'uses' => 'APIController@getCustomers'
));

Route::post('/api/post/call-center', array(
    'as' => 'api.post.call-center',
    'uses' => 'CallCenterController@store'
));