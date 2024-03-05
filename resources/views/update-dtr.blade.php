<!DOCTYPE html>
<html>
    <head>
        <title>{{ $mo.' '.$ye}} DTR</title>

        <style>
            input[type=text], select {
              width: 100%;
              padding: 12px 20px;
              margin: 8px 0;
              display: inline-block;
              border: 1px solid #ccc;
              border-radius: 4px;
              box-sizing: border-box;
            }
            
            input[type=submit] {
              width: 100%;
              background-color: #4CAF50;
              color: white;
              padding: 14px 20px;
              margin: 8px 0;
              border: none;
              border-radius: 4px;
              cursor: pointer;
            }
            
            input[type=submit]:hover {
              background-color: #45a049;
            }
            
            div {
              border-radius: 5px;
              background-color: #f2f2f2;
              padding: 20px;
            }
        </style>

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
        {{-- <script>
         <!--
            window.onerror = function (msg, url, line) {
               alert("Message : " + msg );
               alert("url : " + url );
               alert("Line number : " + line );
            }
         //-->
      </script> --}}
        {{-- <form action="{{route('updateDtrByIdNumber')}}" enctype='multipart/form-data' method="post">
            {{csrf_field()}} --}}

            {{-- <div class="form-group">
                @php
                    $curYear = date('Y');
                    echo "<label>Select Year</label>";
                    echo "<select name='year'>";
                        for ($year=2020; $year <= $curYear; $year++){
                            $selected = ($curYear == $year ? 'selected' : '');
                            echo "<option value='".$year."' ".$selected.">".$year."</option>"; 
                        }
                    echo "</select>";
                    echo "<br />";

                    $curMonth = date('m');
                    echo "<label>Select Month</label>";
                    echo "<select name='month'>";
                        $selectedMo = ($curMonth == '01' ? 'selected' : '');
                        echo "<option value='01'".$selectedMo.">January</option>"; 
                        $selectedMo = ($curMonth == '02' ? 'selected' : '');
                        echo "<option value='02'".$selectedMo.">February</option>"; 
                        $selectedMo = ($curMonth == '03' ? 'selected' : '');
                        echo "<option value='03'".$selectedMo.">March</option>"; 
                        $selectedMo = ($curMonth == '04' ? 'selected' : '');
                        echo "<option value='04'".$selectedMo.">April</option>"; 
                        $selectedMo = ($curMonth == '05' ? 'selected' : '');
                        echo "<option value='05'".$selectedMo.">May</option>"; 
                        $selectedMo = ($curMonth == '06' ? 'selected' : '');
                        echo "<option value='06'".$selectedMo.">June</option>";
                        $selectedMo = ($curMonth == '07' ? 'selected' : ''); 
                        echo "<option value='07'".$selectedMo.">July</option>";
                        $selectedMo = ($curMonth == '08' ? 'selected' : ''); 
                        echo "<option value='08'".$selectedMo.">August</option>";
                        $selectedMo = ($curMonth == '09' ? 'selected' : ''); 
                        echo "<option value='09'".$selectedMo.">September</option>";
                        $selectedMo = ($curMonth == '10' ? 'selected' : ''); 
                        echo "<option value='10'".$selectedMo.">October</option>";
                        $selectedMo = ($curMonth == '11' ? 'selected' : ''); 
                        echo "<option value='11'".$selectedMo.">November</option>";
                        $selectedMo = ($curMonth == '12' ? 'selected' : ''); 
                        echo "<option value='12'".$selectedMo.">December</option>"; 
                    echo "</select>";
                    // echo "<br />";
                    // echo "<label>Employee / ID Number</label>";
                    // echo "<input type='text' name='employee_no' required>";
                @endphp

            </div> --}}

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
                $tableHeader = "<table id='editable' class='pure-table pure-table-bordered'>
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
                //$footer1 = "<p style='font-size:13px;'>I certify on my honor that the above is a true and correct report of the hours worked performed, record of which was made daily at the time of arrival and departure from office.</p>";
                //$footer2 = "<p style='font-size:13px;'>Verified as to the prescribed office hours.</p>";
                // $finalFooter = "<div id='footer'>
                //                     <p><a href='contactus.html'>Contact Us</a> | 
                //                         <a href='copyright.html'>Copyright</a> | 
                //                         <a href='feedback.html'>Feedback</a> | 
                //                         <a href='brokenlink.html'>Report a broken link</a>
                //                     </p>
                //                 </div>";
                //$finalFooter = "<div id='footer'>
                //                    <p style='font-size:10px;'>Date and Time Generated (By): ".$datetimegenerated." (".$generated_by.")</p>
                //                </div>";
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
                //$ff = "";
                foreach ($logs as $item) {
                    $loopCnt++;
                    echo "<input type='text' id='employee_no' value='".$item->employee_no."' required style='display:none'>";

                    //dd($item);
                        /*
                        +"employee_no": 20556408
                        +"year": "2022"
                        +"month": "07"
                        +"day": "25"
                        +"time_logs": "20556408|07/25/22|08:33:34 AM|12:21:14 PM|12:22:44 PM|05:43:22 PM|05:56:31 PM|08:58:11 PM||||||||"
                        */
                    //time_logs_dtr COLUMN for DTR VERSION. Get 8 Columns only, EmpID,Day,6 time logs
                    $time_logs = explode('|', $item->time_logs_dtr); //itemized
                    $timeLogsComplete = $item->time_logs;
                    $amCount = substr_count($timeLogsComplete, 'AM'); 
                    $pmCount = substr_count($timeLogsComplete, 'PM'); 
                    
                    $employeeNo = $time_logs[0];
                    //$emp[] = $item->employee_no;

                    $yearL = '20'.substr($time_logs[1], 6, 2);
                    $monthL = substr($time_logs[1], 0, 2);
                    $dayL = substr($time_logs[1], 3, 2);

                   // $ff .= $time_logs[1]."<br>";

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
                            //dd($time_logs);

                        $empNoLog = $time_logs[0];
                        $dateLog = $time_logs[1];
                        $amIn = $time_logs[2];
                        $amOut = $time_logs[3];
                        $pmIn = $time_logs[4];
                        $pmOut = $time_logs[5];
                        $otIn = $time_logs[6];
                        $otOut = $time_logs[7];
//                             foreach ($time_logs as $row){
//                                 //dd($item->time_logs); //"10009697|07/26/22|03:24:13 PM|07:12:50 PM||||||||||||"
//                                 //dd($row); //= "10009697" 1st row
//                                             //= 07/26/22  2nd row of $row
                                
//                                 $cnt++;
//                                 if ($cnt >= 3){ //starts in row 3 (bypass employee no and day). 3rd row onwards are time logs
//                                     //dd($row);
//                                     $timeL = substr($row, 0, 5);
//                                     $hourL = substr($row, 0, 2);
//                                     $meridiem = substr($row, 9, 2);
//                                     //dd($timeL.'-'.$hourL.'-'.$meridiem);
                                    
//                                     if ($timeL != ''){ //except blank field or the ||||..
                                        
//                                         //1st column (AM IN)
//                                         if ($hourL <= 11 && $meridiem =='AM'){
//                                             $amIn .= $timeL.' '; //can be multiple login in AM
//                                         } elseif ($amCount <= 0){
//                                             $amIn = '';
//                                         }

//                                         //2nd column (AM OUT)
//                                         if ($hourL == 12 && $meridiem =='PM'){
//                                             if ($amOut == ''){
//                                                 $amOut = $timeL; //AM out once. 2nd column (AM OUT)                                            
//                                             } elseif ($amOut != ''){ //for PM In, 3rd column (PM IN)
//                                                 $pmIn .= $timeL.' '; //can be multiple login in PM
//                                             }
//                                         } elseif ($hourL == 12 && $meridiem == 'PM' && $pmCount <= 0){
//                                             $amOut = '';
//                                             $pmIn = '';
//                                         }
// // if updated na dapat sundin ng ung tamang column.
// // gawa pa isa pang table para sageneration ng DTR? strictly 6 columns only and well separated by pipes aside sa pips?
// //     select pips, if dtrgen db is blank then adopt pips, else ung sa user saved
//                                         //4th column
//                                         if ($hourL <= 11 && $meridiem =='PM'){
//                                             if ($pmOut == ''){
//                                                 $pmOut = $timeL; //PM out once. 4th column (PM OUT)                                           
//                                             } elseif ($pmOut != '' && $otIn == ''){ //OT PM IN once. 5th column          
//                                                 $otIn = $timeL; 
//                                             } elseif ($pmOut != '' && $otIn != ''){ //OT PM IN once. 5th column          
//                                                 $otOut .= $timeL.' '; //can be multiple OT OUT (6th Column)
//                                             } 
//                                         } elseif ($hourL <= 11 && $meridiem =='PM' && $pmCount <= 0){
//                                             $pmOut = '';
//                                             $otIn = '';
//                                             $otOut = '';  
//                                         }
//                                     }
//                                 }
//                             }
                            //======END Set TIME per employee, per month, and per day =====//
                            //RESULT AFTER LOOP above (1 or multiple employee. Per day per employee), dd($amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut); //"===03:24=07:12="
                            //dd($amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut); 

                            //======set=====//
                            if ($empNumRes == ""){ //means first row, no assignment yet and need to assign
                                $empNumRes = $employeeNo;
                                //$dayRes = $dayL;
                                echo "<p style='color:blue; font-weight:bold; font-size:22px; text-align:center'>UPDATE DTR</p>";
                                echo "<p style='font-weight:bold; font-size:18px; text-align:center'>".$pro."</p></div>";
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
                                    $tableRow .= "<td style=' text-align:left;' class='uneditable' name='vdate[]'>".
                                        $monthL.'/'.$dayL.'/'.$yearL.' '.$nameOfDay."</td>";
                                
                                    if ($amIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='vamin[]'>".$amIn."</td>";  
                                    } else { $tableRow .= "<td class='editablev' name='vamin[]'></td>"; }

                                    if ($amOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='vamout[]'>".$amOut."</td>";
                                    } else { $tableRow .= "<td class='editablev' name='vamout[]'></td>"; }

                                    if ($pmIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='vpmin[]'>".$pmIn."</td>";
                                    } else { $tableRow .= "<td class='editablev' name='vpmin[]'></td>"; }

                                    if ($pmOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='vpmout[]'>".$pmOut."</td>";
                                    } else { $tableRow .= "<td class='editablev' name='vpmout[]'></td>"; }

                                    if ($otIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='votin[]'>".$otIn."</td>";
                                    } else { $tableRow .= "<td class='editablev' name='votin[]'></td>"; }

                                    if ($otOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' class='editablev' name='votout[]'>".$otOut."</td>";
                                    } else { $tableRow .= "<td class='editablev' name='votout[]'></td>"; }
                                $tableRow .= '</tr>';
                                //dd($dayL);
                                
                                    //set 1 to 31 days
                                    if ($dayL == '01') { $d1 = $tableRow; }
                                    elseif ($d1 == ''){
                                        $d1 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d1 .= $monthL."/01/".$yearL." ";
                                        $d1 .= date('D', strtotime('01'.'-'.$monthL.'-'.$yearL));
                                        $d1 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }
                                    
                                    if ($dayL == '02') { $d2 = $tableRow; }
                                    elseif ($d2 == ''){
                                        $d2 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d2 .= $monthL."/02/".$yearL." ";
                                        $d2 .= date('D', strtotime('02'.'-'.$monthL.'-'.$yearL));
                                        $d2 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '03') { $d3 = $tableRow; }
                                    elseif ($d3 == ''){
                                        $d3 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d3 .= $monthL."/03/".$yearL." ";
                                        $d3 .= date('D', strtotime('03'.'-'.$monthL.'-'.$yearL));
                                        $d3 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '04') { $d4 = $tableRow; }
                                    elseif ($d4 == ''){
                                        $d4 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d4 .= $monthL."/04/".$yearL." ";
                                        $d4 .= date('D', strtotime('04'.'-'.$monthL.'-'.$yearL));
                                        $d4 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }
                                
                                    if ($dayL == '05') { $d5 = $tableRow; }
                                    elseif ($d5 == ''){
                                        $d5 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d5 .= $monthL."/05/".$yearL." ";
                                        $d5 .= date('D', strtotime('05'.'-'.$monthL.'-'.$yearL));
                                        $d5 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '06') { $d6 = $tableRow; }
                                    elseif ($d6 == ''){
                                        $d6 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d6 .= $monthL."/06/".$yearL." ";
                                        $d6 .= date('D', strtotime('06'.'-'.$monthL.'-'.$yearL));
                                        $d6 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '07') { $d7 = $tableRow;}
                                    elseif ($d7 == ''){
                                        $d7 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d7 .= $monthL."/07/".$yearL." ";
                                        $d7 .= date('D', strtotime('07'.'-'.$monthL.'-'.$yearL));
                                        $d7 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '08') { $d8 = $tableRow; }
                                    elseif ($d8 == ''){
                                        $d8 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d8 .= $monthL."/08/".$yearL." ";
                                        $d8 .= date('D', strtotime('08'.'-'.$monthL.'-'.$yearL));
                                        $d8 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '09') { $d9 = $tableRow; }
                                    elseif ($d9 == ''){
                                        $d9 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d9 .= $monthL."/09/".$yearL." ";
                                        $d9 .= date('D', strtotime('09'.'-'.$monthL.'-'.$yearL));
                                        $d9 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '10') { $d10 = $tableRow; }
                                    elseif ($d10 == ''){
                                        $d10 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d10 .= $monthL."/10/".$yearL." ";
                                        $d10 .= date('D', strtotime('10'.'-'.$monthL.'-'.$yearL));
                                        $d10 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '11') { $d11 = $tableRow; }
                                    elseif ($d11 == ''){
                                        $d11 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d11 .= $monthL."/11/".$yearL." ";
                                        $d11 .= date('D', strtotime('11'.'-'.$monthL.'-'.$yearL));
                                        $d11 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '12') { $d12 = $tableRow; }
                                    elseif ($d12 == ''){
                                        $d12 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d12 .= $monthL."/12/".$yearL." ";
                                        $d12 .= date('D', strtotime('12'.'-'.$monthL.'-'.$yearL));
                                        $d12 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '13') { $d13 = $tableRow; }
                                    elseif ($d13 == ''){
                                        $d13 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d13 .= $monthL."/13/".$yearL." ";
                                        $d13 .= date('D', strtotime('13'.'-'.$monthL.'-'.$yearL));
                                        $d13 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '14') { $d14 = $tableRow; }
                                    elseif ($d14 == ''){
                                        $d14 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d14 .= $monthL."/14/".$yearL." ";
                                        $d14 .= date('D', strtotime('14'.'-'.$monthL.'-'.$yearL));
                                        $d14 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '15') { $d15 = $tableRow; }
                                    elseif ($d15 == ''){
                                        $d15 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d15 .= $monthL."/15/".$yearL." ";
                                        $d15 .= date('D', strtotime('15'.'-'.$monthL.'-'.$yearL));
                                        $d15 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '16') { $d16 = $tableRow; }
                                    elseif ($d16 == ''){
                                        $d16 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d16 .= $monthL."/16/".$yearL." ";
                                        $d16 .= date('D', strtotime('16'.'-'.$monthL.'-'.$yearL));
                                        $d16 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '17') { $d17 = $tableRow; }
                                    elseif ($d17 == ''){
                                        $d17 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d17 .= $monthL."/17/".$yearL." ";
                                        $d17 .= date('D', strtotime('17'.'-'.$monthL.'-'.$yearL));
                                        $d17 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '18') { $d18 = $tableRow; }
                                    elseif ($d18 == ''){
                                        $d18 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d18 .= $monthL."/18/".$yearL." ";
                                        $d18 .= date('D', strtotime('18'.'-'.$monthL.'-'.$yearL));
                                        $d18 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '19') { $d19 = $tableRow; }
                                    elseif ($d19 == ''){
                                        $d19 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d19 .= $monthL."/19/".$yearL." ";
                                        $d19 .= date('D', strtotime('19'.'-'.$monthL.'-'.$yearL));
                                        $d19 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '20') { $d20 = $tableRow; }
                                    elseif ($d20 == ''){
                                        $d20 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d20 .= $monthL."/20/".$yearL." ";
                                        $d20 .= date('D', strtotime('20'.'-'.$monthL.'-'.$yearL));
                                        $d20 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '21') { $d21 = $tableRow; }
                                    elseif ($d21 == ''){
                                        $d21 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d21 .= $monthL."/21/".$yearL." ";
                                        $d21 .= date('D', strtotime('21'.'-'.$monthL.'-'.$yearL));
                                        $d21 .="</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '22') { $d22 = $tableRow; }
                                    elseif ($d22 == ''){
                                        $d22 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d22 .= $monthL."/22/".$yearL." ";
                                        $d22 .= date('D', strtotime('22'.'-'.$monthL.'-'.$yearL));
                                        $d22 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '23') { $d23 = $tableRow; }
                                    elseif ($d23 == ''){
                                        $d23 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d23 .= $monthL."/23/".$yearL." ";
                                        $d23 .= date('D', strtotime('23'.'-'.$monthL.'-'.$yearL));
                                        $d23 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '24') { $d24 = $tableRow; }
                                    elseif ($d24 == ''){
                                        $d24 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d24 .= $monthL."/24/".$yearL." ";
                                        $d24 .= date('D', strtotime('24'.'-'.$monthL.'-'.$yearL));
                                        $d24 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '25') { $d25 = $tableRow; }
                                    elseif ($d25 == ''){
                                        $d25 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d25 .= $monthL."/25/".$yearL." ";
                                        $d25 .= date('D', strtotime('25'.'-'.$monthL.'-'.$yearL));
                                        $d25 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '26') { $d26 = $tableRow; }
                                    elseif ($d26 == ''){
                                        $d26 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d26 .= $monthL."/26/".$yearL." ";
                                        $d26 .= date('D', strtotime('26'.'-'.$monthL.'-'.$yearL));
                                        $d26 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    } 
                                    
                                    if ($dayL == '27') { $d27 = $tableRow; }
                                    elseif ($d27 == ''){
                                        $d27 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d27 .= $monthL."/27/".$yearL." ";
                                        $d27 .= date('D', strtotime('27'.'-'.$monthL.'-'.$yearL));
                                        $d27 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }
                                    
                                    if ($dayL == '28') { $d28 = $tableRow; }
                                    elseif ($d28 == ''){
                                        $d28 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d28 .= $monthL."/28/".$yearL." ";
                                        $d28 .= date('D', strtotime('28'.'-'.$monthL.'-'.$yearL));
                                        $d28 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '29') { $d29 = $tableRow; }
                                    elseif ($d29 == ''){
                                        $d29 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d29 .= $monthL."/29/".$yearL." ";
                                        $d29 .= date('D', strtotime('29'.'-'.$monthL.'-'.$yearL));
                                        $d29 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '30') { $d30 = $tableRow; }
                                    elseif ($d30 == ''){
                                        $d30 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d30 .= $monthL."/30/".$yearL." ";
                                        $d30 .= date('D', strtotime('30'.'-'.$monthL.'-'.$yearL));
                                        $d30 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '31') { $d31 = $tableRow; }
                                    elseif ($d31 == ''){
                                        $d31 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d31 .= $monthL."/31/".$yearL." ";
                                        $d31 .= date('D', strtotime('31'.'-'.$monthL.'-'.$yearL));
                                        $d31 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
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
                                // echo $footer1."<br />";
                                // echo "<SPAN STYLE='text-decoration:overline; font-weight:bold; font-size:15px;'>".$prevEmpAndIdNo."</SPAN><br /><br />";
                                // echo $footer2."<br /><br />";
                                // echo $supervisorFooter."<br />"; 
                                // echo $finalFooter;
                                

                                //dd($employeeNo);
                                //========== trigger the creation of 1 mo DTR per Employee and month ==========//
                                
                                
                                //======= Another employee. Force to another page=====//
                                echo "<div class='page-break'></div>";  
                                echo "<div style='text-align:center'><p style='font-weight:bold; font-size:18px; '>".$pro."</p></div>";
                                echo $dtrFor;
                                echo "<b>Employee:</b> ".Str::upper($empAndIdNo)."<br />";   
                                echo "<b>Office:</b> ".$branchunit.$sectionlhios.$express."<br /><br />";  
                                echo $tableHeader;

                                $empNumRes = $employeeNo;
                                //$content = array();
                                $tableRow = '';
                                $d1=$d2=$d3=$d4=$d5=$d6=$d7=$d8=$d9=$d10=$d11=$d12=$d13=$d14=$d15=$d16= '';
                                $d17=$d18=$d19=$d20=$d21=$d22=$d23=$d24=$d25=$d26=$d27=$d28=$d29=$d30=$d31 = ''; 
                                
                                //==================  AM LOGIN 1st Column, PM Breakin 3rd Column, and Weekdays OT Logout ARE the possible multiple. ==========////
                                $tableRow .= '<tr>';
                                    //common employee and date
                                    $tableRow .= "<td style=' text-align:left;' name='vdate[]'>".
                                        $monthL.'/'.$dayL.'/'.$yearL.' '.$nameOfDay."</td>";
                                        
                                    if ($amIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='vamin[]'>".$amIn."</td>";
                                    } else { $tableRow .= "<td name='vamin[]'></td>"; }

                                    if ($amOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='vamout[]'>".$amOut."</td>";
                                    } else { $tableRow .= "<td name='vamout[]'></td>"; }

                                    if ($pmIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='vpmin[]'>".$pmIn."</td>";
                                    } else { $tableRow .= "<td name='vpmin[]'></td>"; }

                                    if ($pmOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='vpmout[]'>".$pmOut."</td>";
                                    } else { $tableRow .= "<td name='vpmout[]'></td>"; }

                                    if ($otIn != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='votin[]'>".$otIn."</td>";
                                    } else { $tableRow .= "<td name='votin[]'></td>"; }

                                    if ($otOut != ''){
                                        $tableRow .= "<td style=' text-align:center;' name='votout[]'>".$otOut."</td>";
                                    } else { $tableRow .= "<td name='votout[]'></td>"; }
                                $tableRow .= '</tr>';

                                    //dd($tableRow);
                                    //set 1 to 31 days
                                    if ($dayL == '01') { $d1 = $tableRow; }
                                    elseif ($d1 == ''){
                                        $d1 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d1 .= $monthL."/01/".$yearL." ";
                                        $d1 .= date('D', strtotime('01'.'-'.$monthL.'-'.$yearL));
                                        $d1 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '02') { $d2 = $tableRow; }
                                    elseif ($d2 == ''){
                                        $d2 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d2 .= $monthL."/02/".$yearL." ";
                                        $d2 .= date('D', strtotime('02'.'-'.$monthL.'-'.$yearL));
                                        $d2 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '03') { $d3 = $tableRow; }
                                    elseif ($d3 == ''){
                                        $d3 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d3 .= $monthL."/03/".$yearL." ";
                                        $d3 .= date('D', strtotime('03'.'-'.$monthL.'-'.$yearL));
                                        $d3 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '04') { $d4 = $tableRow; }
                                    elseif ($d4 == ''){
                                        $d4 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d4 .= $monthL."/04/".$yearL." ";
                                        $d4 .= date('D', strtotime('04'.'-'.$monthL.'-'.$yearL));
                                        $d4 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '05') { $d5 = $tableRow; }
                                    elseif ($d5 == ''){
                                        $d5 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d5 .= $monthL."/05/".$yearL." ";
                                        $d5 .= date('D', strtotime('05'.'-'.$monthL.'-'.$yearL));
                                        $d5 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '06') { $d6 = $tableRow; }
                                    elseif ($d6 == ''){
                                        $d6 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d6 .= $monthL."/06/".$yearL." ";
                                        $d6 .= date('D', strtotime('06'.'-'.$monthL.'-'.$yearL));
                                        $d6 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '07') { $d7 = $tableRow; }
                                    elseif ($d7 == ''){
                                        $d7 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d7 .= $monthL."/07/".$yearL." ";
                                        $d7 .= date('D', strtotime('07'.'-'.$monthL.'-'.$yearL));
                                        $d7 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '08') { $d8 = $tableRow; }
                                    elseif ($d8 == ''){
                                        $d8 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d8 .= $monthL."/08/".$yearL." ";
                                        $d8 .= date('D', strtotime('08'.'-'.$monthL.'-'.$yearL));
                                        $d8 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '09') { $d9 = $tableRow; }
                                    elseif ($d9 == ''){
                                        $d9 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d9 .= $monthL."/09/".$yearL." ";
                                        $d9 .= date('D', strtotime('09'.'-'.$monthL.'-'.$yearL));
                                        $d9 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '10') { $d10 = $tableRow; }
                                    elseif ($d10 == ''){
                                        $d10 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d10 .= $monthL."/10/".$yearL." ";
                                        $d10 .= date('D', strtotime('10'.'-'.$monthL.'-'.$yearL));
                                        $d10 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '11') { $d11 = $tableRow; }
                                    elseif ($d11 == ''){
                                        $d11 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d11 .= $monthL."/11/".$yearL." ";
                                        $d11 .= date('D', strtotime('11'.'-'.$monthL.'-'.$yearL));
                                        $d11 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '12') { $d12 = $tableRow; }
                                    elseif ($d12 == ''){
                                        $d12 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d12 .= $monthL."/12/".$yearL." ";
                                        $d12 .= date('D', strtotime('12'.'-'.$monthL.'-'.$yearL));
                                        $d12 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '13') { $d13 = $tableRow; }
                                    elseif ($d13 == ''){
                                        $d13 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d13 .= $monthL."/13/".$yearL." ";
                                        $d13 .= date('D', strtotime('13'.'-'.$monthL.'-'.$yearL));
                                        $d13 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '14') { $d14 = $tableRow; }
                                    elseif ($d14 == ''){
                                        $d14 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d14 .= $monthL."/14/".$yearL." ";
                                        $d14 .= date('D', strtotime('14'.'-'.$monthL.'-'.$yearL));
                                        $d14 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '15') { $d15 = $tableRow; }
                                    elseif ($d15 == ''){
                                        $d15 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d15 .= $monthL."/15/".$yearL." ";
                                        $d15 .= date('D', strtotime('15'.'-'.$monthL.'-'.$yearL));
                                        $d15 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '16') { $d16 = $tableRow; }
                                    elseif ($d16 == ''){
                                        $d16 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d16 .= $monthL."/16/".$yearL." ";
                                        $d16 .= date('D', strtotime('16'.'-'.$monthL.'-'.$yearL));
                                        $d16 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '17') { $d17 = $tableRow; }
                                    elseif ($d17 == ''){
                                        $d17 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d17 .= $monthL."/17/".$yearL." ";
                                        $d17 .= date('D', strtotime('17'.'-'.$monthL.'-'.$yearL));
                                        $d17 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '18') { $d18 = $tableRow; }
                                    elseif ($d18 == ''){
                                        $d18 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d18 .= $monthL."/18/".$yearL." ";
                                        $d18 .= date('D', strtotime('18'.'-'.$monthL.'-'.$yearL));
                                        $d18 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '19') { $d19 = $tableRow; }
                                    elseif ($d19 == ''){
                                        $d19 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d19 .= $monthL."/19/".$yearL." ";
                                        $d19 .= date('D', strtotime('19'.'-'.$monthL.'-'.$yearL));
                                        $d19 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '20') { $d20 = $tableRow; }
                                    elseif ($d20 == ''){
                                        $d20 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d20 .= $monthL."/20/".$yearL." ";
                                        $d20 .= date('D', strtotime('20'.'-'.$monthL.'-'.$yearL));
                                        $d20 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '21') { $d21 = $tableRow; }
                                    elseif ($d21 == ''){
                                        $d21 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d21 .= $monthL."/21/".$yearL." ";
                                        $d21 .= date('D', strtotime('21'.'-'.$monthL.'-'.$yearL));
                                        $d21 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '22') { $d22 = $tableRow; }
                                    elseif ($d22 == ''){
                                        $d22 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d22 .= $monthL."/22/".$yearL." ";
                                        $d22 .= date('D', strtotime('22'.'-'.$monthL.'-'.$yearL));
                                        $d22 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '23') { $d23 = $tableRow; }
                                    elseif ($d23 == ''){
                                        $d23 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d23 .= $monthL."/23/".$yearL." ";
                                        $d23 .= date('D', strtotime('23'.'-'.$monthL.'-'.$yearL));
                                        $d23 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '24') { $d24 = $tableRow; }
                                    elseif ($d24 == ''){
                                        $d24 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d24 .= $monthL."/24/".$yearL." ";
                                        $d24 .= date('D', strtotime('24'.'-'.$monthL.'-'.$yearL));
                                        $d24 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '25') { $d25 = $tableRow; }
                                    elseif ($d25 == ''){
                                        $d25 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d25 .= $monthL."/25/".$yearL." ";
                                        $d25 .= date('D', strtotime('25'.'-'.$monthL.'-'.$yearL));
                                        $d25 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '26') { $d26 = $tableRow; }
                                    elseif ($d26 == ''){
                                        $d26 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d26 .= $monthL."/26/".$yearL." ";
                                        $d26 .= date('D', strtotime('26'.'-'.$monthL.'-'.$yearL));
                                        $d26 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    } 
                                    
                                    if ($dayL == '27') { $d27 = $tableRow; }
                                    elseif ($d27 == ''){
                                        $d27 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d27 .= $monthL."/27/".$yearL." ";
                                        $d27 .= date('D', strtotime('27'.'-'.$monthL.'-'.$yearL));
                                        $d27 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }
                                    
                                    if ($dayL == '28') { $d28 = $tableRow; }
                                    elseif ($d28 == ''){
                                        $d28 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d28 .= $monthL."/28/".$yearL." ";
                                        $d28 .= date('D', strtotime('28'.'-'.$monthL.'-'.$yearL));
                                        $d28 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '29') { $d29 = $tableRow; }
                                    elseif ($d29 == ''){
                                        $d29 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d29 .= $monthL."/29/".$yearL." ";
                                        $d29 .= date('D', strtotime('29'.'-'.$monthL.'-'.$yearL));
                                        $d29 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '30') { $d30 = $tableRow; }
                                    elseif ($d30 == ''){
                                        $d30 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d30 .= $monthL."/30/".$yearL." ";
                                        $d30 .= date('D', strtotime('30'.'-'.$monthL.'-'.$yearL));
                                        $d30 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
                                    }

                                    if ($dayL == '31') { $d31 = $tableRow; }
                                    elseif ($d31 == ''){
                                        $d31 .= "<tr><td style=' text-align:left;' class='uneditable' name='vdate[]'>"; 
                                        $d31 .= $monthL."/31/".$yearL." ";
                                        $d31 .= date('D', strtotime('31'.'-'.$monthL.'-'.$yearL));
                                        $d31 .= "</td><td class='editablev' name='vamin[]'></td>
                                                <td class='editablev' name='vamout[]'></td>
                                                <td class='editablev' name='vpmin[]'></td>
                                                <td class='editablev' name='vpmout[]'></td>
                                                <td class='editablev' name='votin[]'></td>
                                                <td class='editablev' name='votout[]'></td></tr>";
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
                                // echo $footer1."<br />";
                                // echo "<SPAN STYLE='text-decoration:overline; font-weight:bold; font-size:15px;'>".$empAndIdNo."</SPAN><br /><br />";
                                // echo $footer2."<br /><br />";
                                // echo $supervisorFooter."<br />";
                                // echo $finalFooter;
                                //========== trigger the creation of 1 mo DTR per Employee and month ==========//
                            }
                            
                            //======set=====//
        // if (count($resCount)){

        // };
                            //if ($loopCnt == $resCount){ //echo '<br />'.$resCount.'<br />';
                                //$rr .= $employeeNo.$amIn.'='.$amOut.'='. $pmIn.'='.$pmOut.'='.$otIn.'='.$otOut.'<br />';
                            //}


                }
                //dd($ff);
                //print_r($rr);
                //echo "<br />".$loopCnt;
                //print_r($cc);
            @endphp

            <input type="hidden" id="token" value="{{ csrf_token() }}">
            {{-- <div class="form-group">
                <div class="col-md-6"> --}}
                <input type="submit" name="updateDtrByIdNumber" value='UPDATE' class='btn btn-success'>
                {{-- </div>
            </div> --}}

            {{-- <button onclick="saveTblValues()">Click me</button>  --}}

        {{-- </form> --}}

        
    </body>
</html>


<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/app.min.js')}}"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>  --}}
<script src="{{ URL::asset('assets/js/mindmup-editabletable.js')}}"></script>
<script>
	$('#editable').editableTableWidget();

    $('#editable td.editablev').on('change', function(evt, newValue) {
        
        valid = true;
        newVal = newValue.trim();  
        // alert(newValue);
        if (newVal != ''){
            try {
                errMsg = "";
                //----- ASSUMING 1 TIME only, NO Multiple time in a cell ----//
                times = newVal.split(":", 3); //split and return 2 result only = HH,MM AM
                
                //---Not to SET but to CHECK the type, etc
                hr = times[0]; //HH
                    colon1 = newVal.substring(2, 3);
                mm = times[1]; //MM
                    colon2 = newVal.substring(5, 6);
                ss = times[2].substring(0, 2);
                    space = newVal.substring(8, 9);
                    meridiem = times[2].substring(3, 5);
                // alert(hr);
                // alert(colon1);
                // alert(mm);
                // alert(colon2);
                // alert(ss);
                // alert(space);
                // alert(meridiem);

                // //hr = times[0]; //HH
                // colon = newVal.substring(2, 3);
                // minutes = times[1].split(" ", 2) //returns MM,AM
                // mm = minutes[0]; //MM
                // space = newVal.substring(5, 6);
                // meridiem = minutes[1].trim();  
        
                if (hr.length != 2){ 
                    valid = false; 
                    errMsg = '\n Hour format must be 2 digits in length.  '+hr+' is not valid.' ; 
                } else if (isNaN(hr)){ 
                    valid = false; 
                    errMsg = '\n Hour value must be a digit. '+hr+' is not valid.' ; 
                } else if (parseInt(hr) == 0 || parseInt(hr) > 12){ 
                    valid = false; 
                    errMsg = '\n Hour value must be from 01 to 12 hr. '+hr+' is not valid.' ; 
                } else if (mm.length != 2){ 
                    valid = false; 
                    errMsg = '\n Minute format must be 2 digits in length.  '+mm+' is not valid.' ; 
                } else if (isNaN(mm)){ 
                    valid = false; 
                    errMsg = '\n Minute value must be a digit. '+mm+' is not valid.' ; 
                } else if (parseInt(mm) > 59){ 
                    valid = false; 
                    errMsg = '\n Minute value must be from 00 to 59 min. '+mm+' is not valid.' ; 
                } else if (ss.length != 2){ 
                    valid = false; 
                    errMsg = '\n Second time format must be 2 digits in length.  '+ss+' is not valid.' ; 
                } else if (isNaN(ss)){ 
                    valid = false; 
                    errMsg = '\n Second time value must be a digit. '+ss+' is not valid.' ; 
                } else if (parseInt(ss) > 59){ 
                    valid = false; 
                    errMsg = '\n Second time value must be from 00 to 59 sec. '+ss+' is not valid.' ; 
                } else if (colon1 != ':'){ 
                    valid = false; 
                    errMsg = '\n Colon must be exist between hour and minute.'; 
                } else if (colon2 != ':'){ 
                    valid = false; 
                    errMsg = '\n Colon must be exist between minute and second.'; 
                } else if (newVal.length != 11){
                    valid = false; 
                    errMsg = '\nInvalid format. \nAllowed valid format is HH:MM:SS AM. \nEx. 05:25:01 PM or 08:25:01 AM'; 
                } else if (space != ' '){ 
                    valid = false; 
                    errMsg = '\n Space must be exist between minute and AM/PM.'; 
                } else if (meridiem != 'AM' && meridiem != 'PM'){ 
                    valid = false; 
                    errMsg = '\n Indicate AM or PM properly.'; 
                }

                if (valid){
                    return true;
                } else {
                    alert('Please correct the following: \n'+errMsg);
                    return false;
                }
            
            } catch(err) {
                alert("\nInvalid format. \nAllowed valid format is HH:MM:SS AM. \nEx. 05:25:01 PM or 08:25:01 AM"); 
                return false;
            }

        } else { return true; }
    });

    $('#editable td.uneditable').on('change', function(evt, newValue) {
        return false;
    });
</script>


<script>
    $(document).on('click','.btn',function(){
        var idnumber = $('#employee_no').val();

        var vdate = [];
        $("[name='vdate[]']").each(function () {
            vdate.push($(this).text());
            //alert($(this).text());
        });
        
        var vamin = [];
        $("[name='vamin[]']").each(function () {
            vamin.push($(this).text());
            //alert($(this).text());
        });

        var vamout = [];
        $("[name='vamout[]']").each(function () {
            vamout.push($(this).text());
            //alert($(this).text());
        });

        var vpmin = [];
        $("[name='vpmin[]']").each(function () {
            vpmin.push($(this).text());
            //alert($(this).text());
        });

        var vpmout = [];
        $("[name='vpmout[]']").each(function () {
            vpmout.push($(this).text());
            //alert($(this).text());
        });

        var votin = [];
        $("[name='votin[]']").each(function () {
            votin.push($(this).text());
            //alert($(this).text());
        });

        var votout = [];
        $("[name='votout[]']").each(function () {
            votout.push($(this).text());
            //alert($(this).text());
        });

        var token = $('#token').val();

        //No need for ajax setup if you're sending the token as a parameter
        // var like = 'fff';
//alert(console.log(startTime));
//alert(JSON.stringify(votout));
        // for(let i = 0; i < vdate.length; i++){
        //     //alert(console.log(startTime[i]));
        // }

        //alert(console.log(vdate)); 
        $.ajax({
            url:'update-dtr',
            type:'get',
            data:{ vdate:vdate, vamin:vamin, vamout:vamout, vpmin:vpmin, vpmout:vpmout, votin:votin, votout:votout,  idnumber:idnumber, '_token':token},
            //data:{ id:like,'_token':token},
                success:function(data){
                    //alert(data);
                    if (data == 'multiple'){
                        alert('Please update all multiple time logs in a cell.');
                    } else if (data == true){
                        alert('Successfully updated!');
                        location.reload();
                    } else {
                        alert('No changes have been made.');
                    }
                },
                error:function(request, status, error) {
                    alert(request.responseText);
                }
        })

    });
</script>


{{-- Transfer table values to controller --}}
{{-- <script>
    var TableData;
    TableData = saveTblValues()
    alert("1");
    TableData = $.toJSON(TableData);
    alert("2");

    function saveTblValues(){
        alert("3");
        var TableData = new Array();

        $('#editable tr').each(function(row, tr){
            TableData[row]=
        {
                  "col1" : $(tr).find('td:eq(0)').text() //for first column value
                , "col2" : $(tr).find('td:eq(1)').text()  //for second column value
                , "col3" : $(tr).find('td:eq(2)').text() //for third column value
                , "col4" : $(tr).find('td:eq(3)').text() // for fourth column value
                , "col5" : $(tr).find('td:eq(4)').text() 
                , "col6" : $(tr).find('td:eq(5)').text() 
                , "col7" : $(tr).find('td:eq(6)').text()
            }    
        }); 
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }

    $.ajax({
        type: "POST",
        url: "your route URL",
        data: "update-dtr/" + TableData,
        success: function(data){
            alert(data);
        },
        error: function (request, status, error) {
            alert(request.responseText);
        },
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        var TableData;
        TableData = saveTblValues()
        TableData = $.toJSON(TableData);

        $('select[name="branchunit_id_dtr"]').on('change',function(){
            var branchunitid = $(this).val();
            //alert(branchunitid);
            //clear sections
            //spinner('Loading...');
            $.ajax({
                type:"GET",
                url: "{{ url('lhios-sections/show/') }}"+"/"+branchunitid,  
                dataType: "json",
                cache: false,
                success: function(result){
                    alert(JSON.stringify(result));
                    // var d = $('select[name="lhiosection_id_dtr"]').empty();
                    //         $('select[name="lhiosection_id_dtr"]').append('<option value="""></option>'); 
                    // $.each(result, function(key, value){

                    //     $('select[name="lhiosection_id_dtr"]').append('<option value="'+value.lhiosection_id+'">'+value.title+'</option>');

                    // });
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                },
            });
        });
    });
</script> --}}