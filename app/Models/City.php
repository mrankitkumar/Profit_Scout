<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['cityname', 'isActive'];
    public static function getData($page, $perPage, $keyword = null)
{
    $response = [
        'Success' => false,
        'Code' => 400,
        'Message' => 'Something went wrong!',
        'resdata' => ''
    ];

    try {
        $offset = ($page - 1) * $perPage;

        // Retrieve filtered categories with pagination
        $categories = self::query()
            ->leftJoin('countries', 'cities.countryid', '=', 'countries.id')
            ->when($keyword, function ($query, $keyword) {
                // Filter by city and country name
                $query->where('cityname', 'like', '%' . $keyword . '%')
                      ->orWhere('countries.countryname', 'like', '%' . $keyword . '%');
            })
            ->select('countries.*', 'cities.*') // Select all columns from both tables
            ->skip($offset)
            ->take($perPage)
            ->orderBy('cities.updated_at', 'desc')
            ->get();

        // Count total records for pagination
        $count = self::query()
            ->leftJoin('countries', 'cities.countryid', '=', 'countries.id')
            ->when($keyword, function ($query, $keyword) {
                // Filter count by city and country name
                $query->where('cityname', 'like', '%' . $keyword . '%')
                      ->orWhere('countries.countryname', 'like', '%' . $keyword . '%');
            })
            ->count();

        $pagecount = ceil($count / $perPage);

        $response['Success'] = true;
        $response['Code'] = 200;
        $response['Message'] = 'Success';
        $response['resdata'] = [
            'items' => $categories,
            'count' => $count,
            'pagecount' => $pagecount,
        ];
    } catch (\Throwable $th) {
        $response['Message'] = $th->getMessage();
    }

    return $response;
}

}
