<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;
    protected $table = 'subscription_packages'; 
    protected $fillable = [
        'subscription_name',
        'subscription_type',
        'price',
        'interval_period',
        'feature',
        'description',
        'isActive',
    ];

    /**
     * Get subscription packages with pagination and keyword search.
     */
    public static function getSubscription($page, $perPage, $keyword)
    {
        $response = [
            'Success' => false,
            'Code' => 400,
            'Message' => 'Something went wrong!',
            'resdata' => '',
        ];

        try {
            $offset = ($page - 1) * $perPage;

            // Query to fetch subscription packages based on keyword search
            $subscriptionPackages = self::where(function ($query) use ($keyword) {
                $query->where('subscription_name', 'like', '%' . $keyword . '%')
                    ->orWhere('subscription_type', 'like', '%' . $keyword . '%')
                    ->orWhere('price', 'like', '%' . $keyword . '%')
                    ->orWhere('interval_period', 'like', '%' . $keyword . '%')
                    ->orWhere('feature', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('isActive', 'like', '%' . $keyword . '%');
            })
            ->skip($offset)
            ->take($perPage)
            ->orderBy('updated_at', 'desc')
            ->get();

            // Get the total count of matching subscription packages
            $count = self::where(function ($query) use ($keyword) {
                $query->where('subscription_name', 'like', '%' . $keyword . '%')
                    ->orWhere('subscription_type', 'like', '%' . $keyword . '%')
                    ->orWhere('price', 'like', '%' . $keyword . '%')
                    ->orWhere('interval_period', 'like', '%' . $keyword . '%')
                    ->orWhere('feature', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('isActive', 'like', '%' . $keyword . '%');
            })
            ->count();

            // Calculate the total number of pages
            $pageCount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = [
                'subscription_packages' => $subscriptionPackages,
                'count' => $count,
                'pagecount' => $pageCount
            ];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }
}
