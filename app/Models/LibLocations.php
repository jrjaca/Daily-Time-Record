<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LibLocations extends Model
{
    use HasFactory;

    //LogsController index function
    public function listOfPros(){ 
        return DB::table('loc_pro_lib')
            ->where('deleted_at', null)
            ->orderBy('title', 'ASC')
            ->get();
    }

    //LogsController index function
    public function listOfBranchUnitsPerPro($proId){ 
        return DB::table('loc_branchunit_lib')
            ->where('pro_id', $proId)
            ->where('deleted_at', null)
            //->orderBy('title', 'ASC')
            ->orderBy('branchunit_id', 'ASC')
            ->get();
    }

    //LocationController getLhioSectionByBranchUnitId function
    public function listOfLhioSectionsPerBranch($branchUnitId){ 
        return DB::table('loc_lhiosection_lib')
            ->where('branchunit_id', $branchUnitId)
            ->where('deleted_at', null)
            ->orderBy('title', 'ASC')
            ->get();
    }

    public function listOfExpressesPerLhio($lhioSectionId){ 
        return DB::table('loc_express_lib')
            ->where('lhiosection_id', $lhioSectionId)
            ->where('deleted_at', null)
            ->orderBy('title', 'ASC')
            ->get();
    }
}
