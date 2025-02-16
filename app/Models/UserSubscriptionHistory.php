<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class UserSubscriptionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'customber_id',  // Corrected typo
        'start_date',
        'end_date',
        'payment_date',
        'ammount',       // Corrected typo
        'subscription_status',
        'payment_status',
        'payment_method',
        'invoice',
        'payment_method_id',
    ];



    public static function getuserSubscriptionHistories($page, $perPage, $keyword)
    {
        $response = [
            'Success' => false,
            'Code' => 400,
            'Message' => 'Something went wrong!',
            'resdata' => ''
        ];

        try {
                $offset = ($page - 1) * $perPage;
            // Get all column names from the relevant tables
            $subHistoryColumns = Schema::getColumnListing('user_subscription_histories');
            $userColumns = Schema::getColumnListing('users');
            $packageColumns = Schema::getColumnListing('subscription_packages');

            $query = self::query()
                ->leftJoin('users', function ($join) {
                    $join->on('user_subscription_histories.customber_id', '=', 'users.id')
                        ->where('users.type', 'user');
                })
                ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
                ->when($keyword, function ($query) use ($keyword, $subHistoryColumns, $userColumns, $packageColumns) {
                    $query->where(function ($query) use ($keyword, $subHistoryColumns, $userColumns, $packageColumns) {
                        foreach ($subHistoryColumns as $column) {
                            $query->orWhere("user_subscription_histories.$column", 'like', '%' . $keyword . '%');
                        }
                        foreach ($userColumns as $column) {
                            $query->orWhere("users.$column", 'like', '%' . $keyword . '%');
                        }
                        foreach ($packageColumns as $column) {
                            $query->orWhere("subscription_packages.$column", 'like', '%' . $keyword . '%');
                        }
                    });
                })
                ->select(
                    'user_subscription_histories.*',
                    'subscription_packages.id as package_id',
                    'subscription_packages.subscription_name',
                    'subscription_packages.price',
                    'users.*',
                    'user_subscription_histories.subscription_id',
                    'user_subscription_histories.id as user_subscription_histories_id'
                )
                ->orderBy('user_subscription_histories.updated_at', 'desc')
                ->where('users.type', 'user')
                ->skip($offset)
                ->take($perPage);

            $count = $query->count();

            $customers = $query->get();

            $pageCount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = [
                'customers' => $customers,
                'count' => $count,
                'pageCount' => $pageCount
            ];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }



    public static function getcustomberSubscriptionHistories($page, $perPage, $keyword)
    {
        $response = [
            'Success' => false,
            'Code' => 400,
            'Message' => 'Something went wrong!',
            'resdata' => ''
        ];
        //dd($page);

        try {
            
                $offset = ($page - 1) * $perPage;
            // Get all column names from the relevant tables
            $subHistoryColumns = Schema::getColumnListing('user_subscription_histories');
            $userColumns = Schema::getColumnListing('users');
            $packageColumns = Schema::getColumnListing('subscription_packages');

            $query = self::query()
                ->leftJoin('users', function ($join) {
                    $join->on('user_subscription_histories.customber_id', '=', 'users.id')
                        ->where('users.type', 'company');
                })
                ->leftJoin('subscription_packages', 'user_subscription_histories.subscription_id', '=', 'subscription_packages.id')
                ->when($keyword, function ($query) use ($keyword, $subHistoryColumns, $userColumns, $packageColumns) {
                    $query->where(function ($query) use ($keyword, $subHistoryColumns, $userColumns, $packageColumns) {
                        foreach ($subHistoryColumns as $column) {
                            $query->orWhere("user_subscription_histories.$column", 'like', '%' . $keyword . '%');
                        }
                        foreach ($userColumns as $column) {
                            $query->orWhere("users.$column", 'like', '%' . $keyword . '%');
                        }
                        foreach ($packageColumns as $column) {
                            $query->orWhere("subscription_packages.$column", 'like', '%' . $keyword . '%');
                        }
                    });
                })
                ->select(
                    'user_subscription_histories.*',
                    'subscription_packages.id as package_id',
                    'subscription_packages.subscription_name',
                    'subscription_packages.price',
                    'users.*',
                    'user_subscription_histories.subscription_id',
                    'user_subscription_histories.id as user_subscription_histories_id'
                )
                ->orderBy('user_subscription_histories.updated_at', 'desc')
                ->where('users.type', 'company')
                ->skip($offset)
                ->take($perPage);
            $count = $query->count();

            $customers = $query->get();






            $pageCount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = [
                'companies' => $customers,
                'count' => $count,
                'pageCount' => $pageCount
            ];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }
}
