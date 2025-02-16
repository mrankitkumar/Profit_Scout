<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['rolesname', 'isActive'];

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

            // Retrieve filtered categories
            $roles = self::query()
                ->when($keyword, function ($query, $keyword) {
                    $query->where('rolesname', 'like', '%' . $keyword . '%');
                })
                ->skip($offset)
                ->take($perPage)
                ->orderBy('updated_at', 'desc')
                ->get();

            // Count total records for pagination
            $count = self::query()
                ->when($keyword, function ($query, $keyword) {
                    $query->where('rolesname', 'like', '%' . $keyword . '%');
                })
                ->count();

            $pagecount = ceil($count / $perPage);

            $response['Success'] = true;
            $response['Code'] = 200;
            $response['Message'] = 'Success';
            $response['resdata'] = [
                'items' => $roles,
                'count' => $count,
                'pagecount' => $pagecount,
            ];
        } catch (\Throwable $th) {
            $response['Message'] = $th->getMessage();
        }

        return $response;
    }
}
