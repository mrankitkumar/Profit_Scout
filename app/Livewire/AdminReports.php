<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
class AdminReports extends Component
{

    public function Custombers_reoprt()
    {
       
        $tableName = 'users'; 

       
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

       
        $rows = DB::table($tableName)->whereIn('type', ['user', 'company'])->get();

        $filename = "{$tableName}_report.csv";

     
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

      
        $callback = function () use ($columns, $rows) {
            $fileHandle = fopen('php://output', 'w');

           
            fputcsv($fileHandle, $columns);

     
            foreach ($rows as $row) {
                fputcsv($fileHandle, (array) $row);
            }

            fclose($fileHandle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function subscription_reoprt()
    {
       
        $tableName = 'subscription_packages'; 

       
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

       
        $rows = DB::table($tableName)->get();

        $filename = "{$tableName}_report.csv";

     
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

      
        $callback = function () use ($columns, $rows) {
            $fileHandle = fopen('php://output', 'w');

           
            fputcsv($fileHandle, $columns);

     
            foreach ($rows as $row) {
                fputcsv($fileHandle, (array) $row);
            }

            fclose($fileHandle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function payment_reoprt()
    {
       
        $tableName = 'user_subscription_histories'; 

       
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

       
        $rows = DB::table($tableName)->get();

        $filename = "{$tableName}_report.csv";

     
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

      
        $callback = function () use ($columns, $rows) {
            $fileHandle = fopen('php://output', 'w');

           
            fputcsv($fileHandle, $columns);

     
            foreach ($rows as $row) {
                fputcsv($fileHandle, (array) $row);
            }

            fclose($fileHandle);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function subadmin_reoprt()
    {
       
        $tableName = 'users'; 

       
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

       
        $rows = DB::table($tableName)
        ->where('type', 'admin')
        ->whereNotNull('subadminrole_id')
        ->leftJoin('roles', 'users.subadminrole_id', '=', 'roles.id')
        ->select(
            'users.*',
            'roles.rolesname as rolesname'
        )
        ->get();

        $columns = array_merge($columns, ['rolesname']);
    

        $filename = "{$tableName}subadmin_report.csv";

     
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

      
        $callback = function () use ($columns, $rows) {
            $fileHandle = fopen('php://output', 'w');

           
            fputcsv($fileHandle, $columns);

     
            foreach ($rows as $row) {
                fputcsv($fileHandle, (array) $row);
            }

            fclose($fileHandle);
        };

        return Response::stream($callback, 200, $headers);
    }



    public function render()
    {
        return view('livewire.admin-reports');
    }
}
