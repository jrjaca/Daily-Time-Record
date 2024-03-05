<?php

namespace App\Http\Controllers;

use App\Models\DtrLogs;
use App\Models\DtrLogsPips;
use Illuminate\Support\Str;
use App\Models\LibLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class LogsController extends Controller
{
    public function __construct(){
        $this->dtrLogs = new DtrLogs;
        $this->dtrLogsPips = new DtrLogsPips;
        $this->libLocations = new LibLocations;
    }

    public function index(){
        $pros = $this->libLocations->listOfPros();
        $branchunits = $this->libLocations->listOfBranchUnitsPerPro('1'); //hardcoded to PRO NCR pro_id=1
        //$lhiosections = $this->libLocations->listOfLhioSectionsPerBranch('1'); //hardcoded to PRO NCR SOUTH BRANCH
        //$expresses = $this->user_location_transfer->getCurrentPendingTransfer(\Auth::id());
        //return view('user-management.profile-edit', compact('user', 'offices', 'departments', 'sections', 'pending_location_transfer'));
        return view('index', compact('pros', 'branchunits'));
    }

    public function uploadFile(Request $request){
        ini_set('max_execution_time', 300); //5minutes

        // ini_set('upload_max_filesize', "6000M");
        // ini_set('post_max_size', "5000M");
        // ini_set('max_execution_time', 6000);
        // ini_set('max_input_time', 6000);

        $request->validate([
            // 'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:2048'
            'file' => 'required|mimes:txt|max:2048'
        ],
        [
            'file.required' => 'You have to choose the file!',
            'file.mimes' => "File type must be text with '.dat' extension",
            'file.max' => 'Maximum file to upload is 2MB only.'
        ]); 

        if($request->file('file')) {
            if (Str::lower($request->file('file')->getClientOriginalExtension()) == 'dat'){
                
                //-----------save to storage folder-----------//
                $file = $request->file('file');
                $filenameOrig = $file->getClientOriginalName();
                $time = time();
                $filenameUpload = $time.'_'.$filenameOrig;
                $file->storeAs('public/file_logs/', $filenameUpload);

                //-----------get and display content / save to db-----------//
                $fileContent = Storage::get('public/file_logs/'.$filenameUpload); 
                $row_logs = explode(PHP_EOL, $fileContent); //itemized
                //dd($row_logs);

                //////////////////////////transaction no 01procode/idnolast4digits/time
                $employeeNo ='20556408';  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                $date_created = Carbon::now('Asia/Manila');
                $transactionNo = $employeeNo.'-'.$time;
                $atLeastOneSaved = false;
                $withExisting = false;

                $yearLog = '';
                $monthLog = '';
                $valid = True;
                foreach($row_logs as $row){
                    $item = preg_split("/\t+/", $row);  //split and assign to row per tab itemized
                    $empNo = trim($item[0]);
                    if (isset($row[0])){ //no id number, assuming null row. only catches offset 0
                        //----Check content valid format - Check if the ID Number is 8 characters in lenght----//
                        if (strlen($empNo) != 8) {
                            $valid = False;
                            //dd($empNo);
                        }
                        //----Check content valid format - Check if the ID Number is 8 characters in lenght----//
                        
                        //dd($item[4]);

                        //=========Check device source: Granding or Veterans==========//
                        //dd(count($item));
                        //dd($item);
                        if (count($item) >= 6){ //from Veterans
                            /*
                                0 => "20094099"
                                1 => "2020-01-27 10:54:08"
                                2 => "1"
                                3 => "3"
                                4 => "1"
                                5 => "0"
                            */
                            if (substr($item[1], 11, 2) >= 12){
                                $meridiem = "PM";
                                if      (substr($item[1], 11, 2) == "12"){ $hour_12 = "12"; }
                                elseif  (substr($item[1], 11, 2) == "13"){ $hour_12 = "01"; }
                                elseif  (substr($item[1], 11, 2) == "14"){ $hour_12 = "02"; }
                                elseif  (substr($item[1], 11, 2) == "15"){ $hour_12 = "03"; }
                                elseif  (substr($item[1], 11, 2) == "16"){ $hour_12 = "04"; }
                                elseif  (substr($item[1], 11, 2) == "17"){ $hour_12 = "05"; }
                                elseif  (substr($item[1], 11, 2) == "18"){ $hour_12 = "06"; }
                                elseif  (substr($item[1], 11, 2) == "19"){ $hour_12 = "07"; }
                                elseif  (substr($item[1], 11, 2) == "20"){ $hour_12 = "08"; }
                                elseif  (substr($item[1], 11, 2) == "21"){ $hour_12 = "09"; }
                                elseif  (substr($item[1], 11, 2) == "22"){ $hour_12 = "10"; }
                                elseif  (substr($item[1], 11, 2) == "23"){ $hour_12 = "11"; }
                            } else {
                                $meridiem = "AM";
                                $hour_12 = substr($item[1], 11, 2);
                            }

                            $details['employee_no'] = $empNo;
                            //$details['name'] = '';
                
                            $details['year'] = substr($item[1], 0, 4); 
                            $details['month'] = substr($item[1], 5, 2); 
                            $details['day'] = substr($item[1], 8, 2);  
                            $details['hour'] = substr($item[1], 11, 2);  //24 hr format
                            $details['hour_12'] = $hour_12;  //12 hr format
                            $details['meridiem'] = $meridiem;
                            $details['minute'] = substr($item[1], 14, 2);  
                            $details['seconds'] = substr($item[1], 17, 2); 

                            $details['fifth_place'] = $item[2];
                            $details['log_type_code'] = $item[3]; //(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)
                            $details['device'] = 'V';
                            //dd($details['log_type_code'] = $item[3]); 

                            //assuming same year and month of uploaded document. To be used in saving pips version
                            $yearLog = substr($item[1], 0, 4);
                            $monthLog = substr($item[1], 5, 2);
                        } else { //from Granding
                            if (isset($item[4])){ //means with nickname of employee
                                /*
                                    0 => "30756921"
                                    1 => "MANUEL"
                                    2 => "2022-06-28 10:25:33"
                                    3 => "1"
                                    4 => "0"
                                */
                                if (substr($item[2], 11, 2) >= 12){
                                    $meridiem = "PM";
                                    if      (substr($item[2], 11, 2) == "12"){ $hour_12 = "12"; }
                                    elseif  (substr($item[2], 11, 2) == "13"){ $hour_12 = "01"; }
                                    elseif  (substr($item[2], 11, 2) == "14"){ $hour_12 = "02"; }
                                    elseif  (substr($item[2], 11, 2) == "15"){ $hour_12 = "03"; }
                                    elseif  (substr($item[2], 11, 2) == "16"){ $hour_12 = "04"; }
                                    elseif  (substr($item[2], 11, 2) == "17"){ $hour_12 = "05"; }
                                    elseif  (substr($item[2], 11, 2) == "18"){ $hour_12 = "06"; }
                                    elseif  (substr($item[2], 11, 2) == "19"){ $hour_12 = "07"; }
                                    elseif  (substr($item[2], 11, 2) == "20"){ $hour_12 = "08"; }
                                    elseif  (substr($item[2], 11, 2) == "21"){ $hour_12 = "09"; }
                                    elseif  (substr($item[2], 11, 2) == "22"){ $hour_12 = "10"; }
                                    elseif  (substr($item[2], 11, 2) == "23"){ $hour_12 = "11"; }
                                } else {
                                    $meridiem = "AM";
                                    $hour_12 = substr($item[2], 11, 2);
                                }
    
                                $details['employee_no'] = $empNo;
                                //$details['name'] = $item[1];
                                $details['fifth_place'] = $item[3];
    
                                $details['year'] = substr($item[2], 0, 4); 
                                $details['month'] = substr($item[2], 5, 2); 
                                $details['day'] = substr($item[2], 8, 2);  
                                $details['hour'] = substr($item[2], 11, 2);  //24 hr format
                                $details['hour_12'] = $hour_12;  //12 hr format
                                $details['meridiem'] = $meridiem;
                                $details['minute'] = substr($item[2], 14, 2);  
                                $details['seconds'] = substr($item[2], 17, 2); 
    
                                $details['log_type_code'] = $item[4]; //(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)
                                
                                //assuming same year and month of uploaded document. To be used in saving pips version
                                $yearLog = substr($item[2], 0, 4);
                                $monthLog = substr($item[2], 5, 2);
                            } else { //means no nickname of employee
                                /*
                                    array:4 [▼
                                        0 => "66666666"
                                        1 => "2022-06-28 21:35:07"
                                        2 => "1"
                                        3 => "0"
                                    ]
                                */
                                //dd($item[1]);
                                if (substr($item[1], 11, 2) >= 12){
                                    $meridiem = "PM";
                                    if      (substr($item[1], 11, 2) == "12"){ $hour_12 = "12"; }
                                    elseif  (substr($item[1], 11, 2) == "13"){ $hour_12 = "01"; }
                                    elseif  (substr($item[1], 11, 2) == "14"){ $hour_12 = "02"; }
                                    elseif  (substr($item[1], 11, 2) == "15"){ $hour_12 = "03"; }
                                    elseif  (substr($item[1], 11, 2) == "16"){ $hour_12 = "04"; }
                                    elseif  (substr($item[1], 11, 2) == "17"){ $hour_12 = "05"; }
                                    elseif  (substr($item[1], 11, 2) == "18"){ $hour_12 = "06"; }
                                    elseif  (substr($item[1], 11, 2) == "19"){ $hour_12 = "07"; }
                                    elseif  (substr($item[1], 11, 2) == "20"){ $hour_12 = "08"; }
                                    elseif  (substr($item[1], 11, 2) == "21"){ $hour_12 = "09"; }
                                    elseif  (substr($item[1], 11, 2) == "22"){ $hour_12 = "10"; }
                                    elseif  (substr($item[1], 11, 2) == "23"){ $hour_12 = "11"; }
                                } else {
                                    $meridiem = "AM";
                                    $hour_12 = substr($item[1], 11, 2);
                                }
    
                                $details['employee_no'] = $empNo;
                                //$details['name'] = '';
                                
                                $details['year'] = substr($item[1], 0, 4); 
                                $details['month'] = substr($item[1], 5, 2); 
                                $details['day'] = substr($item[1], 8, 2);  
                                $details['hour'] = substr($item[1], 11, 2);  //24 hr format
                                $details['hour_12'] = $hour_12;  //12 hr format
                                $details['meridiem'] = $meridiem;
                                $details['minute'] = substr($item[1], 14, 2);  
                                $details['seconds'] = substr($item[1], 17, 2); 
    
                                $details['fifth_place'] = $item[2];
                                $details['log_type_code'] = $item[3]; //(0)-Check in. (1)-Check out. (2)-Break out. (3)-Break in)
                                //dd($details['log_type_code'] = $item[3]); 

                                //assuming same year and month of uploaded document. To be used in saving pips version
                                $yearLog = substr($item[1], 0, 4);
                                $monthLog = substr($item[1], 5, 2);
                            }
                            $details['device'] = 'G';
                        }


                            $details['uploaded_by'] = $employeeNo;
                            $details['filename_original'] = $filenameOrig;
                            $details['filename_uploaded'] = $filenameUpload;
                            $details['created_at'] = $date_created;
                            $details['transaction_no'] = $transactionNo;

                        if ($valid){
                            //check if log doesn't exist log, if exist skip
                            $notExist = DtrLogs::select("*")
                                        ->where("employee_no", $details['employee_no'])
                                        ->where("year", $details['year'])
                                        ->where("month", $details['month'])
                                        ->where("day", $details['day'])
                                        ->where("hour", $details['hour'])
                                        ->where("minute", $details['minute'])
                                        ->where("seconds", $details['seconds'])
                                        ->doesntExist();

                            if ($notExist) {
                                DB::table('dtr_logs')->insert($details);

                                //====== Save PIPS version ======//
                                //$this->savePipsVersion($yearLog, $monthLog);
                                //====== Save PIPS version ======//

                                $atLeastOneSaved = true;
                            } else {
                                $withExisting = true;
                            }     
                        }                   
                    }
                }

                if ($valid){
                        //====== Save PIPS version ======//
                        if ($atLeastOneSaved){
                            $this->savePipsVersion($transactionNo);
                        }
                        //====== Save PIPS version ======//
                        
                        if ($atLeastOneSaved && !$withExisting){    //all logs are new
                            Session::flash('message','Successfully uploaded. Transaction No.: '.$transactionNo);
                            Session::flash('alert-class', 'alert-success');
                        } elseif (!$atLeastOneSaved && $withExisting){  //all logs are already exist
                            Session::flash('message','All logs are already exist.');
                            Session::flash('alert-class', 'alert-warning');
                        } elseif ($atLeastOneSaved && $withExisting){  //Some logs are already exist and some are successfully saved.
                            Session::flash('message','Successfully uploaded. Some logs are already exist and some logs are saved with Transaction No.: '.$transactionNo);
                            Session::flash('alert-class', 'alert-success');
                        } else {
                            Session::flash('message','Successfully uploaded. But no logs saved. Please check your file content.');
                            Session::flash('alert-class', 'alert-warning');
                        }   
                }  else {
                    Session::flash('message',"File not uploaded. Check the content format.");
                    Session::flash('alert-class', 'alert-danger');
                }      
            } else {
                Session::flash('message',"File not uploaded. File extension must be '.dat'");
                Session::flash('alert-class', 'alert-danger');
            }
        }else{
            Session::flash('message','File not uploaded.');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('/');
    }

        //check duplicate log before saving
        //after saving through dtr_logs table, pull-out the data and save to dtr_logs_pips
        public function savePipsVersion($transactionNo){
            $uploadedByEmpNo ='20556408';  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //$criteria['year'] = $year;
            //$criteria['month'] = $month;
            
            $result = $this->dtrLogs->GetLogsByTransactionNo($transactionNo);
            //dd($result);
            $content = array();
            $common = "";
            $iterDays = "";
            $empNumRes = "";
            $yearRes = "";
            $moRes = "";
            $dayRes = "";
            $cnt = 0; //15 cycle / 15 pipes
            foreach($result as $row){

                if ($empNumRes == ""){ //means first row, no assignment yet
                    $empNumRes = $row->employee_no;
                    $yearRes = $row->year;
                    $moRes = $row->month;
                    $dayRes = $row->day;
                    //$cnt += 1;
                } 


                //15 cycle / 15 pipes
                if ($empNumRes == $row->employee_no && $yearRes == $row->year && 
                    $moRes == $row->month && $dayRes == $row->day){ //group by employee no, year, month and day

                    //another DAY-------------
                    $common = $row->employee_no.'|'.$row->month.'/'.$row->day.'/'.substr($row->year, 2, 2); //once
                    $iterDays = $iterDays.'|'.$row->hour_12.':'.$row->minute.':'.$row->seconds.' '.$row->meridiem; //iterative
                    //another DAY-------------

                } else { //different ID number, date today
                    //$content[] = $common.$iterDays; //save previous
                    $content[] = $common.$iterDays.$this->pipes($common.$iterDays); //save previous //single row result, same emp num, year, mos, day
                    
                    //another DAY-------------
                    $common = $row->employee_no.'|'.$row->month.'/'.$row->day.'/'.substr($row->year, 2, 2);
                    $iterDays = '|'.$row->hour_12.':'.$row->minute.':'.$row->seconds.' '.$row->meridiem;
                    //another DAY-------------

                    //reset, because other day
                    $empNumRes = $row->employee_no;
                    $yearRes = $row->year;
                    $moRes = $row->month;
                    $dayRes = $row->day;
                }
                
                //---- add the last row ----//
                $cnt += 1;
                if ((count($result)-$cnt) == 0){
                    $content[] = $common.$iterDays.$this->pipes($common.$iterDays); //save last row
                }

                /*
                    +"employee_no": 2055648
                    +"year": "2022"
                    +"month": "06"
                    +"day": "28"
                    +"hour": "10"
                    +"minute": "33"
                    +"seconds": "34"
                    +"fifth_place": "1"
                    +"log_type_code": "0"
                    +"filename_uploaded": "1658067063_attlog (6) (1).dat"

                    10005197|11/05/18|06:42:11 AM|12:02:13 PM|12:02:29 PM|||||||||||
                */


                

                
            }

            //---- FORMATING and SAVING----//
            //$text = "";
            $notExist = false;
            foreach ($content as $r){
                //dd($r);  "10008797|07/07/22|01:38:08 PM|01:38:19 PM||||||||||||"
                if ($r != "") {
                    $item = explode('|', $r);
                    $timeLogsDtr = '';
                    //$text = $text.$r."\n";
                    
                    //didn't loop, instead hard code the index
                    $employeeNo = $item[0];
                    $yr = substr($item[1], 6, 2);
                    $year = '20'.$yr;
                    $month = substr($item[1], 0, 2);
                    $day = substr($item[1], 3, 2);


                    //------- SAVE DTR (6 column) Version--------//
                    //$r = "10008797|07/07/22|01:38:08 PM|01:38:19 PM||||||||||||"   complete is 10008797|07/07/22 an 13 time logs
                    $t1 = $item[2]; 
                    $t2 = $item[3]; 
                    $t3 = $item[4]; 
                    $t4 = $item[5]; 
                    $t5 = $item[6]; 
                    $t6 = $item[7]; 
                    $t7 = $item[8]; 
                    $t8 = $item[9]; 
                    $t9 = $item[10]; 
                    $t10 = $item[11]; 
                    $t11 = $item[12]; 
                    $t12 = $item[13]; 
                    $t13 = $item[14]; 

                    $pmCount = substr_count($r, 'PM');
                    $amCount = substr_count($r, 'AM');
                    $t1Hr = intval(substr($t1, 0, 2));
                    $is1pmFirstOccurence = false;
                    $firstPM = false;
                    $is12pmFirstOccurence = false;
                    $firstPM2 = false;
                    foreach($item as $o){
                        if (substr_count($o, 'PM') >= 1 && $firstPM == false){ //checking if the first PM is 1 PM and onwards
                            $firstPM = true;
                            if(substr($o, 0, 2) >= 1 && substr($o, 0, 2) <= 11){
                                $is1pmFirstOccurence = true; 
                            }
                        }

                        if (substr_count($o, 'PM') >= 1 && $firstPM2 == false){ //checking if the first PM is 1 PM and onwards
                            $firstPM2 = true;
                            if(substr($o, 0, 2) >= 1 && substr($o, 0, 2) <= 12){
                                $is12pmFirstOccurence = true; 
                            }
                        }
                    } 

                    
                    //---------SET----------//
                    if ($pmCount == 0 && $amCount == 1){ 
                        //scenario 1 
                        //NO PM, 1 time AM = 1st row only (AM In)
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.'|'.$t1.'|||||||||||||'; //all rows
                    } elseif ($pmCount == 0 && $amCount >=2){ 
                        //scenario 2
                        // NO PM,  2 or more AM = 1st row single (AM in), second is multiple (AM Out)
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                        '|'.$t1. //1st row
                        '|'.trim(preg_replace('/\s+/', ' ', ($t2.' '.$t3.' '.$t4.' '.$t5.' '.$t6.' '.$t7.' '.$t8.' '.$t9.' '.$t10.' '.$t11.' '.$t12.' '.$t13))).'||||||||||||'; //2nd row and rest
                    } elseif ($amCount == 0 && $pmCount >= 1 && ($t1Hr >= 2 && $t1Hr <= 11)){ 
                        //scenario 3
                        //If no AM and PM starts at 2:00 PM onwards
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                                        '|||||'.$t1. //row 5, OT In
                                        '|'.trim(preg_replace('/\s+/', ' ', ($t2.' '.$t3.' '.$t4.' '.$t5.' '.$t6.' '.$t7.' '.$t8.' '.$t9.' '.$t10.' '.$t11.' '.$t12.' '.$t13))).'||||||||'; //row 6, OT Out and rest
                    } elseif ($amCount == 0 && $pmCount >= 1){ 
                        //elseif ($amCount == 0 && $pmCount >= 1 && (substr($t1, 0, 2) == '12' || substr($t1, 0, 2) == '01')){ 
                        //scenario 4
                        //If no AM and PM starts between 12:00-12:59 or 01:00-01:59 PM and onwards
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                                        '|||'.$t1.'|'.$t2.'|'.$t3. //row 3,4,5 PM In, PM Out, OT In
                                        '|'.trim(preg_replace('/\s+/', ' ', ($t4.' '.$t5.' '.$t6.' '.$t7.' '.$t8.' '.$t9.' '.$t10.' '.$t11.' '.$t12.' '.$t13))).'||||||||'; //row 6, OT Out and rest
                    } elseif ($amCount >= 2 && $pmCount >= 1 && $is1pmFirstOccurence){ 
                        //scenario 5
                        //IF has 2 or more AM and PM is 1 PM onwards
                        $ams = "";
                        $pms = "";
                        $pminfirst = "";
                        $pmoutsecond = "";
                        $otinthird = "";               
                        $s5Cnt = 0;
                        $s5PmCnt = 0;
                        foreach($item as $s5){// loop
                            if ($s5Cnt >= 3){ // disregard 0, 1 and 2 index, or thee idnum, date and 1st AM
                                if(strpos($s5, 'AM') == true){
                                    $ams .= $s5.' ';
                                } else { //assuming all are PM
                                    if ($s5PmCnt == 0){ //Hardcode the 1st to 3rd PM
                                        $pminfirst = $s5;
                                    } elseif($s5PmCnt == 1){ //2nd
                                        $pmoutsecond = $s5;
                                    } elseif($s5PmCnt == 2){ //3rd
                                        $otinthird = $s5;
                                    } else {
                                        $pms .= $s5.' ';
                                    }    
                                    $s5PmCnt++;
                                }
                            }
                            $s5Cnt++;
                        }
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                                        '|'.$t1. //row 1, AM In
                                        '|'.trim(preg_replace('/\s+/', ' ', $ams)). //row 2, OT Out
                                        '|'.$pminfirst.'|'.$pmoutsecond.'|'.$otinthird. //row 3, 4, 5. PM In, Out, OT In
                                        '|'.trim(preg_replace('/\s+/', ' ', $pms)).'||||||||'; //row 6, OT Out and rest
                    } elseif ($amCount == 1 && $pmCount >= 1 && $is1pmFirstOccurence){ 
                        //scenario 6
                        //IF has 1 time AM and PM is 1 PM onwards.
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                                        '|'.$t1. //row 1, AM In
                                        '|'. //row 2, OT Out
                                        '|'.$t2.'|'.$t3.'|'.$t4. //row 3, 4, 5. PM In, Out, OT In
                                        '|'.trim(preg_replace('/\s+/', ' ', ($t5.' '.$t6.' '.$t7.' '.$t8.' '.$t9.' '.$t10.' '.$t11.' '.$t12.' '.$t13))).'||||||||'; //row 6, OT Out and rest
                    
                    } elseif ($amCount >= 1 && $pmCount >= 1 && $is12pmFirstOccurence){ 
                        //scenario 7
                        //If has 1 or more AM and has 12:00-12:59 PM
                        $ams = "";
                        $pms = "";
                        $amoutfirst = "";
                        $pminsecond = "";
                        $pmoutthird = "";
                        $otinfourth = "";              
                        $s7Cnt = 0;
                        $s7PmCnt = 0;
                        foreach($item as $s7){// loop
                            if ($s7Cnt >= 2){ // disregard 0, 1 and 2 index, or thee idnum, date
                                if(strpos($s7, 'AM') == true){
                                    $ams .= $s7.' ';
                                } else { //assuming all are PM
                                    if ($s7PmCnt == 0){ //Hardcode the 1st to 3rd PM
                                        $amoutfirst = $s7;
                                    } elseif($s7PmCnt == 1){ //2nd
                                        $pminsecond = $s7;
                                    } elseif($s7PmCnt == 2){ //3rd
                                        $pmoutthird = $s7;
                                    } elseif($s7PmCnt == 3){ //4th
                                        $otinfourth = $s7;
                                    } else {
                                        $pms .= $s7.' ';
                                    }    
                                    $s7PmCnt++;
                                }
                            }
                            $s7Cnt++;
                        }
                        $timeLogsDtr = $employeeNo.'|'.$month.'/'.$day.'/'.$yr.
                                        '|'.trim(preg_replace('/\s+/', ' ', $ams)). //row 1, AM In
                                        '|'.$amoutfirst.'|'.$pminsecond.'|'.$pmoutthird.'|'.$otinfourth. //row 2, 3, 4, 5. AM Out, PM In, Out, OT In
                                        '|'.trim(preg_replace('/\s+/', ' ', $pms)).'||||||||'; //row 6, OT Out and rest
                    }
                    //------- /SAVE DTR (6 column) Version--------//



                    $details['employee_no'] = $employeeNo;
                    $details['year'] = $year;
                    $details['month'] = $month;
                    $details['day'] = $day;
                    $details['time_logs'] = $r;
                    $details['time_logs_dtr'] = $timeLogsDtr;
                    $details['uploaded_by'] = $uploadedByEmpNo;
                    $details['created_at'] = Carbon::now('Asia/Manila');
                    
                    //check if log doesn't exist log, if exist skip
                    $notExist = DtrLogsPips::select("*")
                                ->where("employee_no", $employeeNo)
                                ->where("year", $year)
                                ->where("month", $month)
                                ->where("day", $day)
                                ->doesntExist();

                    if ($notExist) {
                        DB::table('dtr_logs_pips')->insert($details);
                    }  
                }
            }
        }

    public function pipsConversionV2(Request $request){
        $employeeNo = '20556408';
        $criteria['year'] = $request['yearP'];
        $criteria['month'] = $request['monthP'];

        $result = $this->dtrLogsPips->GetLogsPipsByYearMo($criteria);

        //dd($result);
        $text = "";
        foreach($result as $row){
            //dd($row->time_logs);
            $text .= $row->time_logs."\n";
        }

        // file name that will be used in the download
        $fileName = $employeeNo.'_'.$criteria['month'].$criteria['year'].'_'.Carbon::now('Asia/Manila').'.txt';

        // use headers in order to generate the download
        $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            //'Content-Length' => sizeof($text)
        ];

        // make a response, with the content, a 200 response code and the headers
        return Response::make($text, 200, $headers);

    }

    public function pipsConversionPerOffice(Request $request){
        $employeeNo = '20556408';
        $criteria['pro_id'] = $request['pro_id_pips'];
        $criteria['branchunit_id'] = $request['branchunit_id_pips'];
        $criteria['lhiosection_id'] = $request['lhiosection_id_pips'];
        $criteria['year'] = $request['yearPo'];
        $criteria['month'] = $request['monthPo'];
        $result = $this->dtrLogsPips->GetLogsPipsByYearMoOffice($criteria);
        //dd($result);
        $text = "";
        foreach($result as $row){
            //dd($row->time_logs);
            $text .= $row->time_logs."\n";
        }

        // file name that will be used in the download
        $fileName = $employeeNo.'_'.$criteria['month'].$criteria['year'].'_OfficeID-'.$request['pro_id_pips'].$request['branchunit_id_pips'].$request['lhiosection_id_pips'].'_'.Carbon::now('Asia/Manila').'.txt';

        // use headers in order to generate the download
        $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            //'Content-Length' => sizeof($text)
        ];

        // make a response, with the content, a 200 response code and the headers
        return Response::make($text, 200, $headers);

    }

    //////////======== NOT USED???????? DIRECTLY FROM DTR_LOGS TABLE=================/////////
    public function pipsConversion(Request $request){
        //Storage::disk('local')->put('file.txt', 'Your content here');

        $employeeNo = '20556408';
        $criteria['year'] = $request['yearP'];
        $criteria['month'] = $request['monthP'];
        
        $result = $this->dtrLogs->GetLogsWithCriteria($criteria);
        $content[] = "";
        $common = "";
        $iterDays = "";
        $empNumRes = "";
        $yearRes = "";
        $moRes = "";
        $dayRes = "";
        $cnt = 0; //15 cycle / 15 pipes
        foreach($result as $row){

            if ($empNumRes == ""){ //means first row, no assignment yet
                $empNumRes = $row->employee_no;
                $yearRes = $row->year;
                $moRes = $row->month;
                $dayRes = $row->day;
                //$cnt += 1;
            } 

            //15 cycle / 15 pipes
            if ($empNumRes == $row->employee_no && $yearRes == $row->year && 
                $moRes == $row->month && $dayRes == $row->day){ //group by employee no, year, month and day

                //another DAY-------------
                $common = $row->employee_no.'|'.$row->month.'/'.$row->day.'/'.substr($row->year, 2, 2); //once
                $iterDays = $iterDays.'|'.$row->hour_12.':'.$row->minute.':'.$row->seconds.' '.$row->meridiem; //iterative
                //another DAY-------------

            } else { //different ID number, date today
                //$content[] = $common.$iterDays; //save previous
                $content[] = $common.$iterDays.$this->pipes($common.$iterDays); //save previous //single row result, same emp num, year, mos, day
                
                //another DAY-------------
                $common = $row->employee_no.'|'.$row->month.'/'.$row->day.'/'.substr($row->year, 2, 2);
                $iterDays = '|'.$row->hour_12.':'.$row->minute.':'.$row->seconds.' '.$row->meridiem;
                //another DAY-------------

                //reset, because other day
                $empNumRes = $row->employee_no;
                $yearRes = $row->year;
                $moRes = $row->month;
                $dayRes = $row->day;
            }
            
            //---- add the last row ----//
            $cnt += 1;
            if ((count($result)-$cnt) == 0){
                $content[] = $common.$iterDays.$this->pipes($common.$iterDays); //save last row
            }

            /*
                +"employee_no": 2055648
                +"year": "2022"
                +"month": "06"
                +"day": "28"
                +"hour": "10"
                +"minute": "33"
                +"seconds": "34"
                +"fifth_place": "1"
                +"log_type_code": "0"
                +"filename_uploaded": "1658067063_attlog (6) (1).dat"

                10005197|11/05/18|06:42:11 AM|12:02:13 PM|12:02:29 PM|||||||||||
            */
        }

        //---- FORMATING ----//
        $text = "";
        foreach ($content as $r){
            if ($r != "") {
                $text = $text.$r."\n";
            }
        }

        // file name that will be used in the download
        $fileName = $employeeNo.'_'.$criteria['month'].$criteria['year'].'.txt';

        // use headers in order to generate the download
        $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            //'Content-Length' => sizeof($text)
        ];

        // make a response, with the content, a 200 response code and the headers
        return Response::make($text, 200, $headers);
    }
    //////////======== NOT USED???????? DIRECTLY FROM DTR_LOGS TABLE=================/////////

    //pipsConversion, savePipsVersion, updateDtrByIdNumber
    public function pipes($str){ //Completing the 15 pipes        
        $pipeCnt = substr_count($str, '|');
        $a = 1;
        $b = "";
        while( $a <= (15-$pipeCnt)){
            $b = $b.'|';
            $a++;
        }
        return $b;
    }

    public function generateDtrByYearMoPdf(Request $request){
        $criteria['year'] = $request['year'];
        $criteria['month'] = $request['month'];
        $result = $this->dtrLogsPips->GetLogsPipsByYearMo($criteria);
        //dd($result);
        $data = [
            //'title' => 'Welcome to ItSolutionStuff.com',
            'datetimegenerated' => Carbon::now('Asia/Manila'),
            'generated_by' => '20556408',
            'ye' => $request['year'],
            'mo' => date('F', mktime(0, 0, 0, $request['month'], 10)),
            'logs' => $result
        ];
        
        //$pdf = PDF::loadView('pdf-format', $data);
        //return $pdf->download('itsolutionstuff.pdf');  TO DOWNLOAD INSTANTLY
        
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="document.pdf"');
        // header('Content-Transfer-Encoding: binary');
        
        $html = view('pdf-dtr-format', $data)->render();
        return @\PDF::loadHTML($html, 'utf-8')->stream(); // to debug + add the follosing headers in controller ( TOP LEVEL )
    }

    public function generateDtrByYearMoOfficePdf(Request $request){
        //office
        // "pro_id_dtr" => "1"
        // "branchunit_id_dtr" => "1"
        // "lhiosection_id_dtr" => "2"
        $criteria['pro_id'] = $request['pro_id_dtr'];
        $criteria['branchunit_id'] = $request['branchunit_id_dtr'];
        $criteria['lhiosection_id'] = $request['lhiosection_id_dtr'];
        $criteria['year'] = $request['year'];
        $criteria['month'] = $request['month'];
        $result = $this->dtrLogsPips->GetLogsPipsByYearMoOffice($criteria);
        //dd($result);
        $data = [
            //'title' => 'Welcome to ItSolutionStuff.com',
            'datetimegenerated' => Carbon::now('Asia/Manila'),
            'generated_by' => '20556408',
            'ye' => $request['year'],
            'mo' => date('F', mktime(0, 0, 0, $request['month'], 10)),
            'logs' => $result
        ];
        
        //$pdf = PDF::loadView('pdf-format', $data);
        //return $pdf->download('itsolutionstuff.pdf');  TO DOWNLOAD INSTANTLY
        
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="document.pdf"');
        // header('Content-Transfer-Encoding: binary');
        
        $html = view('pdf-dtr-format', $data)->render();
        return @\PDF::loadHTML($html, 'utf-8')->stream(); // to debug + add the follosing headers in controller ( TOP LEVEL )
    }

    public function generateDtrByYearMoIdNumPdf(Request $request){
        $criteria['employee_no'] = $request['employee_no'];
        $criteria['year'] = $request['year'];
        $criteria['month'] = $request['month'];
        $result = $this->dtrLogsPips->GetLogsPipsByEmpYearMo($criteria);
        //dd($result);
        $data = [
            //'title' => 'Welcome to ItSolutionStuff.com',
            'datetimegenerated' => Carbon::now('Asia/Manila'),
            'generated_by' => '20556408',
            'ye' => $request['year'],
            'mo' => date('F', mktime(0, 0, 0, $request['month'], 10)),
            'logs' => $result
        ];
        
        //$pdf = PDF::loadView('pdf-format', $data);
        //return $pdf->download('itsolutionstuff.pdf');  TO DOWNLOAD INSTANTLY
        
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="document.pdf"');
        // header('Content-Transfer-Encoding: binary');
        
        $html = view('pdf-dtr-format', $data)->render();
        return @\PDF::loadHTML($html, 'utf-8')->stream(); // to debug + add the follosing headers in controller ( TOP LEVEL )
    }

    public function updateDtrByIdNumberForm(Request $request){
        $criteria['employee_no'] = $request['employee_no'];
        $criteria['year'] = $request['year'];
        $criteria['month'] = $request['month'];
        $result = $this->dtrLogsPips->GetLogsPipsByEmpYearMo($criteria);
        $data = [
            //'title' => 'Welcome to ItSolutionStuff.com',
            'datetimegenerated' => Carbon::now('Asia/Manila'),
            'generated_by' => '20556408',
            'ye' => $request['year'],
            'mo' => date('F', mktime(0, 0, 0, $request['month'], 10)),
            'logs' => $result
        ];
        return view('update-dtr', $data);
    }

            public function updateDtrByIdNumber(Request $request){
                //note:multiple time logs per cell are not allowed. Update per DAY 1 row with 6 column
                $user = '20556408';
                //return response()->json(dd($request));
                    /*
                    <script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\[\]\/\\])/g, idRx = 
                    /\bsf-dump-\d+-ref[012]\w+\b/, keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl', addEventListener = 
                    function (e, n, cb) { e.addEventListener(n, cb, false); }; refStyle.innerHTML = 'pre.sf-dump .sf-dump-compact, .sf-dump-str-collapse .
                    sf-dump-str-collapse, .sf-dump-str-expand .sf-dump-str-expand { display: none; }'; (doc.documentElement.firstElementChild || 
                    */

                //return response()->json($empNumber); //20556408
                
                //return response()->json($vdate);
                    /*
                        07/01/2022 Fri,07/02/2022 Sat,07/03/2022 Sun,07/04/2022 Mon,07/05/2022 Tue,07/06/2022 Wed,07/07/2022 Thu,
                        07/08/2022 Fri,07/09/2022 Sat,07/10/2022 Sun,07/11/2022 Mon,07/12/2022 Tue,07/13/2022 Wed,07/14/2022 Thu,
                        07/15/2022 Fri,07/16/2022 Sat,07/17/2022 Sun,07/18/2022 Mon,07/19/2022 Tue,07/20/2022 Wed,07/21/2022 Thu,
                        07/22/2022 Fri,07/23/2022 Sat,07/24/2022 Sun,07/25/2022 Mon,07/26/2022 Tue,07/27/2022 Wed,07/28/2022 Thu,
                        07/29/2022 Fri,07/30/2022 Sat,07/31/2022 Sun
                    */
                
                //return response()->json($vamin);
                    /*
                        ,06:18:42 AM,10:07:52 AM,09:07:52 AM,,,,,
                        01:00:52 AM,00:00:52 AM,,08:18:42 AM,,
                        08:18:42 AM,,,,10:08:06 AM 11:59:00 AM,,
                        09:08:06 AM 09:59:00 AM,,08:08:06 AM,,,,,,,,,
                    */

                //return print_r($request->startTime);

                $empNumber = trim($request->idnumber); //common
                $vdate = $request->vdate;
                $vamin = $request->vamin;
                $vamout = $request->vamout;
                $vpmin = $request->vpmin;
                $vpmout = $request->vpmout;
                $votin = $request->votin;
                $votout = $request->votout;

                $exist = false;
                $timeLogsNumbersOnlyFromDbPips = '';
                //return response()->json(count($vdate)); //result 31
                $withUpdate = false;
                for( $i = 0; $i < count($vdate); $i++){ //vdate and etc are same loop, just using the $vdate to loop
                    $withTimeLogs = false;
                    $withMultipleTimeLogs = false;

                    $mm = substr($vdate[$i], 0, 2); //common
                    $dd = substr($vdate[$i], 3, 2); //common
                    $yyyy = substr($vdate[$i], 6, 4); //common
                    $fullDate = substr($vdate[$i], 0, 6).substr($yyyy, 2, 2); //common, year last two digit only
                    //return response()->json($fullDate); //01 or 07/02/22, etc

                    //here it can be multiple logs, at the it doesn't allowed
                    $vaminVal = trim(preg_replace('/\s+/', ' ', $vamin[$i]));
                    $vamoutVal = trim(preg_replace('/\s+/', ' ', $vamout[$i]));
                    $vpminVal = trim(preg_replace('/\s+/', ' ', $vpmin[$i]));
                    $vpmoutVal = trim(preg_replace('/\s+/', ' ', $vpmout[$i]));
                    $votinVal = trim(preg_replace('/\s+/', ' ', $votin[$i]));
                    $votoutVal = trim(preg_replace('/\s+/', ' ', $votout[$i]));
//if($i==3){
   
                    if (strpos($vaminVal, ':') !== false){ //time
                        $amIn = $vaminVal;
                        $withTimeLogs = true;
                        if (substr_count($vaminVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $amIn = ''; } //object of blank

                    if (strpos($vamoutVal, ':') !== false){  //return response()->json(strpos($vamoutVal, ':'));
                        $amOut = $vamoutVal; 
                        $withTimeLogs = true;
                        if (substr_count($vamoutVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $amOut = ''; } 

                    if (strpos($vpminVal, ':') !== false){ 
                        $pmIn = $vpminVal;
                        $withTimeLogs = true;
                        if (substr_count($vpminVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $pmIn = ''; } 

                    if (strpos($vpmoutVal, ':') !== false){ 
                        $pmOut = $vpmoutVal;
                        $withTimeLogs = true;
                        if (substr_count($vpmoutVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $pmOut = ''; } 

                    if (strpos($votinVal, ':') !== false){ 
                        $otIn = $votinVal;
                        $withTimeLogs = true;
                        if (substr_count($votinVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $otIn = ''; } 

                    if (strpos($votoutVal, ':') !== false){ 
                        $otOut = $votoutVal;
                        $withTimeLogs = true;
                        if (substr_count($votoutVal, ':') >= 3){ $withMultipleTimeLogs = true; }
                    } else { $otOut = ''; } 

                    if ($withMultipleTimeLogs){
                        return response()->json("multiple");
                    }

                    //------check of IDNum,mm/dd/yyyy exist------//
                    //if ($i == 7){
                        $criteria['employee_no'] = $empNumber;
                        $criteria['year'] = $yyyy;
                        $criteria['month'] = $mm;
                        $criteria['day'] = $dd;                                 
                        //to check if Update or Insert and get the existing pips version for comparison to html table
                        $result = $this->dtrLogsPips->GetTimeLogsPipsVerByEmpYearMoDay($criteria);  //$result->time_logs   =  10008797|07/07/22|01:38:08 PM|01:38:19 PM||||||||||||   WITH SEC 
                        if($result){ $exist = true;
                        } else     { $exist = false; }

                        //with result from pips version
                        if (isset($result->time_logs)){
                            //$timeLogsNumbersOnlyFromDb = $this->removeSpecialCharsSpaceSeconds($result->time_logs); //            1000879707072201380138   second and special chars removed  *FOR COMPARISON TO TABLE
                            
                            //$result->time_logs; //30697818|07/01/22|12:07:52 PM|02:08:06 PM|04:10:14 PM|05:10:19 PM||||||||||
                            $timeLogsNumbersOnlyFromDbPips = $this->removeSpecialCharsSpace($result->time_logs); //30697818070122120752020806041014051019
                            //return response()->json($timeLogsNumbersOnlyFromDbPips);  //30697818070122120752020806041014051019
                //30697818070122010052020806020806041014051019
                  //30697818070122010052020806020806041014
                        }

                        //----SET from Table----//
                        $tblTimeLogs = $empNumber.'|'.$fullDate.'|';
                        $tblTimeLogsFromTbleDtrVersion = $tblTimeLogs.$amIn.'|'.$amOut.'|'.$pmIn.'|'.$pmOut.'|'.$otIn.'|'.$otOut.'||||||||';
                        //$tblTimeLogsWithSec = $tblTimeLogs;
                        if ($amIn != '') { 
                            $tblTimeLogs .= $amIn.'|'; }

                        if ($amOut != '') { 
                            $tblTimeLogs .= $amOut.'|'; }

                        if ($pmIn != '') { 
                            $tblTimeLogs .= $pmIn.'|'; }

                        if ($pmOut != '') { 
                            $tblTimeLogs .= $pmOut.'|'; }

                        if ($otIn != '') { 
                            $tblTimeLogs .= $otIn.'|'; }

                        if ($otOut != '') { 
                            $tblTimeLogs .= $otOut.'|'; }

                        $tblTimeLogsFromTblePipsVersion = $tblTimeLogs.$this->pipes($tblTimeLogs);   //30697818|07/01/22|12:07:52 PM|02:08:06 PM|05:10:19 PM|||||||||||     
                        //return response()->json($tblTimeLogsFromTblePipsVersion); //30697818|07/01/22|12:07:52 PM|02:08:06 PM|05:10:19 PM|||||||||||
                        $timeLogsNumbersOnlyFromTbl = $this->removeSpecialCharsSpace($tblTimeLogsFromTblePipsVersion); //  30697818070122120752020806041014051019   *FOR COMPARISON TO EXISTING PIPS DB
                        //return response()->json($timeLogsNumbersOnlyFromTbl); //30697818070122120752020806041014051019

                        //------convert to pips version ------//
                        //$tblTimeLogsFinalWithSec = $tblTimeLogsWithSec.$this->pipes($tblTimeLogsWithSec); //10008797|07/07/22|01:38:00 PM|01:38:00 PM|||||||||||| WITH SEC BUT 00  *SAVE IN PIPS DB
                        //$timeLogsNumbersOnlyFromTblWithSec = $this->removeSpecialCharsSpace($tblTimeLogsFinalWithSec); //  10008797070722013800013800         WITH SEC BUT 00  
                    
                        // 1_ 10008797070822 01 20 01 22 01 23 01 24
                        //  _ 10008797070822 01 20 01 23 01 24

                        //------Insert, Update, delete------//            
                        // return response()->json($exist.'_'.$timeLogsNumbersOnlyFromDb.'_'.$timeLogsNumbersOnlyFromTbl);
                        //return response()->json($tblTimeLogsFinalWithSec);  10008797|07/08/22|01:20:00 PM|01:23:00 01:24:00 PM||||||||||||
                        //return response()->json($result->dtr_log_pips_id);

                        // 10008797|07/08/22|01:20:00 PM|01:22:00 PM|01:23:00 PM|01:24:00 PM||||||||||
                       
                        if ($exist && $timeLogsNumbersOnlyFromDbPips != $timeLogsNumbersOnlyFromTbl){ //Exixst in DB and prev & Current time is not the save, therefore update
                           DB::table('dtr_logs_pips')
                                ->where('dtr_log_pips_id', $result->dtr_log_pips_id)
                                ->update([
                                    'time_logs' => $tblTimeLogsFromTblePipsVersion,
                                    'time_logs_dtr' => $tblTimeLogsFromTbleDtrVersion,
                                    'modified_by' => $user,
                                    'updated_at' => Carbon::now('Asia/Manila')
                                ]);
                                //return response()->json($tblTimeLogsFromTblePipsVersion);
                            $withUpdate = true;
                        } elseif (!$exist && $withTimeLogs){ //not exist in DB and time logs are not blank, insert new
                            DB::table('dtr_logs_pips')->insert([
                                'employee_no' => $empNumber,
                                'year' => $yyyy,
                                'month' => $mm,
                                'day' => $dd,
                                'time_logs' => $tblTimeLogsFromTblePipsVersion,
                                'time_logs_dtr' => $tblTimeLogsFromTbleDtrVersion,
                                'uploaded_by' => $user,
                                'created_at' => Carbon::now('Asia/Manila')
                            ]);
                            $withUpdate = true;
                            //$data = print_r($votin);
                            //return response()->json($exist.'_'.$withTimeLogs);
                        }
                        //return response()->json($r);
                    //}
                    
                    
            
//}
                    //if exist and same logs = skip
                    //if not exist and $withTimeLogs is false/blank = skip

                    //if exist and updated = update time_logs column
                    //if not exist and $withTimeLogs is true/with value = insert/update, all

                    //if exist and $withTimeLogs is false/blank = delete the row

                    /////return to same page, refresh 
                }

                //$data = print_r($criteria);
                //$data = print_r($result);
                //return response()->json($data);
                //return response()->json($result->time_logs);
                //return response()->json($timeLogsNumbersOnlyFromTblWithSec);

                //$data = print_r($votin);
                //return response()->json($i);

                // $data = print_r($votout);
                // return response()->json($data);

                //return response()->json(count($vdate));
                //return response()->json($vdate[30]);
                return response()->json($withUpdate);
            }
            // ayaw mag update
// sa pips generation remove ung empno at date lang
    //!!!!!!!the side effect of this, changes from AM to PM or vice versa from tha table will not take effect!!!!!!!!!!
    public function removeSpecialCharsSpace($str){ //retain only digits
        return preg_replace('/[^0-9.]+/', '', $str);
    }

    //For pips version from DB use, since it saves seconds but not in table
    // public function removeSpecialCharsSpaceSeconds($str){ //retain Hr, Min, Meridiem digits
    //     //10008797|07/07/22|01:38:08 PM|01:38:19 PM||||||||||||   convert to    1000879707072201380138    seconds removed
    //     $logsArr = explode("|", $str);
    //     $rawStr = '';
    //     $cnt = 0;
    //     foreach ($logsArr as $time){
    //         if ($cnt == 0 || $cnt == 1){ //employee number and date
    //             $rawStr .= $time;
    //         } else {
    //             if (strpos($time, ':') !== false){
    //                 $rawStr .= substr($time, 0, 5); //get hr to min only
    //             }
    //         }
    //         $cnt++;
    //     }
    //     return $this->removeSpecialCharsSpace($rawStr);

    //     //eturn preg_replace('/[^0-9.]+/', '', $str);


    //     // $item = explode('|', $r);
    //     //             //$text = $text.$r."\n";
                    
    //     //             $details['employee_no'] = $item[0];
    //     //             $details['year'] = '20'.substr($item[1], 6, 2);
    //     //             $details['month'] = substr($item[1], 0, 2);
    //     //             $details['day'] = substr($item[1], 3, 2);
    //     //             $details['time_logs'] = $r;
    //     //             $details['uploaded_by'] = $employeeNo;
    //     //             $details['created_at'] = Carbon::now('Asia/Manila');

    // }

}
