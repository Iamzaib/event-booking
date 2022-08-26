<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Blog Category
    Route::delete('blog-categories/destroy', 'BlogCategoryController@massDestroy')->name('blog-categories.massDestroy');
    Route::resource('blog-categories', 'BlogCategoryController');

    // Blog Tag
    Route::delete('blog-tags/destroy', 'BlogTagController@massDestroy')->name('blog-tags.massDestroy');
    Route::resource('blog-tags', 'BlogTagController');

    // Blog Post
    Route::delete('blog-posts/destroy', 'BlogPostController@massDestroy')->name('blog-posts.massDestroy');
    Route::post('blog-posts/media', 'BlogPostController@storeMedia')->name('blog-posts.storeMedia');
    Route::post('blog-posts/ckmedia', 'BlogPostController@storeCKEditorImages')->name('blog-posts.storeCKEditorImages');
    Route::resource('blog-posts', 'BlogPostController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Admin
    Route::delete('admins/destroy', 'AdminController@massDestroy')->name('admins.massDestroy');
    Route::resource('admins', 'AdminController');

    // Event Addons
    Route::delete('event-addons/destroy', 'EventAddonsController@massDestroy')->name('event-addons.massDestroy');
    Route::resource('event-addons', 'EventAddonsController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Costume
    Route::delete('costumes/destroy', 'CostumeController@massDestroy')->name('costumes.massDestroy');
    Route::resource('costumes', 'CostumeController');

    // Costume Attribute
    Route::delete('costume-attributes/destroy', 'CostumeAttributeController@massDestroy')->name('costume-attributes.massDestroy');
    Route::resource('costume-attributes', 'CostumeAttributeController');

    // Event Ticket
    Route::delete('event-tickets/destroy', 'EventTicketController@massDestroy')->name('event-tickets.massDestroy');
    Route::resource('event-tickets', 'EventTicketController');

    // Event Booking
    Route::delete('event-bookings/destroy', 'EventBookingController@massDestroy')->name('event-bookings.massDestroy');
    Route::resource('event-bookings', 'EventBookingController');

    // Traveler
    Route::delete('travelers/destroy', 'TravelerController@massDestroy')->name('travelers.massDestroy');
    Route::resource('travelers', 'TravelerController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // Hotels
    Route::delete('hotels/destroy', 'HotelsController@massDestroy')->name('hotels.massDestroy');
    Route::resource('hotels', 'HotelsController');

    // Hotel Rooms
    Route::delete('hotel-rooms/destroy', 'HotelRoomsController@massDestroy')->name('hotel-rooms.massDestroy');
    Route::resource('hotel-rooms', 'HotelRoomsController');

    // Amenities
    Route::delete('amenities/destroy', 'AmenitiesController@massDestroy')->name('amenities.massDestroy');
    Route::post('amenities/media', 'AmenitiesController@storeMedia')->name('amenities.storeMedia');
    Route::post('amenities/ckmedia', 'AmenitiesController@storeCKEditorImages')->name('amenities.storeCKEditorImages');
    Route::resource('amenities', 'AmenitiesController');

    // Setting
    Route::delete('settings/destroy', 'SettingController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::resource('testimonials', 'TestimonialController');

    // Booking Room
    Route::delete('booking-rooms/destroy', 'BookingRoomController@massDestroy')->name('booking-rooms.massDestroy');
    Route::resource('booking-rooms', 'BookingRoomController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Blog Category
    Route::delete('blog-categories/destroy', 'BlogCategoryController@massDestroy')->name('blog-categories.massDestroy');
    Route::resource('blog-categories', 'BlogCategoryController');

    // Blog Tag
    Route::delete('blog-tags/destroy', 'BlogTagController@massDestroy')->name('blog-tags.massDestroy');
    Route::resource('blog-tags', 'BlogTagController');

    // Blog Post
    Route::delete('blog-posts/destroy', 'BlogPostController@massDestroy')->name('blog-posts.massDestroy');
    Route::post('blog-posts/media', 'BlogPostController@storeMedia')->name('blog-posts.storeMedia');
    Route::post('blog-posts/ckmedia', 'BlogPostController@storeCKEditorImages')->name('blog-posts.storeCKEditorImages');
    Route::resource('blog-posts', 'BlogPostController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // States
    Route::delete('states/destroy', 'StatesController@massDestroy')->name('states.massDestroy');
    Route::resource('states', 'StatesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Admin
    Route::delete('admins/destroy', 'AdminController@massDestroy')->name('admins.massDestroy');
    Route::resource('admins', 'AdminController');

    // Event Addons
    Route::delete('event-addons/destroy', 'EventAddonsController@massDestroy')->name('event-addons.massDestroy');
    Route::resource('event-addons', 'EventAddonsController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Costume
    Route::delete('costumes/destroy', 'CostumeController@massDestroy')->name('costumes.massDestroy');
    Route::resource('costumes', 'CostumeController');

    // Costume Attribute
    Route::delete('costume-attributes/destroy', 'CostumeAttributeController@massDestroy')->name('costume-attributes.massDestroy');
    Route::resource('costume-attributes', 'CostumeAttributeController');

    // Event Ticket
    Route::delete('event-tickets/destroy', 'EventTicketController@massDestroy')->name('event-tickets.massDestroy');
    Route::resource('event-tickets', 'EventTicketController');

    // Event Booking
    Route::delete('event-bookings/destroy', 'EventBookingController@massDestroy')->name('event-bookings.massDestroy');
    Route::resource('event-bookings', 'EventBookingController');

    // Traveler
    Route::delete('travelers/destroy', 'TravelerController@massDestroy')->name('travelers.massDestroy');
    Route::resource('travelers', 'TravelerController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // Hotels
    Route::delete('hotels/destroy', 'HotelsController@massDestroy')->name('hotels.massDestroy');
    Route::resource('hotels', 'HotelsController');

    // Hotel Rooms
    Route::delete('hotel-rooms/destroy', 'HotelRoomsController@massDestroy')->name('hotel-rooms.massDestroy');
    Route::resource('hotel-rooms', 'HotelRoomsController');

    // Amenities
    Route::delete('amenities/destroy', 'AmenitiesController@massDestroy')->name('amenities.massDestroy');
    Route::post('amenities/media', 'AmenitiesController@storeMedia')->name('amenities.storeMedia');
    Route::post('amenities/ckmedia', 'AmenitiesController@storeCKEditorImages')->name('amenities.storeCKEditorImages');
    Route::resource('amenities', 'AmenitiesController');

    // Setting
    Route::delete('settings/destroy', 'SettingController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingController');

    // Testimonial
    Route::delete('testimonials/destroy', 'TestimonialController@massDestroy')->name('testimonials.massDestroy');
    Route::resource('testimonials', 'TestimonialController');

    // Booking Room
    Route::delete('booking-rooms/destroy', 'BookingRoomController@massDestroy')->name('booking-rooms.massDestroy');
    Route::resource('booking-rooms', 'BookingRoomController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
