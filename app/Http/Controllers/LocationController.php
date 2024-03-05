<?php

namespace App\Http\Controllers;

use App\Models\LibLocations;
use Illuminate\Http\Request;

class LocationController extends Controller
{    
    public function __construct()
    {
        $this->libLocations = new LibLocations;
    }

    public function getLhioSectionByBranchUnitId($departmentUnitId){                  
        $result =  $this->libLocations->listOfLhioSectionsPerBranch($departmentUnitId);
        return json_encode($result);
    }
}
