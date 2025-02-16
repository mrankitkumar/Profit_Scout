<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subadminpermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'adminid', 
        'permissionsname', 
        'isAdd', 
        'isView', 
        'isEdit', 
        'isDelete'
    ];
    
}
