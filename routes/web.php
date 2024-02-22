<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WestHillController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;

Route::get('/storage_link' , function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder,$linkFolder);
});

 Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashController::class, 'dashboard'])->name('dashboard');
     Route::get('/calendar', [DashController::class, 'calendar'])->name('calendar');
     Route::get('/comments-count', [DashController::class, 'getCommentsCount']);

 });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile-deactivate', [ProfileController::class, 'deactivate'])->name('deactivate');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/showCategory', [CategoryController::class, 'showCategory'])->name('showCategory');
    Route::get('/createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('/editCategory/{category}', [CategoryController::class, 'editCategory'])->name('editCategory');
    Route::put('/updateCategory/{category}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/storeCategory', [CategoryController::class, 'storeCategory'])->name('storeCategory');
    Route::delete('deleteCategory/{category}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
});

// Gallery Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/showGallery', [GalleryController::class, 'showGallery'])->name('showGallery');
    Route::get('/createGallery', [GalleryController::class, 'createGallery'])->name('createGallery');
    Route::post('/storeGallery', [GalleryController::class, 'storeGallery'])->name('storeGallery');
    Route::delete('/deleteGallery/{gallery}', [GalleryController::class, 'deleteGallery'])->name('deleteGallery');
});

//Amenity Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/showAmenities', [AmenitiesController::class, 'showAmenities'])->name('showAmenities');
    Route::get('/createAmenities', [AmenitiesController::class, 'createAmenities'])->name('createAmenities');
    Route::get('/editAmenities/{amenity}', [AmenitiesController::class, 'editAmenities'])->name('editAmenities');
    Route::put('/updateAmenities/{amenity}', [AmenitiesController::class, 'updateAmenities'])->name('updateAmenities');
    Route::post('/storeAmenities', [AmenitiesController::class, 'storeAmenities'])->name('storeAmenities');
    Route::delete('deleteAmenities/{amenity}', [AmenitiesController::class, 'deleteAmenities'])->name('deleteAmenities');
});

//Blog Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/createBlogs', [BlogController::class, 'createBlogs'])->name('createBlogs');
    Route::post('/storeBlogs', [BlogController::class, 'storeBlogs'])->name('storeBlogs');
    Route::get('/showBlogs', [BlogController::class, 'showBlogs'])->name('showBlogs');
    Route::get('/editBlog/{blog}', [BlogController::class, 'editBlogs'])->name('editBlogs');
    Route::put('/updateBlog/{blog}', [BlogController::class, 'updateBlogs'])->name('updateBlogs');
    Route::delete('/deleteBlog/{blog:slug}', [BlogController::class, 'deleteBlogs'])->name('deleteBlogs');
});

// Tag Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/showAttachment', [AttachmentController::class, 'showAttachment'])->name('showAttachment');
    Route::get('/createAttachment', [AttachmentController::class, 'createAttachment'])->name('createAttachment');
    Route::get('/editAttachment/{attachment}', [AttachmentController::class, 'editAttachment'])->name('editAttachment');
    Route::put('/updateAttachment/{attachment}', [AttachmentController::class, 'updateAttachment'])->name('updateAttachment');
    Route::post('/storeAttachment', [AttachmentController::class, 'storeAttachment'])->name('storeAttachment');
    Route::delete('deleteAttachment/{attachment}', [AttachmentController::class, 'deleteAttachment'])->name('deleteAttachment');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/createProperty', [PropertyController ::class, 'createProperty'])->name('createProperty');
    Route::get('/createPropertyAp', [PropertyController ::class, 'createPropertyAp'])->name('createPropertyAp');
    Route::post('/storeProperty', [PropertyController ::class, 'storeProperty'])->name('storeProperty');
    Route::post('/storePropertyAp', [PropertyController ::class, 'storePropertyAp'])->name('storePropertyAp');
    Route::post('/createAmenity', [PropertyController ::class, 'createAmenity'])->name('createAmenity');
    Route::post('/updateAmenity', [PropertyController ::class, 'updateAmenity'])->name('updateAmenity');
    Route::get('/showProperty', [PropertyController ::class, 'showProperty'])->name('showProperty');
    Route::get('/showApartment', [PropertyController ::class, 'showApartment'])->name('showApartment');
    Route::get('/editProperty/{property}', [PropertyController ::class, 'editProperty'])->name('editProperty');
    Route::get('/editPropertyAp/{property}', [PropertyController ::class, 'editPropertyAp'])->name('editPropertyAp');
    Route::put('/updateProperty/{property}', [PropertyController ::class, 'updateProperty'])->name('updateProperty');
    Route::put('/updatePropertyAp/{property}', [PropertyController ::class, 'updatePropertyAp'])->name('updatePropertyAp');
    Route::delete('/deleteProperty/{property}', [PropertyController ::class, 'deleteProperty'])->name('deleteProperty');
    Route::delete('/deletePropertyAp/{property}', [PropertyController ::class, 'deletePropertyAp'])->name('deletePropertyAp');
    Route::post('/addToSlide/{property}', [PropertyController::class, 'addPropertyToSlide'])->name('addPropertyToSlide');
    Route::get('/showPropertyToSlide', [PropertyController ::class, 'showPropertySlider'])->name('showPropertySlider');
    Route::delete('/deletePropertySlider/{slider}', [PropertyController ::class, 'deletePropertySlider'])->name('deletePropertySlider');

});




 //Account Routes
   Route::middleware(['auth'])->group(function () {
        Route::get('/showUser', [ProfileController::class, 'showUser'])->name('showUser');
        Route::get('/createNewUser', [ProfileController::class, 'create'])->name('create');
        Route::post('/createNewUser', [ProfileController::class, 'storeUser'])->name('storeUser');
   });


     Route::middleware(['auth'])->group(function () {
         Route::get('download/monthly/report', [ReportController::class, 'downloadMonthlyReport'])->name('download.monthly.report');
         Route::get('download/yearly/report', [ReportController::class, 'downloadYearlyReport'])->name('download.yearly.report');
         Route::get('download/monthly/apartment/report', [ReportController::class, 'downloadMonthlyApartmentReport'])->name('download.monthly.apartment.report');
         Route::get('download/yearly/apartment/report', [ReportController::class, 'downloadYearlyApartmentReport'])->name('download.yearly.apartment.report');
     });


//Blog Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/createEvents', [EventsController ::class, 'createEvents'])->name('createEvents');
    Route::post('/storeEvents', [EventsController ::class, 'storeEvents'])->name('storeEvents');
    Route::get('/showEvents', [EventsController ::class, 'showEvents'])->name('showEvents');
    Route::get('/editEvents/{event}', [EventsController ::class, 'editEvents'])->name('editEvents');
    Route::put('/updateEvents/{event}', [EventsController ::class, 'updateEvents'])->name('updateEvents');
    Route::delete('/deleteEvents/{event:slug}', [EventsController ::class, 'deleteEvents'])->name('deleteEvents');

      Route::get('/showSwiper', [DashController::class, 'showSwiper'])->name('showSwiper');
      Route::get('/createSwiper', [DashController::class, 'createSwiper'])->name('createSwiper');
      Route::post('/storeSwiper', [DashController::class, 'storeSwiper'])->name('storeSwiper');
      Route::delete('deleteSwiper/{swiper}', [DashController::class, 'deleteSwiper'])->name('deleteSwiper');


    //Slider
     Route::get('/showEventsToSlide', [EventsController ::class, 'showEventsSlider'])->name('showEventsSlider');
     Route::post('/addToSlide/{eventId}', [EventsController::class, 'addToSlide'])->name('addToSlide');

});


require __DIR__.'/auth.php';
