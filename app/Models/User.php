<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'last_name',
        'mobile_number',
        'address_line_1',
        'address_line_2',
        'city',
        'country',
        'postal_code',
        'profile_picture',
        'website_link'




    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Method to get customers with pagination and filtering.
     *
     * @param int $page
     * @param int $perPage
     * @param string $keyword
     * @return array
     */
    public static function getCustomers($page, $perPage, $keyword)
    {
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong !', 'resdata' => ''];

        try {
            $offset = ($page - 1) * $perPage;

            // Fetch customers with their active subscription history using eager loading
            $customers = self::where('type', 'user')
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->skip($offset)
                ->take($perPage)
                ->orderBy('updated_at', 'desc')
                ->get();

            // Fetch subscription history for each customer (only active subscriptions)
            foreach ($customers as $customer) {
                $customer->subscriptionHistory = UserSubscriptionHistory::where('customber_id', $customer->id)
                    ->where('subscription_status', 'Active')
                    ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
                    ->when($keyword, function ($query) use ($keyword) {
                        $query->where('subscription_packages.subscription_name', 'like', '%' . $keyword . '%')
                            ->orWhere('user_subscription_histories.payment_method', 'like', '%' . $keyword . '%');
                    })
                    ->select('user_subscription_histories.*', 'subscription_packages.*', 'user_subscription_histories.subscription_id')
                    ->orderBy('user_subscription_histories.updated_at', 'desc')
                    ->first(); // Get the most recent active subscription history for each customer
            }

            // Count total customers
            $count = self::where('type', 'user')
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->count();

            $pagecount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = ['customers' => $customers, 'count' => $count, 'pagecount' => $pagecount];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }

    /**
     * Method to get companies with pagination and filtering.
     *
     * @param int $page
     * @param int $perPage
     * @param string $keyword
     * @return array
     */
    public static function getCompany($page, $perPage, $keyword)
    {
        //dd();
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong !', 'resdata' => ''];

        try {
            $offset = ($page - 1) * $perPage;
            $companies = self::where('type', 'company')  // Assuming 'type' is a column indicating company
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->skip($offset)
                ->take($perPage)
                ->orderBy('updated_at', 'desc')
                ->get();


             // Fetch subscription history for each customer (only active subscriptions)
             foreach ($companies as $customer) {
                $customer->subscriptionHistory = UserSubscriptionHistory::where('customber_id', $customer->id)
                    ->where('subscription_status', 'Active')
                    ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
                    ->when($keyword, function ($query) use ($keyword) {
                        $query->where('subscription_packages.subscription_name', 'like', '%' . $keyword . '%')
                            ->orWhere('user_subscription_histories.payment_method', 'like', '%' . $keyword . '%');
                    })
                    ->select('user_subscription_histories.*', 'subscription_packages.*', 'user_subscription_histories.subscription_id')
                    ->orderBy('user_subscription_histories.updated_at', 'desc')
                    ->first(); // Get the most recent active subscription history for each customer
            }


            $count = self::where('type', 'company')
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->count();

            $pagecount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = ['companies' => $companies, 'count' => $count, 'pagecount' => $pagecount];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }


    public static function getDatasubadmin($page, $perPage, $keyword)
    {
        $response = ['Success' => false, 'Code' => 400, 'Message' => 'Something went wrong !', 'resdata' => ''];

        try {
            $offset = ($page - 1) * $perPage;

            $customers = self::where('type', 'admin')
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->skip($offset)
                ->take($perPage)
                ->orderBy('updated_at', 'desc')
                ->get();

          

            // Count total customers
            $count = self::where('type', 'admin')
                ->where(function ($query) use ($keyword) {
                    $query->where('first_name', 'like', '%' . $keyword . '%')
                        ->orWhere('last_name', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('mobile_number', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_1', 'like', '%' . $keyword . '%')
                        ->orWhere('address_line_2', 'like', '%' . $keyword . '%')
                        ->orWhere('city', 'like', '%' . $keyword . '%')
                        ->orWhere('country', 'like', '%' . $keyword . '%')
                        ->orWhere('postal_code', 'like', '%' . $keyword . '%');
                })
                ->count();

            $pagecount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = ['items' => $customers, 'count' => $count, 'pagecount' => $pagecount];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
