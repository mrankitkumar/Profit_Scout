<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// admin
Route::get('/admin/login', [AdminController::class, 'adminlogin'])->name('adminlogin');
Route::post('/admin/login', [AdminController::class, 'adminloginpost'])->name('adminloginpost');




Route::middleware(['adminsubadmin'])->group(function () {

      Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');
      Route::get('/admin/editprofile', [AdminController::class, 'editadminprofile'])->name('editadminprofile');
      Route::post('/admin/editprofile', [AdminController::class, 'editadminprofilepost'])->name('editadminprofilepost');
      Route::get('/admin/changepassword', [AdminController::class, 'adminchangepassword'])->name('adminchangepassword');
      Route::post('/admin/changepassword', [AdminController::class, 'adminchangepasswordpost'])->name('adminchangepasswordpost');
      Route::get('/admin/managecustomber', [AdminController::class, 'managecustomber'])->name('admin.managecustomber');
      Route::get('/admin/addcustomber', [AdminController::class, 'addcustomber'])->name('admin.addcustomber');
      Route::post('/admin/postaddcustomber', [AdminController::class, 'postAddCustomer'])->name('admin.postaddcustomber');
       
    



      Route::get('/admin/editcustomber/{id}', [AdminController::class, 'editcustomber'])->name('admin.editCustomber');
      Route::post('/admin/editcustomber', [AdminController::class, 'editcustomberpost'])->name('admin.editcustomberpost');
      Route::get('/admin/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('item.delete');

      Route::get('/admin/viewcustomber/{id}', [AdminController::class, 'viewcustomber'])->name('admin.viewCustomber');


      Route::get('/admin/addcompany', [AdminController::class, 'addcompany'])->name('admin.addcompany');
      Route::post('/admin/addcompany', [AdminController::class, 'postaddcompany'])->name('admin.postaddcompany');
      Route::get('/admin/editcompany/{id}', [AdminController::class, 'editcompany'])->name('admin.editCompany');
      Route::post('/admin/editcompany', [AdminController::class, 'editcompanypost'])->name('admin.editcompanypost');
      
      Route::get('/admin/company/{id}', [AdminController::class, 'deleteCompany'])->name('itemcompany.delete');
     
      Route::get('/admin/viewcompany/{id}', [AdminController::class, 'viewcompany'])->name('admin.viewCompany');


      Route::get('/admin/managesubscriptions', [AdminController::class, 'managesubscriptions'])->name('admin.managesubscriptions');
      Route::get('/admin/addpackage', [AdminController::class, 'addpackage'])->name('admin.addpackage');
      Route::post('/admin/addpackage', [AdminController::class, 'addpackagepost'])->name('addpackagepost');


      Route::get('/admin/editpackage/{id}', [AdminController::class, 'editpackage'])->name('admin.editpackage');
      Route::post('/admin/editpackage', [AdminController::class, 'editpackagepost'])->name('editpackagepost');

      Route::get('/admin/managepayment', [AdminController::class, 'managepayment'])->name('admin.managepayment');
      Route::get('/admin/viewcompanypayment', [AdminController::class, 'viewcompanypayment'])->name('admin.viewcompanypayment');
      Route::get('/admin/viewcustomberpayment', [AdminController::class, 'viewcustomberpayment'])->name('admin.viewcustomberpayment');
      Route::get('/admin/manageroleandpermissions', [AdminController::class, 'manageroleandpermissions'])->name('admin.manageroleandpermissions');
      Route::post('/createrole', [AdminController::class, 'createrole'])->name('role.store');
      Route::put('/role/update', [AdminController::class, 'updaterole'])->name('updaterole');
      




      Route::get('/admin/addsubadmin', [AdminController::class, 'addsubadmin'])->name('admin.addsubadmin');
      Route::post('/admin/addsubadmin', [AdminController::class, 'addsubadminpost'])->name('subadmin.store');


      Route::get('/admin/editsubadmin/{id}', [AdminController::class, 'editsubadmin'])->name('admin.editsubadmin');
      Route::get('/admin/viewsubadmin/{id}', [AdminController::class, 'viewsubadmin'])->name('admin.viewsubadmin');
      Route::post('/admin/updatesubadmin', [AdminController::class, 'updatesubadmin'])->name('subadmin.update');

      Route::get('/admin/pages', [AdminController::class, 'pages'])->name('admin.pages');
      Route::post('/pages/update/{id}', [AdminController::class, 'updatePage'])->name('pages.update');
      Route::post('/faq/add/', [AdminController::class, 'addfaq'])->name('faqadd');
      Route::post('/faq/update/{id}', [AdminController::class, 'updatefaq'])->name('faq.update');

      // master
      Route::get('/admin/masters', [AdminController::class, 'masters'])->name('admin.masters');
      Route::post('/createcategory', [AdminController::class, 'createcategory'])->name('category.store');
      Route::put('/categories/update', [AdminController::class, 'update'])->name('updateCategory');
      Route::post('/createcountry', [AdminController::class, 'createcountry'])->name('Country.store');
      Route::put('/countries/update', [AdminController::class, 'countryupdate'])->name('updateCountry');
      Route::post('/createcity', [AdminController::class, 'createcity'])->name('city.store');
      Route::put('/cities/update', [AdminController::class, 'cityupdate'])->name('updateCity');

      Route::post('/createlanguage', [AdminController::class, 'createlanguage'])->name('language.store');
      Route::put('/languages/update', [AdminController::class, 'languageupdate'])->name('updateLanguage');


      Route::get('/admin/myscans', [AdminController::class, 'myscans'])->name('admin.myscans');
      Route::get('/admin/viewmyscans', [AdminController::class, 'viewmyscans'])->name('admin.viewmyscans');
      Route::get('/admin/viewdetailmyscans', [AdminController::class, 'viewdetailmyscans'])->name('admin.viewdetailmyscans');
      Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
      Route::get('/admin/systemsettings', [AdminController::class, 'systemsettings'])->name('admin.systemsettings');
      Route::post('/admin/systemsettings', [AdminController::class, 'systemsettingspost'])->name('admin.systemsettingspost');

      Route::any('/admin/logout', [AdminController::class, 'adminlogout'])
      ->name('admin.logout');
      
      
});




// user

Route::get('/', [LandingController::class, 'landingpage'])->name('landingpage');
Route::get('/signup', [LandingController::class, 'usersignup'])->name('user.signup');
Route::get('/user/forgotpassword', [LandingController::class, 'forgotpassword'])->name('user.forgotpassword');
Route::post('/user/forgotpassword', [LandingController::class, 'postforgotpassword'])->name('user.postforgotpassword');
Route::get('/resetpassword/{token}', [LandingController::class, 'resetpassword'])->name('resetpassword');
Route::post('/resetpassword/{token}', [LandingController::class, 'post_resetpassword'])->name('resetpassword.submit');



// Web Route for the form submission
Route::post('/userregister', [LandingController::class, 'userregister']);
Route::post('/companyregister', [LandingController::class, 'companyregister']);
Route::post('/user/login', [LandingController::class, 'userlogin']);
Route::get('/user/faq', [LandingController::class, 'userfaq'])->name('userfaq');


Route::get('/user/kycpolicy', [LandingController::class, 'kycpolicy'])->name('user.kycpolicy');
Route::get('/user/privacy', [LandingController::class, 'privacy'])->name('user.privacy');
Route::get('/user/termsandconditions', [LandingController::class, 'termsandconditions'])->name('user.termsandconditions');

Route::middleware(['usercompany'])->group(function () {

      Route::get('/userdashboard', [LandingController::class, 'userdashboard'])->name('userdashboard');
      Route::get('/user/mysubscription', [LandingController::class, 'mysubscription'])->name('mysubscription');
      Route::post('/user/basicsubscription', [LandingController::class, 'basicsubscription'])->name('basicsubscription');
      Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession']);
      Route::get('/user/purchaseitempaymentstripe/success', [PaymentController::class, 'purchaseitempaymentstripesuccess'])->name('user.purchaseitempaymentstripe.success');
      

      Route::get('/package/details/{id}', [LandingController::class, 'showpackage'])->name('package.details');


      Route::get('/user/myproduct', [LandingController::class, 'myproduct'])->name('myproduct');
      Route::get('/user/viewmyproduct', [LandingController::class, 'viewmyproduct'])->name('viewmyproduct');
      Route::get('/user/viewdetailproduct', [LandingController::class, 'viewdetailproduct'])->name('viewdetailproduct');
      Route::get('/user/changepassword', [LandingController::class, 'changepassword'])->name('changepassword');
      Route::post('/user/changepassword', [LandingController::class, 'postchangePassword'])->name('postchangepassword');
      Route::get('/user/editprofile', [LandingController::class, 'editprofile'])->name('editprofile');
      Route::post('/user/editprofile', [LandingController::class, 'posteditprofile'])->name('posteditprofile');
      Route::any('/user/logout', [LandingController::class, 'userlogout'])
      ->name('user.logout');
      

      
});
