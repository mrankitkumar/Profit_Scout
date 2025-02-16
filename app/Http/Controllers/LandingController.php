<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\AdminFaq;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Models\UserSubscriptionHistory;
use App\Models\SubscriptionPackage;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class LandingController extends Controller
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
    public function landingpage()
    {

        if (Auth::check() && (Auth::user()->type === 'user' || Auth::user()->type === 'company')) {
            return redirect()->route('userdashboard');
        }
        return view('welcome');
    }

    public function usersignup()
    {

        if (Auth::check() && (Auth::user()->type === 'user' || Auth::user()->type === 'company')) {
            return redirect()->route('userdashboard');
        }

        return view('user.signup');
    }

    public function forgotpassword()
    {

        if (Auth::check() && (Auth::user()->type === 'user' || Auth::user()->type === 'company')) {
            return redirect()->route('userdashboard');
        }
        return view('user.forgotpassword');
    }



    public function postforgotpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|exists:users,email',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'This email is not registered in our system.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $email = $validator->validated()['email'];


            $user = User::where('email', $email)->first();

            if ($user) {

                if ($user->type === 'user' || $user->type === 'company') {


                    $user->remember_token = Str::random(40);
                    $user->save();


                    Mail::to($user->email)->send(new ForgotPassword($user));


                    $response = [
                        'success' => true,
                        'code' => 200,
                        'message' => 'Reset link sent to your email successfully!',
                        'res' => ['email' => $user->email]
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Email not found or user type invalid.'
                    ];
                }
            } else {

                $response = [
                    'success' => false,
                    'message' => 'Email not found.'
                ];
            }


            return response()->json($response, 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the password reset link.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function resetpassword($token)
    {


        $user = User::where('remember_token', '=', $token)
            ->first();

        if (!empty($user)) {
            $data['user'] = $user;
            return view('user.resetpassword', ['token' => $token, 'user' => $user]);
        } else {
            return abort(404);
        }
    }

    public function post_resetpassword($token, Request $request)
    {

        $request->validate([
            'password' => 'required|min:6|max:20|same:confirm_password',
        ]);


        $user = User::where('remember_token', $token)->first();


        if ($user) {

            $user->password = Hash::make($request->password);
            $user->email_verified_at = now();
            $user->remember_token = Str::random(40);
            $user->save();


            $userDetail = UserDetail::find($user->userdetail_id);
            if ($userDetail) {
                $userDetail->password = Hash::make($request->password);
                $userDetail->save();
            }


            return response()->json([
                'success' => true,
                'message' => 'Your password has been successfully reset.',
            ], 200);
        }


        return abort(404);
    }


    public function userdashboard()
    {


        return view('user.dashboard');
    }
    public function userregister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'mobile_number' => 'nullable|digits:10',
            'password' => 'required|string|min:6|max:10|confirmed',
            'password_confirmation' => 'required|string|min:6|max:10',
            'terms' => 'accepted',
        ], [
            'firstname.required' => 'First Name is required.',
            'email.required' => 'Email Address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address is already in use.',

            'mobile_number.digits' => 'Mobile Number must be 10 digits.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.max' => 'Password must not exceed 10 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password_confirmation.required' => 'Password confirmation is required.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $userdetail = new UserDetail();
            $userdetail->first_name = $request->input('firstname');
            $userdetail->last_name = $request->input('lastname');
            $userdetail->email = $request->input('email');
            $userdetail->mobile_number = $request->input('mobile_number');
            $userdetail->password = Hash::make($request->input('password'));
            $userdetail->isActive = 1;
            $userdetail->save();

            $user = new User();
            $user->first_name = $request->input('firstname');
            $user->last_name = $request->input('lastname');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile_number');
            $user->password = Hash::make($request->input('password'));
            $user->isActive = 1;
            $user->userdetail_id = $userdetail->id;
            $user->type = 'user';
            $user->save();

            Auth::login($user);


            return response()->json([
                'success' => true,
                'message' => 'Registered successfully!',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
            ], 500);
        }
    }

    public function userlogin(Request $request)
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

            if ($user->type === "admin") {
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

    public function companyregister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'companyemail' => 'required|email:rfc,dns|unique:users,email',
            'companymobile_number' => 'nullable|digits:10',
            'companypassword' => 'required|string|min:6|max:10|same:companyconfirm_password',
            'companyconfirm_password' => 'required|string|min:6|max:10',
            'companyterms' => 'accepted',
            'website' => 'nullable|url',
        ], [
            'name.required' => 'Name is required.',
            'companyemail.required' => 'Email Address is required.',
            'companyemail.email' => 'Please provide a valid email address.',
            'companyemail.unique' => 'The email address is already in use.',
            'companymobile_number.digits' => 'Mobile Number must be 10 digits.',
            'companypassword.required' => 'Password is required.',
            'companypassword.min' => 'Password must be at least 6 characters.',
            'companypassword.max' => 'Password must not exceed 10 characters.',
            'companypassword.same' => 'Password and Confirm Password must match.',
            'companyconfirm_password.required' => 'Confirm Password is required.',
            'companyterms.accepted' => 'You must accept the terms and conditions.',
            'website.url' => 'Please provide a valid URL for the website.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $userdetail = new UserDetail();
            $userdetail->first_name = $request->input('name');
            $userdetail->email = $request->input('companyemail');
            $userdetail->mobile_number = $request->input('companymobile_number');
            $userdetail->password = Hash::make($request->input('companypassword'));
            $userdetail->website_link = $request->input('website');
            $userdetail->isActive = 1;
            $userdetail->save();

            $user = new User();
            $user->first_name = $request->input('name');
            $user->email = $request->input('companyemail');
            $user->mobile_number = $request->input('companymobile_number');
            $user->password = Hash::make($request->input('companypassword'));
            $user->website_link = $request->input('website');
            $user->isActive = 1;
            $user->userdetail_id = $userdetail->id;
            $user->type = 'company';
            $user->save();

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'Registered successfully!',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
            ], 500);
        }
    }


    public function userfaq()
    {

        $faq = AdminFaq::where('isActive', true)->get();
       
        return view('user.faqpage',compact('faq'));
    }
    public function editprofile()
    {

      
        $country = Country::where('isActive', true)->get();


        $city = City::where('isActive', true)->get();

        return view('user.editprofile',compact('country', 'city'));
    }
    public function showpackage($id)
    {

      
        $package = SubscriptionPackage::findOrFail($id);
        
        
        return view('user.detailsubscription', compact('package'));

        
    }




    public function posteditprofile(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile_number' => 'nullable|digits:10',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'first_name.required' => 'First Name is required.',
            'first_name.string' => 'First Name must be a string.',
            'last_name.string' => 'Last Name must be a string.',
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

            $user = Auth::user();


            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->gender = $request->input('gender');
            $user->email = $request->input('email');
            $user->mobile_number = $request->input('mobile_number');
            $user->address_line_1 = $request->input('address_line_1');
            $user->address_line_2 = $request->input('address_line_2');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->postal_code = $request->input('postal_code');



            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');

                $fileName = time() . '_' . $profilePhoto->getClientOriginalName();

                $filePath = public_path('profile_photos/' . $fileName);


                $profilePhoto->move(public_path('profile_photos'), $fileName);


                $user->profile_picture = 'profile_photos/' . $fileName;
            }

            $user->save();


            if ($user->userdetail_id) {
                $userDetail = UserDetail::find($user->userdetail_id);
                if ($userDetail) {
                    $userDetail->mobile_number = $request->input('mobile_number');
                    $userDetail->address_line_1 = $request->input('address_line_1');
                    $userDetail->address_line_2 = $request->input('address_line_2');
                    $user->gender = $request->input('gender');
                    $userDetail->city = $request->input('city');
                    $userDetail->country = $request->input('country');
                    $userDetail->postal_code = $request->input('postal_code');
                    $userDetail->profile_picture = $user->profile_picture;
                    $userDetail->save();
                }
            }

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


    public function changepassword()
    {

        // if (Auth::check() && (Auth::user()->type === 'user' || Auth::user()->type === 'company')) {
        //     return redirect()->route('userdashboard');
        // }

        return view('user.changepassword');
    }




    public function postChangePassword(Request $request)
    {

        // print_r($request->all());


        $validator = Validator::make($request->all(), [
            'current-password' => 'required|string|min:6|max:10',
            'new-password' => 'required|string|min:6|max:10|different:current-password|same:confirm-password',
            'confirm-password' => 'required|string|min:6|max:10',
        ], [
            'current-password.required' => 'Current Password is required.',
            'current-password.min' => 'Current Password must be at least 6 characters.',
            'current-password.max' => 'Current Password must not exceed 10 characters.',

            'new-password.required' => 'New Password is required.',
            'new-password.min' => 'New Password must be at least 6 characters.',
            'new-password.max' => 'New Password must not exceed 10 characters.',
            'new-password.different' => 'New Password must be different from the Current Password.',
            'new-password.confirmed' => 'New Password confirmation does not match.',

            'confirm-password.required' => 'New Password confirmation is required.',
            'confirm-password.min' => 'New Password confirmation must be at least 6 characters.',
            'confirm-password.max' => 'New Password confirmation must not exceed 10 characters.',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

            $user = Auth::user();


            if (!Hash::check($request->input('current-password'), $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current Password is incorrect.',
                ], 422);
            }


            DB::beginTransaction();


            $user->password = Hash::make($request->input('new-password'));
            $user->save();


            $userDetail = UserDetail::find($user->userdetail_id);
            if ($userDetail) {
                $userDetail->password = Hash::make($request->input('new-password'));
                $userDetail->save();
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully!',
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the password.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function mysubscription()
    {


        return view('user.mysubscription');
    }

    public function myproduct()
    {


        return view('user.myproductlist');
    }

    public function viewmyproduct()
    {


        return view('user.viewmyproduct');
    }

    public function viewdetailproduct()
    {


        return view('user.viewdetailproduct');
    }



    public function basicsubscription(Request $request)
    {
        //print_r(Auth::user()->id);

        try {
            // Manually validate the packageid
            $packageid = $request->input('packageid');
            $price = $request->input('price');

            if (empty($packageid)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Package ID and price are required.',
                ], 422);
            }

            // Check if the packageid exists and has an 'Active' status
            $subscription = UserSubscriptionHistory::where('customber_id', Auth::user()->id)
                ->where('subscription_status', 'Active')
                ->first();
           // print_r($subscription);
            if ($subscription) {
                return response()->json([
                    'success' => false,
                    'message' => 'This subscription already Found.',
                ], 422);
            }

            // Proceed to create the subscription history
            $userSubscriptionHistory = UserSubscriptionHistory::create([
                'subscription_id' => $request->packageid,
                'customber_id' => Auth::user()->id,
                'start_date' => now(),
                'end_date' => null,
                'payment_date' => now(),
                'ammount' => 0,
                'subscription_status' => 'Active',
                'payment_status' => 'Success',
            ]);
            // Successful response
            return response()->json([
                'success' => true,
                'message' => 'Subscription successfully created.',
                'data' => $userSubscriptionHistory,
            ], 200);
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the subscription.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function kycpolicy()
    {
        $kycPolicy = DB::table('adminpages')->where('id', 3)->first();
        return view('user.amlpolicy', ['content' => $kycPolicy->content]);
    }
    public function privacy()
    {
        $privacy = DB::table('adminpages')->where('id', 2)->first();
        return view('user.privacypolicy', ['content' => $privacy->content]);
    }
    public function termsandconditions()
    {
        $termsandconditions = DB::table('adminpages')->where('id', 1)->first();

        return view('user.termsandservice', ['content' => $termsandconditions->content]);
    }



    public function userlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landingpage')->with('message', 'Logged out successfully.');
    }
}
