<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DtrLogs extends Model
{
    use HasFactory;

    //UNUSED
    //LogsController pipsConversion(unused) function
    public function GetLogsWithCriteria($criteria){
        return DB::table('dtr_logs as log')
                    //->join('brands', 'products.brand_id', 'brands.id')
                    //->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.hour', 'log.hour_12', 'log.minute', 
                            'log.seconds', 'meridiem', 'log.fifth_place', 'log.log_type_code', 'log.filename_uploaded')
                    //->where('deleted_at', '=', null) //EXCEPT SOFT DELETED
                    ->where('log.year', $criteria['year'])
                    ->where('log.month', $criteria['month'])
                    ->where('log.deleted_at', null)
                    ->orderBy('log.employee_no', 'ASC')
                    ->orderBy('log.year', 'ASC')
                    ->orderBy('log.month', 'ASC')
                    ->orderBy('log.day', 'ASC')
                    ->orderBy('log.hour', 'ASC')
                    ->orderBy('log.minute', 'ASC')
                    ->orderBy('log.seconds', 'ASC')
                    ->get();
                    // $table->string('name')->nullable();
                    // $table->string('')->comment('(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)');
                    // $table->integer('uploaded_by')->comment('employee_no');
                    // $table->string('filename_original');
    }

    //LogsController savePipsVersion function
    public function GetLogsByTransactionNo($transactionNo){
        return DB::table('dtr_logs as log')
                    //->join('brands', 'products.brand_id', 'brands.id')
                    //->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.hour', 'log.hour_12', 'log.minute', 
                            'log.seconds', 'meridiem', 'log.fifth_place', 'log.log_type_code', 'log.filename_uploaded')
                    //->where('deleted_at', '=', null) //EXCEPT SOFT DELETED
                    ->where('log.transaction_no', $transactionNo)
                    ->where('log.deleted_at', null)
                    ->orderBy('log.employee_no', 'ASC')
                    ->orderBy('log.year', 'ASC')
                    ->orderBy('log.month', 'ASC')
                    ->orderBy('log.day', 'ASC')
                    ->orderBy('log.hour', 'ASC')
                    ->orderBy('log.minute', 'ASC')
                    ->orderBy('log.seconds', 'ASC')
                    ->get();
                    // $table->string('name')->nullable();
                    // $table->string('')->comment('(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)');
                    // $table->integer('uploaded_by')->comment('employee_no');
                    // $table->string('filename_original');
    }

    /*
    public function GetDetailedLogsWithCriteria($criteria){
        return DB::table('dtr_logs as log')
                    //->join('brands', 'products.brand_id', 'brands.id')
                    //->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.hour', 'log.hour_12', 'log.minute', 
                            'log.seconds', 'meridiem', 'log.fifth_place', 'log.log_type_code', 'log.filename_uploaded')
                    //->where('deleted_at', '=', null) //EXCEPT SOFT DELETED
                    ->where('log.year', $criteria['year'])
                    ->where('log.month', $criteria['month'])
                    ->where('log.deleted_at', null)
                    ->orderBy('log.employee_no', 'ASC')
                    ->orderBy('log.year', 'ASC')
                    ->orderBy('log.month', 'ASC')
                    ->orderBy('log.day', 'ASC')
                    ->orderBy('log.hour', 'ASC')
                    ->orderBy('log.minute', 'ASC')
                    ->orderBy('log.seconds', 'ASC')
                    ->get();
                    // $table->string('name')->nullable();
                    // $table->string('')->comment('(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)');
                    // $table->integer('uploaded_by')->comment('employee_no');
                    // $table->string('filename_original');
    }*/

}
