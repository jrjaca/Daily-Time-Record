<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DtrLogsPips extends Model
{
    use HasFactory;

    //LogsController pipsConversionV2, generateDtrByYearMoPdf function
    public function GetLogsPipsByYearMo($criteria){
        return DB::table('dtr_logs_pips as log')
                ->leftJoin('employees as emp', 'log.employee_no', 'emp.employee_no')
                ->leftJoin('employees_location as loc', 'emp.employee_no', 'loc.employee_no')
                ->leftJoin('loc_pro_lib as pro', 'loc.pro_id', 'pro.pro_id')
                ->leftJoin('loc_branchunit_lib as bra', 'loc.branchunit_id', 'bra.branchunit_id')
                ->leftJoin('loc_lhiosection_lib as sec', 'loc.lhiosection_id', 'sec.lhiosection_id')
                ->leftJoin('loc_express_lib as exp', 'loc.express_id', 'exp.express_id')
                ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.time_logs', 'log.time_logs_dtr',
                        'emp.last_name', 'emp.first_name', 'emp.middle_name', 'emp.suffix_name',
                        'pro.title as title_pro', 'bra.title as title_braunit', 'sec.title as title_seclhio', 'exp.title as title_exp')
                ->where('log.year', $criteria['year'])
                ->where('log.month', $criteria['month'])
                ->where('log.deleted_at', null)
                ->orderBy('log.employee_no', 'ASC')
                //->orderBy('log.year', 'ASC')
                //->orderBy('log.month', 'ASC')
                ->orderBy('log.day', 'ASC')
                ->orderBy('log.time_logs', 'ASC')
                ->get();
    }

    //LogsController generateDtrByYearMoOfficePdf, pipsConversionPerOffice function
    public function GetLogsPipsByYearMoOffice($criteria){
        $query = DB::table('dtr_logs_pips as log');
        //crieteria
        $query->leftJoin('employees as emp', 'log.employee_no', 'emp.employee_no');
        $query->leftJoin('employees_location as loc', 'emp.employee_no', 'loc.employee_no');
        $query->leftJoin('loc_pro_lib as pro', 'loc.pro_id', 'pro.pro_id');
        $query->leftJoin('loc_branchunit_lib as bra', 'loc.branchunit_id', 'bra.branchunit_id');
        $query->leftJoin('loc_lhiosection_lib as sec', 'loc.lhiosection_id', 'sec.lhiosection_id');
        $query->leftJoin('loc_express_lib as exp', 'loc.express_id', 'exp.express_id');
        $query->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.time_logs', 'log.time_logs_dtr',
                        'emp.last_name', 'emp.first_name', 'emp.middle_name', 'emp.suffix_name',
                        'pro.title as title_pro', 'bra.title as title_braunit', 'sec.title as title_seclhio', 'exp.title as title_exp');
                        
        if ($criteria['pro_id'] != '') { $query->where('loc.pro_id', $criteria['pro_id']); }
        if ($criteria['branchunit_id'] != '') { $query->where('loc.branchunit_id', $criteria['branchunit_id']); }
        if ($criteria['lhiosection_id'] != '') { $query->where('loc.lhiosection_id', $criteria['lhiosection_id']); }

        $query->where('log.year', $criteria['year']);
        $query->where('log.month', $criteria['month']);
        $query->where('log.deleted_at', null);
        $query->orderBy('log.employee_no', 'ASC');
        //$query->orderBy('log.year', 'ASC');
        //$query->orderBy('log.month', 'ASC');
        $query->orderBy('log.day', 'ASC');
        $query->orderBy('log.time_logs', 'ASC');
        return $query->get();
    }

    //LogsController generateDtrByYearMoIdNumPdf, updateDtrByIdNumberForm function
    public function GetLogsPipsByEmpYearMo($criteria){
        return DB::table('dtr_logs_pips as log')
                ->leftJoin('employees as emp', 'log.employee_no', 'emp.employee_no')
                ->leftJoin('employees_location as loc', 'emp.employee_no', 'loc.employee_no')
                ->leftJoin('loc_pro_lib as pro', 'loc.pro_id', 'pro.pro_id')
                ->leftJoin('loc_branchunit_lib as bra', 'loc.branchunit_id', 'bra.branchunit_id')
                ->leftJoin('loc_lhiosection_lib as sec', 'loc.lhiosection_id', 'sec.lhiosection_id')
                ->leftJoin('loc_express_lib as exp', 'loc.express_id', 'exp.express_id')
                ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.time_logs', 'log.time_logs_dtr',
                        'emp.last_name', 'emp.first_name', 'emp.middle_name', 'emp.suffix_name',
                        'pro.title as title_pro', 'bra.title as title_braunit', 'sec.title as title_seclhio', 'exp.title as title_exp')
                ->where('emp.employee_no', $criteria['employee_no'])
                ->where('log.year', $criteria['year'])
                ->where('log.month', $criteria['month'])
                ->where('log.deleted_at', null)
                //->orderBy('log.employee_no', 'ASC')
                //->orderBy('log.year', 'ASC')
                //->orderBy('log.month', 'ASC')
                ->orderBy('log.day', 'ASC')
                ->orderBy('log.time_logs', 'ASC')
                ->get();
    }
    
    //LogsController updateDtrByIdNumber function
    //public function IsExistByEmpYearMoDay($criteria){
    public function GetTimeLogsPipsVerByEmpYearMoDay($criteria){
        return DB::table('dtr_logs_pips as log')
            ->select('log.dtr_log_pips_id', 'log.time_logs')
            ->where('log.employee_no', $criteria['employee_no'])
            ->where('log.year', $criteria['year'])
            ->where('log.month', $criteria['month'])
            ->where('log.day', $criteria['day'])
            ->first();
    }

    // public function GetLogsPipsByEmpYearMoDay($criteria){
    //     return DB::table('dtr_logs_pips as log')
    //             ->leftJoin('employees as emp', 'log.employee_no', 'emp.employee_no')
    //             ->leftJoin('employees_location as loc', 'emp.employee_no', 'loc.employee_no')
    //             ->leftJoin('loc_pro_lib as pro', 'loc.pro_id', 'pro.pro_id')
    //             ->leftJoin('loc_branchunit_lib as bra', 'loc.branchunit_id', 'bra.branchunit_id')
    //             ->leftJoin('loc_lhiosection_lib as sec', 'loc.lhiosection_id', 'sec.lhiosection_id')
    //             ->leftJoin('loc_express_lib as exp', 'loc.express_id', 'exp.express_id')
    //             ->select('log.employee_no', 'log.year', 'log.month', 'log.day', 'log.time_logs',
    //                     'emp.last_name', 'emp.first_name', 'emp.middle_name', 'emp.suffix_name',
    //                     'pro.title as title_pro', 'bra.title as title_braunit', 'sec.title as title_seclhio', 'exp.title as title_exp')
    //             ->where('emp.employee_no', $criteria['employee_no'])
    //             ->where('log.year', $criteria['year'])
    //             ->where('log.month', $criteria['month'])
    //             ->where('log.day', $criteria['day'])
    //             ->where('log.deleted_at', null)
    //             ->orderBy('log.day', 'ASC')
    //             ->orderBy('log.time_logs', 'ASC')
    //             ->get();
    // }
}
