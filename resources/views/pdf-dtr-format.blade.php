<!DOCTYPE html>
<html>
    <head>
        <title>{{ $mo.' '.$ye}} DTR</title>

        {{-- DOMPDF page break --}}
        <style>
            .page-break {
                page-break-after: always;
            }
            
        </style>

        {{-- Table style --}}
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size:13px;
            }
            
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 1px;
                font-size:13px;
            }
            
            tr:nth-child(even) {
                background-color: #dddddd;
                font-size:13px;
            }
        </style>

        <style>
            #footer	{
                position: absolute;
                width: 100%;
                height: 0px;
                text-align: right;
                bottom: 0;
                /* background-image: url(images/footerbackground.fw.png); */
            }

            #footer p {
                position: absolute;
                width: 100%;
                height: 0px;
                text-align: right;
                bottom: 0;
                height: 0px;
            }
        </style>

        <style>
            body{ padding: 1% 3%; color: rgb(119, 119, 119); }
            h1{ color:#333 }
        </style>
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/1.0.1/pure-min.css"> --}}
        <link href="{{ asset('assets/css/pure-min.css') }}" rel="stylesheet">

    </head>
    <body>
        
        @php

            //dd($logs);
            /*
            #items: array:3 [▼
            0 => {#299 ▼
                +"employee_no": 20556408
                +"year": "2022"
                +"month": "07"
                +"day": "25"
                +"time_logs": "20556408|07/25/22|08:33:34 AM|12:21:14 PM|12:22:44 PM|05:43:22 PM|05:56:31 PM|08:58:11 PM||||||||"
            }
            1 => {#302 ▼
                +"employee_no": 20556408
                +"year": "2022"
                +"month": "07"
                +"day": "26"
                +"time_logs": "20556408|07/26/22|08:34:35 AM|12:22:15 PM|12:23:45 PM|05:44:23 PM|05:57:32 PM|08:59:12 PM||||||||"
            }
            2 => {#303 ▼
                +"employee_no": 89898989
                +"year": "2022"
                +"month": "07"
                +"day": "26"
                +"time_logs": "89898989|07/26/22|08:31:36 AM|12:23:46 PM|12:24:16 PM|05:49:24 PM|05:58:33 PM|08:57:15 PM||||||||"
            }
            */
        
            //$signatoryLine = "<hr style='height:1px; width:40%; border-width:0; color:black; background-color:black; padding-bottom: 5px;'>";

            $supervisorFooter = "<SPAN STYLE='text-decoration:overline; font-weight:bold'>Signature of Immediate Supervisor</SPAN>";
            $tableFooter = "</tbody></table>";
            $tableHeader = "<table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style='font-weight: bold; text-align:center;' colspan='2'>A.M.</th>
                                        <th style='font-weight: bold; text-align:center;' colspan='2'>P.M.</th>
                                        <th style='font-weight: bold; text-align:center;' colspan='2'>Weekdays OT</th>
                                    </tr>
                                    <tr>
                                        <th style='font-weight: bold; text-align:center; padding-right:4em'>Day</th>
                                        <th style='font-weight: bold; text-align:center;'>Log In</th>
                                        <th style='font-weight: bold; text-align:center;'>Break Out</th>
                                        <th style='font-weight: bold; text-align:center;'>Break In</th>
                                        <th style='font-weight: bold; text-align:center;'>Log Out</th>
                                        <th style='font-weight: bold; text-align:center;'>Log In</th>
                                        <th style='font-weight: bold; text-align:center;'>Log Out</th>
                                    </tr>
                                </thead>
                                <tbody>";
            $footer1 = "<p style='font-size:13px;'>I certify on my honor that the above is a true and correct report of the hours worked performed, record of which was made daily at the time of arrival and departure from office.</p>";
            $footer2 = "<p style='font-size:13px;'>Verified as to the prescribed office hours.</p>";
            // $finalFooter = "<div id='footer'>
            //                     <p><a href='contactus.html'>Contact Us</a> | 
            //                         <a href='copyright.html'>Copyright</a> | 
            //                         <a href='feedback.html'>Feedback</a> | 
            //                         <a href='brokenlink.html'>Report a broken link</a>
            //                     </p>
            //                 </div>";
            $finalFooter = "<div id='footer'>
                                <p style='font-size:10px;'>Date and Time Generated (By): ".$datetimegenerated." (".$generated_by.")</p>
                            </div>";
            $tableRow = '';
            $employeeNo = '';
            $empNumRes = '';
            $dayRes = '';
            //$content = array();

            $resCount = count($logs);
            $loopCnt = 0;

            $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16= '';
            $d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d31 = ''; 
            //dd($logs);
            /*
            #items: array:6 [▼
                    0 => {#298 ▼
                    +"employee_no": 10009697
                    +"year": "2022"
                    +"month": "07"
                    +"day": "26"
                    +"time_logs": "10009697|07/26/22|03:24:13 PM|07:12:50 PM||||||||||||"
                    }
                    1 => {#302 ▼
                    +"employee_no": 10083399
                    +"year": "2022"
                    +"month": "07"
                    +"day": "16"
                    +"time_logs": "10083399|07/16/22|02:11:23 PM|||||||||||||"
                    }
                    2 => {#303 ▼
                    +"employee_no": 10083399
                    +"year": "2022"
                    +"month": "07"
                    +"day": "18"
                    +"time_logs": "10083399|07/18/22|02:09:09 PM|02:09:20 PM|05:31:16 PM|||||||||||"
                    }
                    3 => {#299 ▼
                    +"employee_no": 10083399
                    +"year": "2022"
                    +"month": "07"
                    +"day": "19"
                    +"time_logs": "10083399|07/19/22|05:46:09 AM|||||||||||||"
                    }
                    4 => {#300 ▼
                    +"employee_no": 10083399
                    +"year": "2022"
                    +"month": "07"
                    +"day": "21"
                    +"time_logs": "10083399|07/21/22|04:55:53 AM|02:06:04 PM|02:06:11 PM|05:31:04 PM||||||||||"
                    }
                    5 => {#304 ▼
                    +"employee_no": 10083399
                    +"year": "2022"
                    +"month": "07"
                    +"day": "22"
                    +"time_logs": "10083399|07/22/22|05:50:47 AM|||||||||||||"



                    +"title_pro": "PRO NCR"
                    +"title_braunit": "NCR SOUTH BRANCH"
                    +"title_seclhio": "IT"
                    +"title_exp": null
            */
            $rr = "";
            $prevEmpAndIdNo = "";
            //dd($logs);
            foreach ($logs as $item) {
                $loopCnt++;
            //if($loopCnt == 8){
                //dd($item);
                    /*
                    +"employee_no": 20556408
                    +"year": "2022"
                    +"month": "07"
                    +"day": "25"
                    +"time_logs": "20556408|07/25/22|08:33:34 AM|12:21:14 PM|12:22:44 PM|05:43:22 PM|05:56:31 PM|08:58:11 PM||||||||"
                    +"time_logs_dtr": "20556408|07/02/22|06:18:42 AM|||||||||||||"
                    */

                //time_logs_dtr COLUMN for DTR VERSION. Get 8 Columns only, EmpID,Day,6 time logs    
                $time_logs = explode('|', $item->time_logs_dtr); //itemized
                //dd($time_logs);
                /* resutl dd
                    0 => "20556408"
                    1 => "07/02/22"
                    2 => "06:18:42 AM"
                    3 => ""
                    4 => ""
                    5 => ""
                    6 => ""
                    7 => ""
                    8 => ""
                    9 => ""
                    10 => ""
                    11 => ""
                    12 => ""
                    13 => ""
                    14 => ""
                    15 => ""
                */
                $timeLogsComplete = $item->time_logs_dtr;
                    //count existence of AM and PM in a row with 15 pipes
                    $amCount = substr_count($timeLogsComplete, 'AM'); 
                    $pmCount = substr_count($timeLogsComplete, 'PM'); 
                
                $employeeNo = $time_logs[0];
                //$emp[] = $item->employee_no;

                $yearL = '20'.substr($time_logs[1], 6, 2);
                $monthL = substr($time_logs[1], 0, 2);
                $dayL = substr($time_logs[1], 3, 2);

                $monthFullName = date('F', mktime(0, 0, 0, $monthL, 10));
                $numOfDays = cal_days_in_month(CAL_GREGORIAN, $monthL, $yearL);

                $dtrFor = "<b style='color:maroon;font-size:20px;'> Daily Time Record for ".$monthFullName." 01 to ".$numOfDays." ".$yearL."</b><br />";
                
                if (isset($item->suffix_name) && $item->suffix_name != ''){
                    $empAndIdNo = $item->last_name.', '.$item->first_name.' '.$item->suffix_name.'. '.$item->middle_name." (".$item->employee_no.")";  
                } else {
                    $empAndIdNo = $item->last_name.', '.$item->first_name.' '.$item->middle_name." (".$item->employee_no.")";  
                }
                
                
                $pro = $item->title_pro;  
                $branchunit = $item->title_braunit.', ';

                if (isset($item->title_exp) && $item->title_exp != '') { 
                    $sectionlhios = $item->title_seclhio.', ';
                    $express = $item->title_exp;
                } else {
                    $sectionlhios = $item->title_seclhio; 
                    $express = '';
                }  
                        
                //dd($time_logs);
                    /*
                    0 => "20556408"
                    1 => "07/25/22"
                    2 => "08:33:34 AM"
                    3 => "12:21:14 PM"
                    4 => "12:22:44 PM"
                    5 => "05:43:22 PM"
                    6 => "05:56:31 PM"
                    7 => "08:58:11 PM"
                    8 => ""
                    9 => ""
                    10 => ""
                    11 => ""
                    12 => ""
                    13 => ""
                    14 => ""
                    15 => ""
                    */


                $cnt = 0;     
                // $amIn = '';
                // $amOut = '';
                // $pmIn = '';
                // $pmOut = '';
                // $otIn = '';
                // $otOut = '';  

                //Day Column
                $nameOfDay = date('D', strtotime($dayL.'-'.$monthL.'-'.$yearL));
                    
                        //per employee no, year, mo, day (already group per row)
                        //======START Set TIME per employee, per month, and per day =====//
                        
                        //dd($time_logs);
//                     array:16 [▼
//   0 => "10025298"
//   1 => "02/04/20"
//   2 => "11:14:39 AM"
//   3 => "12:14:39 PM"
//   4 => "12:15:01 PM"
//   5 => "05:58:46 PM"
//   6 => ""
//   7 => ""
//   8 => ""
//   9 => ""
//   10 => ""
//   11 => ""
//   12 => ""
//   13 => ""
//   14 => ""
//   15 => ""
// ]
                        //dd($time_logs);
                        //$cc[] = $time_logs;
                        /*
                            Array ( 
                                [0] => Array ( [0] => 10009697 [1] => 07/26/22 [2] => 03:24:13 PM [3] => 07:12:50 PM [4] => [5] => [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) 
                                [1] => Array ( [0] => 10083399 [1] => 07/18/22 [2] => 02:09:09 PM [3] => 02:09:20 PM [4] => 05:31:16 PM [5] => [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) 
                                [2] => Array ( [0] => 10083399 [1] => 07/19/22 [2] => 05:46:09 AM [3] => [4] => [5] => [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) 
                                [3] => Array ( [0] => 10083399 [1] => 07/21/22 [2] => 04:55:53 AM [3] => 02:06:04 PM [4] => 02:06:11 PM [5] => 05:31:04 PM [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) 
                                [4] => Array ( [0] => 10083399 [1] => 07/22/22 [2] => 05:50:47 AM [3] => [4] => [5] => [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) 
                                [5] => Array ( [0] => 10083399 [1] => 07/16/22 [2] => 02:11:23 PM [3] => [4] => [5] => [6] => [7] => [8] => [9] => [10] => [11] => [12] => [13] => [14] => [15] => ) )
                        */
                        //$rr = 0;
                        
                        $empNoLog = $time_logs[0];
                        $dateLog = $time_logs[1];

                        //------  Assuming AM IN are all AM, AM OUT are either AM or PM, and the rest column are PM. ------//
                        $amIn = $time_logs[2];
                            if ($amIn != ""){   //Removing SECONDS and redisplay
                                $amInArr = explode(" AM", $time_logs[2]);
                                $amIn = "";
                                foreach($amInArr as $ai){
                                    if (trim($ai) != ""){
                                        $amIn .= substr(trim($ai), 0, 5).' AM '; 
                                    }
                                } 
                            }

                        $amOut = $time_logs[3];
                            if ($amOut != ""){
                                $amOut = "";
                                if(strpos($time_logs[3], 'AM') == true){
                                    $amOutArr = explode(" AM", $time_logs[3]);
                                    foreach($amOutArr as $ao){
                                        if (trim($ao) != ""){
                                            $amOut .= substr(trim($ao), 0, 5).' AM '; 
                                        }
                                    }
                                } else {
                                    $amOutArr = explode(" PM", $time_logs[3]);
                                    foreach($amOutArr as $ao){
                                        if (trim($ao) != ""){
                                            $amOut .= substr(trim($ao), 0, 5).' PM '; 
                                        }
                                    } 
                                }
                            }

                        $pmIn = $time_logs[4];
                            if ($pmIn != ""){   //Removing SECONDS and redisplay
                                $pmInArr = explode(" PM", $time_logs[4]);
                                $pmIn = "";
                                foreach($pmInArr as $pi){
                                    if (trim($pi) != ""){
                                        $pmIn .= substr(trim($pi), 0, 5).' PM '; 
                                    }
                                } 
                            }

                        $pmOut = $time_logs[5];
                            if ($pmOut != ""){   //Removing SECONDS and redisplay
                                $pmOutArr = explode(" PM", $time_logs[5]);
                                $pmOut = "";
                                foreach($pmOutArr as $po){
                                    if (trim($po) != ""){
                                        $pmOut .= substr(trim($po), 0, 5).' PM '; 
                                    }
                                } 
                            }


                        $otIn = $time_logs[6];
                            if ($otIn != ""){   //Removing SECONDS and redisplay
                                $otInArr = explode(" PM", $time_logs[6]);
                                $otIn = "";
                                foreach($otInArr as $oi){
                                    if (trim($oi) != ""){
                                        $otIn .= substr(trim($oi), 0, 5).' PM '; 
                                    }
                                } 
                            }
                            
                        $otOut = $time_logs[7];                        
                            //if ($loopCnt == 4) {
                                //dd($otOut);
                                //dd(strpos($time_logs[7], 'PM'));
                                if ($otOut != ""){
                                    $otOutArr = explode(" PM", $time_logs[7]);
                                    //dd($otOutArr);
                                    $otOut = "";
                                    foreach($otOutArr as $oo){
                                        //dd($oo);
                                        if (trim($oo) != ""){
                                            $otOut .= substr(trim($oo), 0, 5).' PM '; 
                                            //dd($otOut);
                                        }
                                    }
                                }
                            //}
                        

                        // foreach ($time_logs as $row){
                        //     //dd($time_logs); //Exploded
                        //     /* result of d($time_logs);
                        //         0 => "20556408"
                        //         1 => "07/02/22"
                        //         2 => "06:18:42 AM"
                        //         3 => ""
                        //         4 => ""
                        //         5 => ""
                        //         6 => ""
                        //         7 => ""
                        //         8 => ""
                        //         9 => ""
                        //         10 => ""
                        //         11 => ""
                        //         12 => ""
                        //         13 => ""
                        //         14 => ""
                        //         15 => ""
                        //     */
                        //     //dd($row); //"20556408" 1st loop ...  07/02/22 2nd loop  and so on..
                            
                            
                        //     $cnt++;
                        //     if ($cnt >= 3){ //starts in row 3 (bypass employee no and day). 3rd row onwards are time logs
                        //         //dd($row);

                        //         // dito na, per column na dapat
                        //         $timeL = substr($row, 0, 5);
                        //         $hourL = substr($row, 0, 2);
                        //         $meridiem = substr($row, 9, 2);
                        //         //dd($timeL.'-'.$hourL.'-'.$meridiem);
                                
                        //         if ($timeL != ''){ //except blank field or the ||||..
                                    
                        //             //1st column (AM IN)
                        //             if ($hourL <= 11 && $meridiem =='AM'){
                        //                 $amIn .= $timeL.' '; //can be multiple login in AM
                        //             } elseif ($amCount <= 0){
                        //                 $amIn = '';
                        //             }

                        //             //2nd column (AM OUT)
                        //             if ($hourL == 12 && $meridiem =='PM'){
                        //                 if ($amOut == ''){
                        //                     $amOut = $timeL; //AM out once. 2nd column (AM OUT)                                            
                        //                 } elseif ($amOut != ''){ //for PM In, 3rd column (PM IN)
                        //                     $pmIn .= $timeL.' '; //can be multiple login in PM
                        //                 }
                        //             } elseif ($hourL == 12 && $meridiem == 'PM' && $pmCount <= 0){
                        //                 $amOut = '';
                        //                 $pmIn = '';
                        //             }

                        //             //4th column
                        //             if ($hourL <= 11 && $meridiem =='PM'){
                        //                 if ($pmOut == ''){
                        //                     $pmOut = $timeL; //PM out once. 4th column (PM OUT)                                           
                        //                 } elseif ($pmOut != '' && $otIn == ''){ //OT PM IN once. 5th column          
                        //                     $otIn = $timeL; 
                        //                 } elseif ($pmOut != '' && $otIn != ''){ //OT PM IN once. 5th column          
                        //                     $otOut .= $timeL.' '; //can be multiple OT OUT (6th Column)
                        //                 } 
                        //             } elseif ($hourL <= 11 && $meridiem =='PM' && $pmCount <= 0){
                        //                 $pmOut = '';
                        //                 $otIn = '';
                        //                 $otOut = '';  
                        //             }
                        //         }
                        //     }
                        // }
                        //======END Set TIME per employee, per month, and per day =====//
                        //RESULT AFTER LOOP above (1 or multiple employee. Per day per employee), dd($amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut); //"===03:24=07:12="
                        //dd($amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut); 

                        //======set=====//
                        if ($empNumRes == ""){ //means first row, no assignment yet and need to assign
                            $empNumRes = $employeeNo;
                            //$dayRes = $dayL;
                            echo "<div style='text-align:center'><p style='font-weight:bold; font-size:18px; '>".$pro."</p></div>";
                            echo $dtrFor;
                            echo "<b>Employee:</b> ".Str::upper($empAndIdNo)."<br />";  
                            echo "<b>Office:</b> ".$branchunit.$sectionlhios.$express."<br /><br />";  
                            echo $tableHeader;

                            $prevEmpAndIdNo = $empAndIdNo;
                        } 


                        $tableRow = '';
                        //===03:24=07:12="  of 1 emp of 1 day only.
                        if ($empNumRes == $employeeNo){ //group by employee no //and day  && $dayRes == $dayL
                            //if ($employeeNo=='10083399'){
                                //dd($amIn);
                                
                            //}
                            // if ($amOut=='04:55 '){
                            //     dd($employeeNo);
                            // }
                            
                            //$dayL
                            //==================  AM LOGIN 1st Column, PM Breakin 3rd Column, and Weekdays OT Logout ARE the possible multiple. ==========////
                            $tableRow .= '<tr>';
                                //common employee and date
                                $tableRow .= "<td style=' text-align:left;'>".
                                    $monthL.'/'.$dayL.'/'.$yearL.' '.$nameOfDay."</td>";
                                    
                                if ($amIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($amIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($amOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($amOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($pmIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($pmIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($pmOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($pmOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($otIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($otIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($otOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($otOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }
                            $tableRow .= '</tr>';
                            //dd($dayL);
                            
                                //set 1 to 31 days
                                if ($dayL == '01') { $d1 = $tableRow; }
                                elseif ($d1 == ''){
                                    $d1 .= "<tr><td style=' text-align:left;'>"; 
                                    $d1 .= $monthL."/01/".$yearL." ";
                                    $d1 .= date('D', strtotime('01'.'-'.$monthL.'-'.$yearL));
                                    $d1 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                                
                                if ($dayL == '02') { $d2 = $tableRow; }
                                elseif ($d2 == ''){
                                    $d2 .= "<tr><td style=' text-align:left;'>"; 
                                    $d2 .= $monthL."/02/".$yearL." ";
                                    $d2 .= date('D', strtotime('02'.'-'.$monthL.'-'.$yearL));
                                    $d2 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '03') { $d3 = $tableRow; }
                                elseif ($d3 == ''){
                                    $d3 .= "<tr><td style=' text-align:left;'>"; 
                                    $d3 .= $monthL."/03/".$yearL." ";
                                    $d3 .= date('D', strtotime('03'.'-'.$monthL.'-'.$yearL));
                                    $d3 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '04') { $d4 = $tableRow; }
                                elseif ($d4 == ''){
                                    $d4 .= "<tr><td style=' text-align:left;'>"; 
                                    $d4 .= $monthL."/04/".$yearL." ";
                                    $d4 .= date('D', strtotime('04'.'-'.$monthL.'-'.$yearL));
                                    $d4 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                            
                                if ($dayL == '05') { $d5 = $tableRow; }
                                elseif ($d5 == ''){
                                    $d5 .= "<tr><td style=' text-align:left;'>"; 
                                    $d5 .= $monthL."/05/".$yearL." ";
                                    $d5 .= date('D', strtotime('05'.'-'.$monthL.'-'.$yearL));
                                    $d5 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '06') { $d6 = $tableRow; }
                                elseif ($d6 == ''){
                                    $d6 .= "<tr><td style=' text-align:left;'>"; 
                                    $d6 .= $monthL."/06/".$yearL." ";
                                    $d6 .= date('D', strtotime('06'.'-'.$monthL.'-'.$yearL));
                                    $d6 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '07') { $d7 = $tableRow; }
                                elseif ($d7 == ''){
                                    $d7 .= "<tr><td style=' text-align:left;'>"; 
                                    $d7 .= $monthL."/07/".$yearL." ";
                                    $d7 .= date('D', strtotime('07'.'-'.$monthL.'-'.$yearL));
                                    $d7 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '08') { $d8 = $tableRow; }
                                elseif ($d8 == ''){
                                    $d8 .= "<tr><td style=' text-align:left;'>"; 
                                    $d8 .= $monthL."/08/".$yearL." ";
                                    $d8 .= date('D', strtotime('08'.'-'.$monthL.'-'.$yearL));
                                    $d8 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '09') { $d9 = $tableRow; }
                                elseif ($d9 == ''){
                                    $d9 .= "<tr><td style=' text-align:left;'>"; 
                                    $d9 .= $monthL."/09/".$yearL." ";
                                    $d9 .= date('D', strtotime('09'.'-'.$monthL.'-'.$yearL));
                                    $d9 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '10') { $d10 = $tableRow; }
                                elseif ($d10 == ''){
                                    $d10 .= "<tr><td style=' text-align:left;'>"; 
                                    $d10 .= $monthL."/10/".$yearL." ";
                                    $d10 .= date('D', strtotime('10'.'-'.$monthL.'-'.$yearL));
                                    $d10 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '11') { $d11 = $tableRow; }
                                elseif ($d11 == ''){
                                    $d11 .= "<tr><td style=' text-align:left;'>"; 
                                    $d11 .= $monthL."/11/".$yearL." ";
                                    $d11 .= date('D', strtotime('11'.'-'.$monthL.'-'.$yearL));
                                    $d11 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '12') { $d12 = $tableRow; }
                                elseif ($d12 == ''){
                                    $d12 .= "<tr><td style=' text-align:left;'>"; 
                                    $d12 .= $monthL."/12/".$yearL." ";
                                    $d12 .= date('D', strtotime('12'.'-'.$monthL.'-'.$yearL));
                                    $d12 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '13') { $d13 = $tableRow; }
                                elseif ($d13 == ''){
                                    $d13 .= "<tr><td style=' text-align:left;'>"; 
                                    $d13 .= $monthL."/13/".$yearL." ";
                                    $d13 .= date('D', strtotime('13'.'-'.$monthL.'-'.$yearL));
                                    $d13 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '14') { $d14 = $tableRow; }
                                elseif ($d14 == ''){
                                    $d14 .= "<tr><td style=' text-align:left;'>"; 
                                    $d14 .= $monthL."/14/".$yearL." ";
                                    $d14 .= date('D', strtotime('14'.'-'.$monthL.'-'.$yearL));
                                    $d14 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '15') { $d15 = $tableRow; }
                                elseif ($d15 == ''){
                                    $d15 .= "<tr><td style=' text-align:left;'>"; 
                                    $d15 .= $monthL."/15/".$yearL." ";
                                    $d15 .= date('D', strtotime('15'.'-'.$monthL.'-'.$yearL));
                                    $d15 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '16') { $d16 = $tableRow; }
                                elseif ($d16 == ''){
                                    $d16 .= "<tr><td style=' text-align:left;'>"; 
                                    $d16 .= $monthL."/16/".$yearL." ";
                                    $d16 .= date('D', strtotime('16'.'-'.$monthL.'-'.$yearL));
                                    $d16 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '17') { $d17 = $tableRow; }
                                elseif ($d17 == ''){
                                    $d17 .= "<tr><td style=' text-align:left;'>"; 
                                    $d17 .= $monthL."/17/".$yearL." ";
                                    $d17 .= date('D', strtotime('17'.'-'.$monthL.'-'.$yearL));
                                    $d17 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '18') { $d18 = $tableRow; }
                                elseif ($d18 == ''){
                                    $d18 .= "<tr><td style=' text-align:left;'>"; 
                                    $d18 .= $monthL."/18/".$yearL." ";
                                    $d18 .= date('D', strtotime('18'.'-'.$monthL.'-'.$yearL));
                                    $d18 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '19') { $d19 = $tableRow; }
                                elseif ($d19 == ''){
                                    $d19 .= "<tr><td style=' text-align:left;'>"; 
                                    $d19 .= $monthL."/19/".$yearL." ";
                                    $d19 .= date('D', strtotime('19'.'-'.$monthL.'-'.$yearL));
                                    $d19 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '20') { $d20 = $tableRow; }
                                elseif ($d20 == ''){
                                    $d20 .= "<tr><td style=' text-align:left;'>"; 
                                    $d20 .= $monthL."/20/".$yearL." ";
                                    $d20 .= date('D', strtotime('20'.'-'.$monthL.'-'.$yearL));
                                    $d20 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '21') { $d21 = $tableRow; }
                                elseif ($d21 == ''){
                                    $d21 .= "<tr><td style=' text-align:left;'>"; 
                                    $d21 .= $monthL."/21/".$yearL." ";
                                    $d21 .= date('D', strtotime('21'.'-'.$monthL.'-'.$yearL));
                                    $d21 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '22') { $d22 = $tableRow; }
                                elseif ($d22 == ''){
                                    $d22 .= "<tr><td style=' text-align:left;'>"; 
                                    $d22 .= $monthL."/22/".$yearL." ";
                                    $d22 .= date('D', strtotime('22'.'-'.$monthL.'-'.$yearL));
                                    $d22 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '23') { $d23 = $tableRow; }
                                elseif ($d23 == ''){
                                    $d23 .= "<tr><td style=' text-align:left;'>"; 
                                    $d23 .= $monthL."/23/".$yearL." ";
                                    $d23 .= date('D', strtotime('23'.'-'.$monthL.'-'.$yearL));
                                    $d23 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '24') { $d24 = $tableRow; }
                                elseif ($d24 == ''){
                                    $d24 .= "<tr><td style=' text-align:left;'>"; 
                                    $d24 .= $monthL."/24/".$yearL." ";
                                    $d24 .= date('D', strtotime('24'.'-'.$monthL.'-'.$yearL));
                                    $d24 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '25') { $d25 = $tableRow; }
                                elseif ($d25 == ''){
                                    $d25 .= "<tr><td style=' text-align:left;'>"; 
                                    $d25 .= $monthL."/25/".$yearL." ";
                                    $d25 .= date('D', strtotime('25'.'-'.$monthL.'-'.$yearL));
                                    $d25 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '26') { $d26 = $tableRow; }
                                elseif ($d26 == ''){
                                    $d26 .= "<tr><td style=' text-align:left;'>"; 
                                    $d26 .= $monthL."/26/".$yearL." ";
                                    $d26 .= date('D', strtotime('26'.'-'.$monthL.'-'.$yearL));
                                    $d26 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                } 
                                
                                if ($dayL == '27') { $d27 = $tableRow; }
                                elseif ($d27 == ''){
                                    $d27 .= "<tr><td style=' text-align:left;'>"; 
                                    $d27 .= $monthL."/27/".$yearL." ";
                                    $d27 .= date('D', strtotime('27'.'-'.$monthL.'-'.$yearL));
                                    $d27 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                                
                                if ($dayL == '28') { $d28 = $tableRow; }
                                elseif ($d28 == ''){
                                    $d28 .= "<tr><td style=' text-align:left;'>"; 
                                    $d28 .= $monthL."/28/".$yearL." ";
                                    $d28 .= date('D', strtotime('28'.'-'.$monthL.'-'.$yearL));
                                    $d28 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '29') { $d29 = $tableRow; }
                                elseif ($d29 == ''){
                                    $d29 .= "<tr><td style=' text-align:left;'>"; 
                                    $d29 .= $monthL."/29/".$yearL." ";
                                    $d29 .= date('D', strtotime('29'.'-'.$monthL.'-'.$yearL));
                                    $d29 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '30') { $d30 = $tableRow; }
                                elseif ($d30 == ''){
                                    $d30 .= "<tr><td style=' text-align:left;'>"; 
                                    $d30 .= $monthL."/30/".$yearL." ";
                                    $d30 .= date('D', strtotime('30'.'-'.$monthL.'-'.$yearL));
                                    $d30 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '31') { $d31 = $tableRow; }
                                elseif ($d31 == ''){
                                    $d31 .= "<tr><td style=' text-align:left;'>"; 
                                    $d31 .= $monthL."/31/".$yearL." ";
                                    $d31 .= date('D', strtotime('31'.'-'.$monthL.'-'.$yearL));
                                    $d31 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                                //dd($d1);
                            //print_r($content);
                            
                        } else { //different employee no and day abov
                            
                            //dd($employeeNo);
                            //$rr .= $employeeNo;
                            //========== trigger the creation of 1 mo DTR per Employee and month. Populate days in a month  ==========//                            
                            echo $d1.$d2.$d3.$d4.$d5.$d6.$d7.$d8.$d9.$d10.$d11.$d12.$d13.$d14;
                            echo $d15.$d16.$d17.$d18.$d19.$d20.$d21.$d22.$d23.$d24.$d25.$d26.$d27;
                            $fixDay = 27; //1 to 31, depending in the $numOfDays
                            //$numOfDays = cal_days_in_month(CAL_GREGORIAN, $monthL, $yearL); //get number of day based on month and year
                            while( $fixDay <= $numOfDays-1){
                                $fixDay++;                                
                                if ($fixDay == 28) { echo $d28; }
                                if ($fixDay == 29) { echo $d29; }
                                if ($fixDay == 30) { echo $d30; }
                                if ($fixDay == 31) { echo $d31; }
                            }
                            //$content[] = $tableRow;
                            //print_r($content);
                            //dd($content);
                            echo $tableFooter;
                            echo $footer1."<br />";
                            echo "<SPAN STYLE='text-decoration:overline; font-weight:bold; font-size:15px;'>".$prevEmpAndIdNo."</SPAN><br /><br />";  
                            echo $footer2."<br /><br />";
                            echo $supervisorFooter."<br />"; 
                            echo $finalFooter;
                            

                            //dd($employeeNo);
                            //========== trigger the creation of 1 mo DTR per Employee and month ==========//
                            
                            
                            //======= Another employee. Force to another page=====//
                            echo "<div class='page-break'></div>";  
                            echo "<div style='text-align:center'><p style='font-weight:bold; font-size:18px; '>".$pro."</p></div>";
                            echo $dtrFor;
                            echo "<b>Employee:</b> ".Str::upper($empAndIdNo)."<br />";   
                            echo "<b>Office:</b> ".$branchunit.$sectionlhios.$express."<br /><br />";  
                            echo $tableHeader;

                            $prevEmpAndIdNo = $empAndIdNo;

                            $empNumRes = $employeeNo;
                            //$content = array();
                            $tableRow = '';
                            $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16= '';
                            $d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d31 = ''; 
                            
                            //==================  AM LOGIN 1st Column, PM Breakin 3rd Column, and Weekdays OT Logout ARE the possible multiple. ==========////
                            $tableRow .= '<tr>';
                                //common employee and date
                                $tableRow .= "<td style=' text-align:left;'>".
                                    $monthL.'/'.$dayL.'/'.$yearL.' '.$nameOfDay."</td>";
                                    
                                if ($amIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($amIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($amOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($amOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($pmIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($pmIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($pmOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($pmOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($otIn != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($otIn)."</td>";
                                } else { $tableRow .= "<td></td>"; }

                                if ($otOut != ''){
                                    $tableRow .= "<td style=' text-align:center;'>".trim($otOut)."</td>";
                                } else { $tableRow .= "<td></td>"; }
                            $tableRow .= '</tr>';

                                //dd($tableRow);
                                //set 1 to 31 days
                                if ($dayL == '01') { $d1 = $tableRow; }
                                elseif ($d1 == ''){
                                    $d1 .= "<tr><td style=' text-align:left;'>"; 
                                    $d1 .= $monthL."/01/".$yearL." ";
                                    $d1 .= date('D', strtotime('01'.'-'.$monthL.'-'.$yearL));
                                    $d1 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '02') { $d2 = $tableRow; }
                                elseif ($d2 == ''){
                                    $d2 .= "<tr><td style=' text-align:left;'>"; 
                                    $d2 .= $monthL."/02/".$yearL." ";
                                    $d2 .= date('D', strtotime('02'.'-'.$monthL.'-'.$yearL));
                                    $d2 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '03') { $d3 = $tableRow; }
                                elseif ($d3 == ''){
                                    $d3 .= "<tr><td style=' text-align:left;'>"; 
                                    $d3 .= $monthL."/03/".$yearL." ";
                                    $d3 .= date('D', strtotime('03'.'-'.$monthL.'-'.$yearL));
                                    $d3 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '04') { $d4 = $tableRow; }
                                elseif ($d4 == ''){
                                    $d4 .= "<tr><td style=' text-align:left;'>"; 
                                    $d4 .= $monthL."/04/".$yearL." ";
                                    $d4 .= date('D', strtotime('04'.'-'.$monthL.'-'.$yearL));
                                    $d4 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '05') { $d5 = $tableRow; }
                                elseif ($d5 == ''){
                                    $d5 .= "<tr><td style=' text-align:left;'>"; 
                                    $d5 .= $monthL."/05/".$yearL." ";
                                    $d5 .= date('D', strtotime('05'.'-'.$monthL.'-'.$yearL));
                                    $d5 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '06') { $d6 = $tableRow; }
                                elseif ($d6 == ''){
                                    $d6 .= "<tr><td style=' text-align:left;'>"; 
                                    $d6 .= $monthL."/06/".$yearL." ";
                                    $d6 .= date('D', strtotime('06'.'-'.$monthL.'-'.$yearL));
                                    $d6 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '07') { $d7 = $tableRow; }
                                elseif ($d7 == ''){
                                    $d7 .= "<tr><td style=' text-align:left;'>"; 
                                    $d7 .= $monthL."/07/".$yearL." ";
                                    $d7 .= date('D', strtotime('07'.'-'.$monthL.'-'.$yearL));
                                    $d7 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '08') { $d8 = $tableRow; }
                                elseif ($d8 == ''){
                                    $d8 .= "<tr><td style=' text-align:left;'>"; 
                                    $d8 .= $monthL."/08/".$yearL." ";
                                    $d8 .= date('D', strtotime('08'.'-'.$monthL.'-'.$yearL));
                                    $d8 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '09') { $d9 = $tableRow; }
                                elseif ($d9 == ''){
                                    $d9 .= "<tr><td style=' text-align:left;'>"; 
                                    $d9 .= $monthL."/09/".$yearL." ";
                                    $d9 .= date('D', strtotime('09'.'-'.$monthL.'-'.$yearL));
                                    $d9 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '10') { $d10 = $tableRow; }
                                elseif ($d10 == ''){
                                    $d10 .= "<tr><td style=' text-align:left;'>"; 
                                    $d10 .= $monthL."/10/".$yearL." ";
                                    $d10 .= date('D', strtotime('10'.'-'.$monthL.'-'.$yearL));
                                    $d10 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '11') { $d11 = $tableRow; }
                                elseif ($d11 == ''){
                                    $d11 .= "<tr><td style=' text-align:left;'>"; 
                                    $d11 .= $monthL."/11/".$yearL." ";
                                    $d11 .= date('D', strtotime('11'.'-'.$monthL.'-'.$yearL));
                                    $d11 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '12') { $d12 = $tableRow; }
                                elseif ($d12 == ''){
                                    $d12 .= "<tr><td style=' text-align:left;'>"; 
                                    $d12 .= $monthL."/12/".$yearL." ";
                                    $d12 .= date('D', strtotime('12'.'-'.$monthL.'-'.$yearL));
                                    $d12 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '13') { $d13 = $tableRow; }
                                elseif ($d13 == ''){
                                    $d13 .= "<tr><td style=' text-align:left;'>"; 
                                    $d13 .= $monthL."/13/".$yearL." ";
                                    $d13 .= date('D', strtotime('13'.'-'.$monthL.'-'.$yearL));
                                    $d13 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '14') { $d14 = $tableRow; }
                                elseif ($d14 == ''){
                                    $d14 .= "<tr><td style=' text-align:left;'>"; 
                                    $d14 .= $monthL."/14/".$yearL." ";
                                    $d14 .= date('D', strtotime('14'.'-'.$monthL.'-'.$yearL));
                                    $d14 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '15') { $d15 = $tableRow; }
                                elseif ($d15 == ''){
                                    $d15 .= "<tr><td style=' text-align:left;'>"; 
                                    $d15 .= $monthL."/15/".$yearL." ";
                                    $d15 .= date('D', strtotime('15'.'-'.$monthL.'-'.$yearL));
                                    $d15 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '16') { $d16 = $tableRow; }
                                elseif ($d16 == ''){
                                    $d16 .= "<tr><td style=' text-align:left;'>"; 
                                    $d16 .= $monthL."/16/".$yearL." ";
                                    $d16 .= date('D', strtotime('16'.'-'.$monthL.'-'.$yearL));
                                    $d16 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '17') { $d17 = $tableRow; }
                                elseif ($d17 == ''){
                                    $d17 .= "<tr><td style=' text-align:left;'>"; 
                                    $d17 .= $monthL."/17/".$yearL." ";
                                    $d17 .= date('D', strtotime('17'.'-'.$monthL.'-'.$yearL));
                                    $d17 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '18') { $d18 = $tableRow; }
                                elseif ($d18 == ''){
                                    $d18 .= "<tr><td style=' text-align:left;'>"; 
                                    $d18 .= $monthL."/18/".$yearL." ";
                                    $d18 .= date('D', strtotime('18'.'-'.$monthL.'-'.$yearL));
                                    $d18 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '19') { $d19 = $tableRow; }
                                elseif ($d19 == ''){
                                    $d19 .= "<tr><td style=' text-align:left;'>"; 
                                    $d19 .= $monthL."/19/".$yearL." ";
                                    $d19 .= date('D', strtotime('19'.'-'.$monthL.'-'.$yearL));
                                    $d19 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '20') { $d20 = $tableRow; }
                                elseif ($d20 == ''){
                                    $d20 .= "<tr><td style=' text-align:left;'>"; 
                                    $d20 .= $monthL."/20/".$yearL." ";
                                    $d20 .= date('D', strtotime('20'.'-'.$monthL.'-'.$yearL));
                                    $d20 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '21') { $d21 = $tableRow; }
                                elseif ($d21 == ''){
                                    $d21 .= "<tr><td style=' text-align:left;'>"; 
                                    $d21 .= $monthL."/21/".$yearL." ";
                                    $d21 .= date('D', strtotime('21'.'-'.$monthL.'-'.$yearL));
                                    $d21 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '22') { $d22 = $tableRow; }
                                elseif ($d22 == ''){
                                    $d22 .= "<tr><td style=' text-align:left;'>"; 
                                    $d22 .= $monthL."/22/".$yearL." ";
                                    $d22 .= date('D', strtotime('22'.'-'.$monthL.'-'.$yearL));
                                    $d22 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '23') { $d23 = $tableRow; }
                                elseif ($d23 == ''){
                                    $d23 .= "<tr><td style=' text-align:left;'>"; 
                                    $d23 .= $monthL."/23/".$yearL." ";
                                    $d23 .= date('D', strtotime('23'.'-'.$monthL.'-'.$yearL));
                                    $d23 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '24') { $d24 = $tableRow; }
                                elseif ($d24 == ''){
                                    $d24 .= "<tr><td style=' text-align:left;'>"; 
                                    $d24 .= $monthL."/24/".$yearL." ";
                                    $d24 .= date('D', strtotime('24'.'-'.$monthL.'-'.$yearL));
                                    $d24 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '25') { $d25 = $tableRow; }
                                elseif ($d25 == ''){
                                    $d25 .= "<tr><td style=' text-align:left;'>"; 
                                    $d25 .= $monthL."/25/".$yearL." ";
                                    $d25 .= date('D', strtotime('25'.'-'.$monthL.'-'.$yearL));
                                    $d25 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '26') { $d26 = $tableRow; }
                                elseif ($d26 == ''){
                                    $d26 .= "<tr><td style=' text-align:left;'>"; 
                                    $d26 .= $monthL."/26/".$yearL." ";
                                    $d26 .= date('D', strtotime('26'.'-'.$monthL.'-'.$yearL));
                                    $d26 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                } 
                                
                                if ($dayL == '27') { $d27 = $tableRow; }
                                elseif ($d27 == ''){
                                    $d27 .= "<tr><td style=' text-align:left;'>"; 
                                    $d27 .= $monthL."/27/".$yearL." ";
                                    $d27 .= date('D', strtotime('27'.'-'.$monthL.'-'.$yearL));
                                    $d27 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                                
                                if ($dayL == '28') { $d28 = $tableRow; }
                                elseif ($d28 == ''){
                                    $d28 .= "<tr><td style=' text-align:left;'>"; 
                                    $d28 .= $monthL."/28/".$yearL." ";
                                    $d28 .= date('D', strtotime('28'.'-'.$monthL.'-'.$yearL));
                                    $d28 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '29') { $d29 = $tableRow; }
                                elseif ($d29 == ''){
                                    $d29 .= "<tr><td style=' text-align:left;'>"; 
                                    $d29 .= $monthL."/29/".$yearL." ";
                                    $d29 .= date('D', strtotime('29'.'-'.$monthL.'-'.$yearL));
                                    $d29 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '30') { $d30 = $tableRow; }
                                elseif ($d30 == ''){
                                    $d30 .= "<tr><td style=' text-align:left;'>"; 
                                    $d30 .= $monthL."/30/".$yearL." ";
                                    $d30 .= date('D', strtotime('30'.'-'.$monthL.'-'.$yearL));
                                    $d30 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }

                                if ($dayL == '31') { $d31 = $tableRow; }
                                elseif ($d31 == ''){
                                    $d31 .= "<tr><td style=' text-align:left;'>"; 
                                    $d31 .= $monthL."/31/".$yearL." ";
                                    $d31 .= date('D', strtotime('31'.'-'.$monthL.'-'.$yearL));
                                    $d31 .= "</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                }
                        
                            //$content[] = $tableRow;
                            //print_r($content);
                            
                            
                        }

                        //if ($employeeNo == '20556408'){
                            //$rr .= $employeeNo.$amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut.'<br />';
                        //}

                        if ($resCount <= 1 || $loopCnt == $resCount){//Meaning 1 employee with single day  OR  the last loop
                            //========== trigger the creation of 1 mo DTR per Employee and month. Populate days in a month  ==========//                            
                            echo $d1.$d2.$d3.$d4.$d5.$d6.$d7.$d8.$d9.$d10.$d11.$d12.$d13.$d14;
                            echo $d15.$d16.$d17.$d18.$d19.$d20.$d21.$d22.$d23.$d24.$d25.$d26.$d27;
                            $fixDay = 27; //1 to 31, depending in the $numOfDays
                            //$numOfDays = cal_days_in_month(CAL_GREGORIAN, $monthL, $yearL); //get number of day based on month and year
                            while( $fixDay <= $numOfDays-1){
                                $fixDay++;                                
                                if ($fixDay == 28) { echo $d28; }
                                if ($fixDay == 29) { echo $d29; }
                                if ($fixDay == 30) { echo $d30; }
                                if ($fixDay == 31) { echo $d31; }
                            }
                            
                            //$content[] = $tableRow;
                            //print_r($content);
                            //dd($content);
                            echo $tableFooter;
                            echo $footer1."<br />";
                            echo "<SPAN STYLE='text-decoration:overline; font-weight:bold; font-size:15px;'>".$empAndIdNo."</SPAN><br /><br />";
                            echo $footer2."<br /><br />";
                            echo $supervisorFooter."<br />";
                            echo $finalFooter;
                            //========== trigger the creation of 1 mo DTR per Employee and month ==========//
                        }
                        
                        //======set=====//
    // if (count($resCount)){

    // };
                        //if ($loopCnt == $resCount){ //echo '<br />'.$resCount.'<br />';
                            //$rr .= $employeeNo.$amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut.'<br />';
                        //}


            }
            //}
            //print_r($rr);
            //echo "<br />".$loopCnt;
            //print_r($cc);
        @endphp
    </body>
</html>


<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/app.min.js')}}"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>  --}}
<script src="{{ URL::asset('assets/js/mindmup-editabletable.js')}}"></script>
<script>
	$('#editable').editableTableWidget();

    $('#editable td.uneditable').on('change', function(evt, newValue) {
        return false;
    });
</script>
