<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Role;
use App\Models\City;
use App\Models\Language;
use App\Models\subadminpermission;
use App\Models\System_settings;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Adminpages;
use App\Models\AdminFaq;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $response = $next($request);
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
            return $response;
        });
    }

    public function adminlogin()
    {

        if (Auth::check() && (Auth::user()->type === 'admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.adminlogin');
    }

    public function adminloginpost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:6|max:10',
        ], [
            'email.required' => 'Email Address is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.max' => 'Password must not exceed 10 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {


            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password.',
                ], 401);
            }
            if (!$user->isActive) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your Account is in active',
                ], 401);
            }

            if ($user->type !== "admin") {
                return response()->json([
                    'success' => false,
                    'message' => "Your account doesn't have access.",
                ], 403);
            }

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during login.',
            ], 500);
        }
    }

    public function admindashboard()
    {
        return view('admin.dashboard');
    }

    public function editadminprofile()
    {


        return view('admin.editadminprofile');
    }




    public function editAdminProfilePost(Request $request)
    {
        // Debugging: Uncomment during development to see the input data
        //print_r($request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'nullable|numeric|digits_between:10,15',
        ]);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Assuming that you want to update the authenticated user's profile
            $user = Auth::user();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile_number');
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function adminchangepasswordpost(Request $request)
    {
        // Debugging: Uncomment during development to see the input data
        // print_r($request->all());

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|max:10|same:confirm-password',
            'confirm-password' => 'required|string|min:6|max:10',
        ], [
            'current-password.required' => 'Current Password is required.',
            'new-password.required' => 'New Password is required.',
            'new-password.min' => 'New Password must be at least 8 characters long.',
            'new-password.confirm-password' => 'New Password and Confirm New Password do not match.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->input('current-password'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.',
            ], 422);
        }

        // Update with new password
        $user->password = Hash::make($request->input('new-password'));
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!',
        ], 200);
    }

    public function adminchangepassword()
    {
        return view('admin.changeadminpass');
    }

    public function managecustomber()
    {
        return view('admin.managecustomer');
    }
    public function addcustomber()
    {
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();

        return view('admin.managecustomber.addcustomber', compact('country', 'city'));
    }

    public function postAddCustomer(Request $request)
    {
        // Debugging: Uncomment during development to see the input data
        //print_r($request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'nullable|digits:10',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'first_name.required' => 'First Name is required.',
            'first_name.string' => 'First Name must be a string.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'profile_photo.image' => 'Profile photo must be an image file.',
            'profile_photo.mimes' => 'Profile photo must be of type jpeg, png, jpg, or gif.',
            'profile_photo.max' => 'Profile photo must not exceed 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Handle profile photo upload
            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $fileName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->move(public_path('profile_photos'), $fileName);
                $profilePhotoPath = 'profile_photos/' . $fileName;
            }

            // Create a new UserDetail record
            $userDetail = new UserDetail();
            $userDetail->first_name = $request->input('first_name');
            $userDetail->last_name = $request->input('last_name');
            $userDetail->email = $request->input('email');
            $userDetail->mobile_number = $request->input('mobile_number');
            $userDetail->address_line_1 = $request->input('address_line_1');
            $userDetail->address_line_2 = $request->input('address_line_2');
            $userDetail->city = $request->input('city');
            $userDetail->country = $request->input('country');
            $userDetail->postal_code = $request->input('postal_code');
            $userDetail->website_link = $request->input('website');
            $userDetail->gender = $request->input('gender');
            $userDetail->profile_picture = $profilePhotoPath;
            $userDetail->isActive = 1; // Default value for new user
            $userDetail->save();

            // Create a new User record linked to the UserDetail record
            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile_number');
            $user->address_line_1 = $request->input('address_line_1');
            $user->address_line_2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->postal_code = $request->input('postal_code');
            $user->website_link = $request->input('website');
            $user->profile_picture = $profilePhotoPath;
            $user->gender = $request->input('gender');
            $user->isActive = 1; // Default value for new user
            $user->userdetail_id = $userDetail->id;
            $user->type = 'user'; // Default type
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Customer added successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the customer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function postaddcompany(Request $request)
    {
        // Debugging the request data
        // print_r($request->all());

        // Validation rules
        $validator = Validator::make($request->all(), [
            'companyname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile' => 'nullable|digits:10',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255|',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url|max:255',

        ], [
            'companyname.required' => 'Company Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'profile_photo.image' => 'Profile photo must be an image file.',
            'profile_photo.mimes' => 'Profile photo must be of type jpeg, png, jpg, or gif.',
            'profile_photo.max' => 'Profile photo must not exceed 2MB.',
            'companypassword.required' => 'Password is required.',
            'companypassword.min' => 'Password must be at least 6 characters long.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Handle profile photo upload
            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $fileName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->move(public_path('profile_photos'), $fileName);
                $profilePhotoPath = 'profile_photos/' . $fileName;
            }

            // Create a new UserDetail record
            $userdetail = new UserDetail();
            $userdetail->first_name = $request->input('companyname');
            $userdetail->email = $request->input('email');
            $userdetail->mobile_number = $request->input('mobile');
            $userdetail->password = Hash::make($request->input('companypassword'));
            $userdetail->website_link = $request->input('website');
            $userdetail->profile_picture = $profilePhotoPath;
            $userdetail->address_line_1 = $request->input('address_line1');
            $userdetail->address_line_2 = $request->input('address_line2');
            $userdetail->postal_code = $request->input('postal_code');
            $userdetail->isActive = 1;
            $userdetail->country = $request->input('country');
            $userdetail->city = $request->input('city');
            $userdetail->save();

            // Create a new User record linked to the UserDetail record
            $user = new User();
            $user->first_name = $request->input('companyname');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile');
            $user->password = Hash::make($request->input('companypassword'));

            $user->website_link = $request->input('website');
            $user->address_line_1 = $request->input('address_line1');
            $user->address_line_2 = $request->input('address_line2');
            $user->postal_code = $request->input('postal_code');
            $user->profile_picture = $profilePhotoPath;
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->isActive = 1;
            $user->userdetail_id = $userdetail->id;
            $user->type = 'company';
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Company added successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the company.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function editcustomber($id)
    {

        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();


        $customber = User::findOrFail($id);


        return view('admin.managecustomber.editcustomber', compact('customber', 'country', 'city'));
    }
    public function editcompanypost(Request $request)
    {
        // Validation rules
        //print_r($request->all());
        $validator = Validator::make($request->all(), [
            'companyid' => 'required|',
            'companyname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->input('companyid'),
            'mobilenumber' => 'nullable|digits:10',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url|max:255',
        ], [
            'companyname.required' => 'Company Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'profile_picture.image' => 'Profile photo must be an image file.',
            'profile_picture.mimes' => 'Profile photo must be of type jpeg, png, jpg, or gif.',
            'profile_picture.max' => 'Profile photo must not exceed 2MB.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the existing User and UserDetail records
            $user = User::findOrFail($request->input('companyid'));
            // print_r($user);
            $userDetail = UserDetail::findOrFail($user->userdetail_id);

            // print_r($request->all());

            $profilePhotoPath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePhoto = $request->file('profile_picture');
                $fileName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->move(public_path('profile_photos'), $fileName);
                $profilePhotoPath = 'profile_photos/' . $fileName;
            }


            // Update UserDetail record
            $userDetail->first_name = $request->input('companyname');
            $userDetail->email = $request->input('email');
            $userDetail->mobile_number = $request->input('mobilenumber');
            $userDetail->website_link = $request->input('website');
            if (!is_null($profilePhotoPath)) {
                $userDetail->profile_picture = $profilePhotoPath;
            }

            $userDetail->address_line_1 = $request->input('address_line_1');
            $userDetail->address_line_2 = $request->input('address_line_1');
            $userDetail->postal_code = $request->input('postal_code');
            $userDetail->country = $request->input('country');
            $userDetail->city = $request->input('city');
            $userDetail->save();
            // print_r($userDetail);
            // Update User record
            $user->first_name = $request->input('companyname');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobilenumber');
            $user->website_link = $request->input('website');
            $user->address_line_1 = $request->input('address_line_1');
            $user->address_line_2 = $request->input('address_line_1');
            $user->postal_code = $request->input('postal_code');
            if (!is_null($profilePhotoPath)) {
                $user->profile_picture = $profilePhotoPath;
            }

            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Company updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the company.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function editcustomberpost(Request $request)
    {
        // print_r($request->all());
        // Validation rules
        $validator = Validator::make($request->all(), [
            'customberid' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->input('customberid'),
            'mobile_number' => 'nullable|digits:10',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'customberid.required' => 'Customer ID is required.',
            'customberid.exists' => 'Customer does not exist.',
            'first_name.required' => 'First Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'profile_picture.image' => 'Profile picture must be an image file.',
            'profile_picture.mimes' => 'Profile picture must be of type jpeg, png, jpg, or gif.',
            'profile_picture.max' => 'Profile picture must not exceed 2MB.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Find the customer
            $user = User::findOrFail($request->input('customberid'));
            $userDetail = UserDetail::findOrFail($user->userdetail_id);
            // Handle profile picture upload
            $profilePhotoPath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePhoto = $request->file('profile_picture');
                $fileName = time() . '_' . $profilePhoto->getClientOriginalName();
                $profilePhoto->move(public_path('profile_photos'), $fileName);
                $profilePhotoPath = 'profile_photos/' . $fileName;
            }

            $userDetail->first_name = $request->input('first_name');
            $userDetail->last_name = $request->input('last_name');
            $userDetail->email = $request->input('email');
            $userDetail->mobile_number = $request->input('mobilenumber');
            $userDetail->website_link = $request->input('website');
            if (!is_null($profilePhotoPath)) {
                $userDetail->profile_picture = $profilePhotoPath;
            }
            $userDetail->address_line_1 = $request->input('address_line_1');
            $userDetail->address_line_2 = $request->input('address_line_1');
            $userDetail->postal_code = $request->input('postal_code');
            $userDetail->country = $request->input('country');
            $userDetail->city = $request->input('city');
            $userDetail->gender = $request->input('gender');
            $userDetail->save();

            // Update customer details
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile_number');
            $user->address_line_1 = $request->input('address_line_1');
            $user->address_line_2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->postal_code = $request->input('postal_code');
            $user->gender = $request->input('gender');
            if (!is_null($profilePhotoPath)) {
                $user->profile_picture = $profilePhotoPath;
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Customer updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the customer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function deleteCustomer($id)
    {

        try {
            // Find the user and associated details
            $user = User::findOrFail($id);
            $userDetail = UserDetail::findOrFail($user->userdetail_id);

            // Delete associated user details
            $userDetail->delete();

            // Delete the user
            $user->delete();

            return response()->json([
                'success' => true,
                'Message' => 'Customer deleted successfully!',
                'customerId' => $id,
            ], 200);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'success' => false,
                'Message' => 'Failed to delete customer. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function deleteCompany($id)
    {
        //print_r($id);

        try {
            // Find the user and associated details
            $user = User::findOrFail($id);
            $userDetail = UserDetail::findOrFail($user->userdetail_id);

            // Delete associated user details
            $userDetail->delete();

            // Delete the user
            $user->delete();

            return response()->json([
                'success' => true,
                'Message' => 'Company deleted successfully!',
                'customerId' => $id,
            ], 200);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'success' => false,
                'Message' => 'Failed to delete customer. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function viewcustomber($id)
    {
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();


        $customber = User::findOrFail($id);

        return view('admin.managecustomber.viewcustomber', compact('customber', 'country', 'city'));
    }

    public function addcompany()
    {
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();

        return view('admin.managecustomber.addcompany', compact('country', 'city'));
    }
    public function editcompany($id)
    {
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();



        $company = User::findOrFail($id);
        return view('admin.managecustomber.editcompany', compact('company', 'country', 'city'));
    }
    public function viewcompany($id)
    {
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();


        $company = User::findOrFail($id);
        return view('admin.managecustomber.viewcompany', compact('company', 'country', 'city'));
    }

    public function managesubscriptions()
    {
        return view('admin.managesubscriptions');
    }
    public function addpackage()
    {
        return view('admin.managecustomber.addpackage');
    }
    public function addpackagepost(Request $request)
    {
        //print_r($request->all());
        // Validation for package data
        $validator = Validator::make($request->all(), [
            'subscription_name'  => 'required|string|max:255',
            'subscription_type'  => 'required|in:Annual,Monthly,Days', // ensures it's one of the allowed types
            'price'              => 'nullable|numeric|min:0',
            'interval_period'    => 'nullable|integer|min:1', // interval period must be at least 1
            'feature'            => 'required|string',
            'description'        => 'required|string',
        ], [
            'subscription_name.required' => 'Subscription Name is required.',
            'subscription_name.string' => 'Subscription Name must be a string.',
            'subscription_type.required' => 'Subscription Type is required.',
            'subscription_type.in' => 'Subscription Type must be one of: Annual, Monthly, or Days.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
            'interval_period.required' => 'Interval Period is required.',
            'interval_period.integer' => 'Interval Period must be an integer.',
            'interval_period.min' => 'Interval Period must be at least 1.',
            'feature.string' => 'Feature must be a string.',
            'description.string' => 'Description must be a string.',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create the new package in the database
        try {
            $package = new SubscriptionPackage(); // Assuming you have a Package model
            $package->subscription_name = $request->input('subscription_name');
            $package->subscription_type = $request->input('subscription_type');
            $package->price = $request->input('price');
            $package->interval_period = $request->input('interval_period');
            $package->feature = $request->input('feature');
            $package->description = $request->input('description');
            $package->isActive = true;

            $package->save(); // Save to the database

            return response()->json([
                'success' => true,
                'message' => 'Package added successfully!',
            ], 200);
        } catch (\Exception $e) {
            // Log the error message to get more details
            \Log::error('Error adding package: ' . $e->getMessage());

            // If there is any error during the save process
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the package. Please try again.',
                'error' => $e->getMessage(), // Include error details in the response for debugging
            ], 500);
        }
    }


    public function editpackage($id)
    {
        $subscription = SubscriptionPackage::findOrFail($id);

        return view('admin.managecustomber.editpackage', compact('subscription'));
    }

    public function editpackagepost(Request $request)
    {
        // print_r($request->all());
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'subscription_name'  => 'required|string|max:255',
            'subscription_type'  => 'required|in:Annual,Monthly,Days',
            'price'              => 'nullable|numeric|min:0',
            'interval_period'    => 'nullable|integer|min:1',
            'features'           => 'required|string',
            'description'        => 'required|string',
        ], [
            'subscription_name.required' => 'Subscription Name is required.',
            'subscription_type.required' => 'Subscription Type is required.',
            'subscription_type.in' => 'Subscription Type must be Annual, Monthly, or Days.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'interval_period.required' => 'Interval Period is required.',
            'interval_period.integer' => 'Interval Period must be an integer.',
            'features.required' => 'Features field is required.',
            'description.required' => 'Description is required.',
        ]);

        // If validation fails, return errors as JSON response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Check if an ID is present for updating the package

            $package = SubscriptionPackage::findOrFail($request->input('subscriptionid'));


            // Assign validated request data
            $package->subscription_name = $request->input('subscription_name');
            $package->subscription_type = $request->input('subscription_type');
            $package->price = $request->input('price');
            $package->interval_period = $request->input('interval_period');
            $package->feature = $request->input('features');
            $package->description = $request->input('description');
            $package->isActive = true;

            // Save package details to the database
            $package->save();

            return response()->json([
                'success' => true,
                'message' => 'Package updated successfully!',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the package. Please try again.',
            ], 500);
        }
    }

    public function managepayment()
    {
        return view('admin.managepayments');
    }
    public function viewcompanypayment()
    {
        return view('admin.managecustomber.viewcompanypayment');
    }
    public function viewcustomberpayment()
    {
        return view('admin.managecustomber.viewcustomberpayment');
    }
    public function manageroleandpermissions()
    {
        return view('admin.manageroleandpermissions');
    }

    public function createrole(Request $request)
    {

        // print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'role' => 'required|string|max:255|unique:roles,rolesname',
            ], [
                'role.required' => 'role name is required.',
                'role.string' => 'role name must be a string.',
                'role.max' => 'role name cannot exceed 255 characters.',
                'role.unique' => 'This role name already exists.',
            ]);


            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $role = new Role();
            $role->rolesname = $validatedData['role'];
            $role->isActive = $isActive;


            $role->save();


            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'role created successfully!', 'res' => $role->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'Category with this name already exists.';
            } else {
                $response['Message'] = 'Failed to create category: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to create category: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }
    public function addSubAdmin()
    {
        $roles = Role::where('isActive', true)->get();
        return view('admin.managecustomber.addsubadmin', compact('roles'));
    }
    public function addsubadminpost(Request $request)
    {

        //print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'subadminname' => 'required',
                'rolename' => 'required',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'mobileno' => 'nullable|digits:10',

            ],);


            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $user = new User();
            $user->first_name = $validatedData['subadminname'];
            $user->subadminrole_id = $validatedData['rolename'];
            $user->email = $validatedData['email'];
            $user->isActive = $isActive;
            $user->userdetail_id = 0;
            $user->mobile_number = $validatedData['mobileno'];
            $user->save();



            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managecustomber";
            $subadmin->isAdd = $request->manageCustomerAdd == 'on' ? true : false;
            $subadmin->isView = $request->manageCustomerView == 'on' ? true : false;
            $subadmin->isEdit = $request->manageCustomerEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->manageCustomerDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managesubscription";
            $subadmin->isAdd = $request->manageSubscriptionAdd == 'on' ? true : false;
            $subadmin->isView = $request->manageSubscriptionView == 'on' ? true : false;
            $subadmin->isEdit = $request->manageSubscriptionEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->manageSubscriptionDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managepayment";
            $subadmin->isAdd = $request->managePaymentAdd == 'on' ? true : false;
            $subadmin->isView = $request->managePaymentView == 'on' ? true : false;
            $subadmin->isEdit = $request->managePaymentEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->managePaymentDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "roles";
            $subadmin->isAdd = $request->rolesAdd == 'on' ? true : false;
            $subadmin->isView = $request->rolesView == 'on' ? true : false;
            $subadmin->isEdit = $request->rolesEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->rolesDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "pages";
            $subadmin->isAdd = $request->pagesAdd == 'on' ? true : false;
            $subadmin->isView = $request->pagesView == 'on' ? true : false;
            $subadmin->isEdit = $request->pagesEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->pagesDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "masters";
            $subadmin->isAdd = $request->mastersAdd == 'on' ? true : false;
            $subadmin->isView = $request->mastersView == 'on' ? true : false;
            $subadmin->isEdit = $request->mastersEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->mastersDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "reports";
            $subadmin->isAdd = $request->reportsAdd == 'on' ? true : false;
            $subadmin->isView = $request->reportsView == 'on' ? true : false;
            $subadmin->isEdit = $request->reportsEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->reportsDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "scans";
            $subadmin->isAdd = $request->scansAdd == 'on' ? true : false;
            $subadmin->isView = $request->scansView == 'on' ? true : false;
            $subadmin->isEdit = $request->scansEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->scansDelete == 'on' ? true : false;
            $subadmin->save();


            $subadmin = new subadminpermission();
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "systemsetting";
            $subadmin->isAdd = $request->settingsAdd == 'on' ? true : false;
            $subadmin->isView = $request->settingsView == 'on' ? true : false;
            $subadmin->isEdit = $request->settingsEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->settingsDelete == 'on' ? true : false;
            $subadmin->save();






            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'role created successfully!', 'res' => $user->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'Category with this name already exists.';
            } else {
                $response['Message'] = 'Failed to create category: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to create category: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }
    public function updatesubadmin(Request $request)
    {

        //print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'subadminname' => 'required',
                'rolename' => 'required',
                'email' => 'required|email:rfc,dns|unique:users,email,' . $request->input('user_id'),
                'mobileno' => 'nullable|digits:10',
            ]);



            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $user = User::findOrFail($request->input('user_id'));
            $user->first_name = $validatedData['subadminname'];
            $user->subadminrole_id = $validatedData['rolename'];
            $user->email = $validatedData['email'];
            $user->isActive = $isActive;
            $user->userdetail_id = 0;
            $user->mobile_number = $validatedData['mobileno'];
            $user->save();



            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'managecustomber'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managecustomber";
            $subadmin->isAdd = $request->manageCustomerAdd == 'on' ? true : false;
            $subadmin->isView = $request->manageCustomerView == 'on' ? true : false;
            $subadmin->isEdit = $request->manageCustomerEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->manageCustomerDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'managesubscription'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managesubscription";
            $subadmin->isAdd = $request->manageSubscriptionAdd == 'on' ? true : false;
            $subadmin->isView = $request->manageSubscriptionView == 'on' ? true : false;
            $subadmin->isEdit = $request->manageSubscriptionEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->manageSubscriptionDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'managepayment'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "managepayment";
            $subadmin->isAdd = $request->managePaymentAdd == 'on' ? true : false;
            $subadmin->isView = $request->managePaymentView == 'on' ? true : false;
            $subadmin->isEdit = $request->managePaymentEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->managePaymentDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'roles'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "roles";
            $subadmin->isAdd = $request->rolesAdd == 'on' ? true : false;
            $subadmin->isView = $request->rolesView == 'on' ? true : false;
            $subadmin->isEdit = $request->rolesEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->rolesDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'pages'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "pages";
            $subadmin->isAdd = $request->pagesAdd == 'on' ? true : false;
            $subadmin->isView = $request->pagesView == 'on' ? true : false;
            $subadmin->isEdit = $request->pagesEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->pagesDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'masters'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "masters";
            $subadmin->isAdd = $request->mastersAdd == 'on' ? true : false;
            $subadmin->isView = $request->mastersView == 'on' ? true : false;
            $subadmin->isEdit = $request->mastersEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->mastersDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'reports'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "reports";
            $subadmin->isAdd = $request->reportsAdd == 'on' ? true : false;
            $subadmin->isView = $request->reportsView == 'on' ? true : false;
            $subadmin->isEdit = $request->reportsEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->reportsDelete == 'on' ? true : false;
            $subadmin->save();

            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'scans'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "scans";
            $subadmin->isAdd = $request->scansAdd == 'on' ? true : false;
            $subadmin->isView = $request->scansView == 'on' ? true : false;
            $subadmin->isEdit = $request->scansEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->scansDelete == 'on' ? true : false;
            $subadmin->save();


            $subadmin = new subadminpermission([
                'adminid' => $request->input('user_id'),
                'permissionsname' => 'systemsetting'
            ]);
            $subadmin->adminid = $user->id;
            $subadmin->permissionsname = "systemsetting";
            $subadmin->isAdd = $request->settingsAdd == 'on' ? true : false;
            $subadmin->isView = $request->settingsView == 'on' ? true : false;
            $subadmin->isEdit = $request->settingsEdit == 'on' ? true : false;
            $subadmin->isDelete = $request->settingsDelete == 'on' ? true : false;
            $subadmin->save();






            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'Admin Updated successfully!', 'res' => $user->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'Error in Admin Updated ';
            } else {
                $response['Message'] = 'Failed to Admin Updated: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to Admin Updated: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }

    public function editsubadmin($id)
    {
        $roles = Role::where('isActive', true)->get();
        $user = User::findOrFail($id);
        $roles = Role::where('isActive', true)->get();
        $permissions = subadminpermission::where('adminid', $user->id)->get();
        return view('admin.managecustomber.editsubadmin', compact('user', 'permissions', 'roles'));
    }

    public function viewsubadmin($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('isActive', true)->get();
        $permissions = subadminpermission::where('adminid', $user->id)->get();
        // dd($permissions);
        return view('admin.managecustomber.viewsubadmin', compact('user', 'permissions', 'roles'));
    }

    public function pages()
    {
        return view('admin.pages');
    }
    public function updatePage(Request $request, $id)
    {
        //print_r($request->all());
        $response = [
            'Success' => false,
            'Code' => 400,
            'Message' => 'Something went wrong!',
            'res' => ''
        ];

        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'Success' => false,
                    'Code' => 422,
                    'Message' => 'Validation failed!',
                    'Errors' => $validator->errors()->toArray(),
                ], 422);
            }


            $title = $request->input('title');
            $content = $request->input('content');
            $status = $request->input('isActive');
            $status = $status == 'true' || $status === true || $status == 1 ? 1 : 0;

            $page = Adminpages::findOrFail($id);


            $page->title = $title;
            $page->content = $content;
            $page->isActive = $status;
            $page->save();


            $response = [
                'Success' => true,
                'Code' => 200,
                'Message' => 'Page updated successfully.',
                'res' => [
                    'id' => $page->id,
                    'title' => $page->title,
                    'content' => $page->content,
                ]
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Page Update Error: ' . $e->getMessage());

            $response['Message'] = 'Page update failed: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }

    public function addfaq(Request $request)
    {
        //print_r($request->all());

        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255|unique:admin_faqs,question', // Changed from exists to unique
            'content' => 'required|string|max:255',
            'isActive' => 'required|in:true,false,1,0', // Accept multiple formats for boolean
        ]);

        // Convert isActive to a proper boolean
        $isActive = filter_var($request->isActive, FILTER_VALIDATE_BOOLEAN);

        // Create a new FAQ entry
        $addfaq = new AdminFaq();
        $addfaq->question = $request->title;
        $addfaq->answer = $request->content;
        $addfaq->isActive = $isActive;
        $addfaq->save();

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'FAQ added successfully!',
        ]);
    }

    public function updatefaq(Request $request, $id)
    {
        // print_r($request->all());
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255|unique:admin_faqs,question,' . $id,
            'content' => 'required|string',
            'isActive' => 'required|in:true,false,1,0',
        ]);
        $isActive = filter_var($request->isActive, FILTER_VALIDATE_BOOLEAN);
        // Find the FAQ by ID
        $faq = AdminFaq::find($id);

        if (!$faq) {
            return response()->json(['success' => false, 'message' => 'FAQ not found'], 404);
        }

        // Update FAQ details
        $faq->question = $request->title;
        $faq->answer = $request->content;


        $faq->isActive = $isActive;
        $faq->save();

        return response()->json(['success' => true, 'message' => 'FAQ updated successfully']);
    }

    public function masters()
    {
        return view('admin.masters');
    }

    public function update(Request $request)
    {
        //print_r($request->all());
        // Validate incoming request
        $request->validate([
            'cat_id' => 'required|exists:categories,id',
            'category' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Fetch the category by ID
        $category = Category::findOrFail($request->cat_id);

        // Update the category details
        $category->name = $request->category;
        $category->isActive = $request->status;
        $category->save();

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
        ]);
    }
    public function updaterole(Request $request)
    {

        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'editrolename' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $role = Role::findOrFail($request->role_id);


        $role->rolesname = $request->editrolename;
        $role->isActive = $request->status;
        $role->save();

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully!',
        ]);
    }



    public function countryupdate(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'country' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        // Find the country by ID and update it
        $country = Country::findOrFail($validated['country_id']);
        $country->countryname = $validated['country'];
        $country->isActive = $validated['status'];
        $country->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Country updated successfully!',
        ]);
    }

    public function languageupdate(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'language_id' => 'required|exists:languages,id',
            'language' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        $language = Language::findOrFail($validated['language_id']);
        $language->languagename = $validated['language'];
        $language->isActive = $validated['status'];
        $language->save();

        return response()->json([
            'success' => true,
            'message' => 'Language updated successfully!',
        ]);
    }

    public function cityupdate(Request $request)
    {
        // print_r($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'city' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status' => 'required|boolean',
        ]);

        // Find the city and update it
        $city = City::findOrFail($validated['city_id']);
        $city->cityname = $validated['city'];
        $city->countryid = $validated['country_id'];
        $city->isActive = $validated['status'];
        $city->save();

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'City updated successfully!',
        ]);
    }

    public function createcategory(Request $request)
    {

        // print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'category' => 'required|string|max:255|unique:categories,name',
            ], [
                'category.required' => 'Category name is required.',
                'category.string' => 'Category name must be a string.',
                'category.max' => 'Category name cannot exceed 255 characters.',
                'category.unique' => 'This category name already exists.',
            ]);


            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $category = new Category();
            $category->name = $validatedData['category'];
            $category->isActive = $isActive;


            $category->save();


            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'Category created successfully!', 'res' => $category->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'Category with this name already exists.';
            } else {
                $response['Message'] = 'Failed to create category: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to create category: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }


    public function createcountry(Request $request)
    {

        // print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'country' => 'required|string|max:255|unique:countries,countryname',
            ], [
                'country.required' => 'country name is required.',
                'country.string' => 'country name must be a string.',
                'country.max' => 'country name cannot exceed 255 characters.',
                'country.unique' => 'This country name already exists.',
            ]);


            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $Country = new Country();
            $Country->countryname = $validatedData['country'];
            $Country->isActive = $isActive;


            $Country->save();


            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'Country created successfully!', 'res' => $Country->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'Country with this name already exists.';
            } else {
                $response['Message'] = 'Failed to create Country: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to create Country: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }



    public function createlanguage(Request $request)
    {

        // print_r($request->all());
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {

            $validatedData = $request->validate([
                'addlanguage' => 'required|string|max:255|unique:languages,languagename',
            ], [
                'addlanguage.required' => 'language name is required.',
                'addlanguage.string' => 'language name must be a string.',
                'addlanguage.max' => 'language name cannot exceed 255 characters.',
                'addlanguage.unique' => 'This language name already exists.',
            ]);


            $isActive = $request->isActive == 'on' ? true : false;


            DB::beginTransaction();


            $language = new Language();
            $language->languagename = $validatedData['addlanguage'];
            $language->isActive = $isActive;


            $language->save();


            DB::commit();


            $response = ['Success' => true, 'Code' => 200, 'Message' => 'language created successfully!', 'res' => $language->id];
        } catch (\Illuminate\Validation\ValidationException $e) {

            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {

            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'language with this name already exists.';
            } else {
                $response['Message'] = 'Failed to create Country: ' . $e->getMessage();
            }
        } catch (Exception $e) {

            DB::rollback();
            $response['Message'] = 'Failed to create Country: ' . $e->getMessage();
        }

        return response()->json($response, $response['Code']);
    }


    public function createcity(Request $request)
    {
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong!', 'res' => ''];

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'country' => 'required|exists:countries,id', // Ensure country exists in countries table
                'city' => 'required|string|max:255|unique:cities,cityname,NULL,id,countryid,' . $request->country, // Unique city per country
            ], [
                'country.required' => 'Country is required.',
                'country.exists' => 'The selected country does not exist.',
                'city.required' => 'City name is required.',
                'city.string' => 'City name must be a string.',
                'city.max' => 'City name cannot exceed 255 characters.',
                'city.unique' => 'This city already exists in the selected country.',
            ]);

            // Set isActive value
            $isActive = $request->isActive == 'on' ? true : false;

            DB::beginTransaction();

            // Create a new City entry
            $city = new City();
            $city->countryid = $validatedData['country'];
            $city->cityname = $validatedData['city']; // Use the 'city' field value from the request
            $city->isActive = $isActive;

            // Save the city to the database
            $city->save();

            DB::commit();

            // Prepare success response
            $response = ['Success' => true, 'Code' => 200, 'Message' => 'City created successfully!', 'res' => $city->id];
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Catch validation errors
            $errors = $e->validator->errors()->toArray();
            $fieldErrors = [];

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $fieldErrors[] = [
                        'field' => $field,
                        'message' => $message,
                    ];
                }
            }

            $response['Message'] = $fieldErrors[0]['message'];
            $response['Code'] = 403;
            $response['Errors'] = $fieldErrors;
        } catch (QueryException $e) {
            // Handle query exception (e.g., foreign key violation)
            DB::rollback();
            if ($e->getCode() == 23000) {
                $response['Message'] = 'City with this name already exists in the selected country.';
            } else {
                $response['Message'] = 'Failed to create City: ' . $e->getMessage();
            }
        } catch (Exception $e) {
            // Handle general exceptions
            DB::rollback();
            $response['Message'] = 'Failed to create City: ' . $e->getMessage();
        }

        // Return the response
        return response()->json($response, $response['Code']);
    }

    public function myscans()
    {
        return view('admin.myscans');
    }
    public function viewmyscans()
    {
        return view('admin.viewmyscans');
    }
    public function viewdetailmyscans()
    {
        return view('admin.viewdetailscan');
    }

    public function reports()
    {
        return view('admin.reports');
    }
    public function systemsettings()
    {
        $setting = System_settings::first();

        return view('admin.systemsettings', compact('setting'));
    }


    public function systemsettingspost(Request $request)
    {
        //print_r($request->all());
        // Validate the inputs for logo and favicon
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ], [
            'logo.image' => 'The logo must be an image file.',
            'favicon.image' => 'The favicon must be an image file.',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }


        $paths = [];


        try {
            // Handle logo file upload if provided
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $fileName = time() . '_' . $logo->getClientOriginalName();

                $logo->move(public_path('profile_photos'), $fileName);
                $logoPath = 'profile_photos/' . $fileName;
                $paths['logo'] = $logoPath;
            }

            // Handle favicon file upload if provided
            if ($request->hasFile('favicon')) {
                $favicon = $request->file('favicon');
                $fileName = time() . '_' . $favicon->getClientOriginalName();

                $favicon->move(public_path('favicons'), $fileName);
                $faviconPath = 'favicons/' . $fileName;
                $paths['favicon'] = $faviconPath;
            }

            // Get the existing system settings (if any)
            $setting = System_settings::first();

            if ($setting) {

                $setting->logo = $paths['logo'] ?? $setting->logo;
                $setting->favicon = $paths['favicon'] ?? $setting->favicon;
                $setting->save();
            } else {

                System_settings::create([
                    'logo' => $paths['logo'] ?? null,
                    'favicon' => $paths['favicon'] ?? null,
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'System settings updated successfully!',
                'data' => $paths,
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function adminlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('adminlogin')->with('message', 'Logged out successfully.');
    }
}
