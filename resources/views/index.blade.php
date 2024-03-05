<!DOCTYPE html>
<html>
    <head>
        <title>DTR Logs Management</title>

        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


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

    </head>
    <body>
        
        <div class="container">
            
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <!-- Alert message (start) -->
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        {{ Session::get('message') }}
                    </div>
                    @endif 
                    <!-- Alert message (end) -->

                    <form action="{{route('uploadFile')}}" enctype='multipart/form-data' method="post" >
                        {{csrf_field()}}

                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 1: </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Upload DTR Logs (Compatible Devices: Granding and Veterans)</p>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <input type='file' name='file' class="form-control">

                                @if ($errors->has('file'))
                                    <span class="errormsg text-danger">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                        {{-- </div>

                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="submit" value='Upload' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>

                    </form>
                    <br /><br />

                    <form action="{{route('generateDtrByYearMoOfficePdf')}}" enctype='multipart/form-data' method="get" target="_blank">
                        {{csrf_field()}}
                    
                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 2A: </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Generate DTR by Year, Month & Office(PDF)</p>
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

                            @endphp

                                <div class="form-group" style="display:none">
                                    <label class="control-label">Region</label>                                        
                                    <select class="custom-select" name="pro_id_dtr" required readonly>
                                        <option value=""></option>
                                        @foreach($pros as $row_p)
                                            @if($row_p->pro_id == '1')
                                                <option value="{{ $row_p->pro_id }}"  selected>{{ $row_p->title }}</option>
                                            @else
                                                <option value="{{ $row_p->pro_id }}">{{ $row_p->title }}</option>    
                                            @endif
                                            
                                        @endforeach
                                    </select>                      
                                    {{-- @error('region_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                       --}}
                                </div>

                                {{-- <div class="form-group"> --}}
                                    <label>Branch / Unit</label>
                                    <select name="branchunit_id_dtr" required>
                                        <option value=""></option>
                                        @foreach($branchunits as $row_b)
                                            <option value="{{ $row_b->branchunit_id }}">{{ $row_b->title }}</option>                                            
                                        @endforeach
                                    </select>
                                {{-- </div> --}}

                                {{-- <div class="form-group"> --}}
                                    <label>LHIO/Section</label>
                                    <select name="lhiosection_id_dtr">
                                        <option value=""></option></select>
                                {{-- </div> --}}
                                {{-- <div class="form-group">
                                    <label class="control-label">LHIO/Section</label>
                                    <select class="custom-select" name="lhiosection_id_dtr">
                                        <option value=""></option></select>
                                        @foreach($lhiosections as $row_l)
                                            <option value="{{ $row_l->lhiosection_id }}">{{ $row_l->title }}</option>                                            
                                        @endforeach
                                    </select>
                                </div> --}}

                        {{-- </div> --}}
    {{-- 
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="generateDtrByYearMoOfficePdf" value='Generate DTR by Year, Month & Office' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>

                    </form>
                    <br /><br />

                    {{-- Generate DTR by Year & Month (PDF) --}}
                    <form action="{{route('generateDtrByYearMoPdf')}}" enctype='multipart/form-data' method="get" target="_blank" style="display:none">
                        {{csrf_field()}}
    
                        <div class="form-group">
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
                            @endphp
    
                        {{-- </div> --}}
    {{-- 
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="generateDtrByYearMoPdf" value='Generate DTR by Year & Month' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>
    
                    </form>
                    {{-- <br /><br /> --}}

                    <form action="{{route('generateDtrByYearMoIdNumPdf')}}" enctype='multipart/form-data' method="get" target="_blank">
                        {{csrf_field()}}

                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 2B (Optional): </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Generate DTR by Year, Month & ID Number (PDF)</p>
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
                                echo "<br />";
                                echo "<label>Employee / ID Number</label>";
                                echo "<input type='text' name='employee_no' required>";
                            @endphp

                        {{-- </div> --}}
    {{-- 
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="generateDtrByYearMoIdNumPdf" value='Generate DTR by Year, Month & ID Number' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>

                    </form>
                    <br /><br />
{{-- Generate DTR by Year & Month (PDF) --}}
                    <form action="{{route('generateDtrByYearMoPdf')}}" enctype='multipart/form-data' method="get" target="_blank" style="display:none">
                        {{csrf_field()}}
    
                        <div class="form-group">
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
                            @endphp
    
                        {{-- </div> --}}
    {{-- 
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="generateDtrByYearMoPdf" value='Generate DTR by Year & Month' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>
    
                    </form>
                    {{-- <br /><br /> --}}
                    
                    <form action="{{route('updateDtrByIdNumberForm')}}" enctype='multipart/form-data' method="get" target="_blank">
                        {{csrf_field()}}

                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 3 (Optional): </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Update DTR by ID Number</p>
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
                                echo "<br />";
                                echo "<label>Employee / ID Number</label>";
                                echo "<input type='text' name='employee_no' required>";
                            @endphp

                        {{-- </div> --}}
    {{-- 
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="updateDtrByIdNumberForm" value='Update DTR by ID Number' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>

                    </form>
                    <br /><br />

                    <form action="{{route('pipsConversionPerOffice')}}" enctype='multipart/form-data' method="post" >
                        {{csrf_field()}}
                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 4A: </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Generate PIPS File Version Per Office</p>
                            @php
                                $curYearP = date('Y');
                                echo "<label>Select Year</label>";
                                echo "<select name='yearPo'>";
                                    for ($year=2020; $year <= $curYearP; $year++){
                                        $selected = ($curYearP == $year ? 'selected' : '');
                                        echo "<option value='".$year."' ".$selected.">".$year."</option>"; 
                                    }
                                echo "</select>";
                                echo "<br />";

                                $curMonthP = date('m');
                                echo "<label>Select Month</label>";
                                echo "<select name='monthPo'>";
                                    $selectedMoP = ($curMonthP == '01' ? 'selected' : '');
                                    echo "<option value='01'".$selectedMoP.">January</option>"; 
                                    $selectedMoP = ($curMonthP == '02' ? 'selected' : '');
                                    echo "<option value='02'".$selectedMoP.">February</option>"; 
                                    $selectedMoP = ($curMonthP == '03' ? 'selected' : '');
                                    echo "<option value='03'".$selectedMoP.">March</option>"; 
                                    $selectedMoP = ($curMonthP == '04' ? 'selected' : '');
                                    echo "<option value='04'".$selectedMoP.">April</option>"; 
                                    $selectedMoP = ($curMonthP == '05' ? 'selected' : '');
                                    echo "<option value='05'".$selectedMoP.">May</option>"; 
                                    $selectedMoP = ($curMonthP == '06' ? 'selected' : '');
                                    echo "<option value='06'".$selectedMoP.">June</option>";
                                    $selectedMoP = ($curMonthP == '07' ? 'selected' : ''); 
                                    echo "<option value='07'".$selectedMoP.">July</option>";
                                    $selectedMoP = ($curMonthP == '08' ? 'selected' : ''); 
                                    echo "<option value='08'".$selectedMoP.">August</option>";
                                    $selectedMoP = ($curMonthP == '09' ? 'selected' : ''); 
                                    echo "<option value='09'".$selectedMoP.">September</option>";
                                    $selectedMoP = ($curMonthP == '10' ? 'selected' : ''); 
                                    echo "<option value='10'".$selectedMoP.">October</option>";
                                    $selectedMoP = ($curMonthP == '11' ? 'selected' : ''); 
                                    echo "<option value='11'".$selectedMoP.">November</option>";
                                    $selectedMoP = ($curMonthP == '12' ? 'selected' : ''); 
                                    echo "<option value='12'".$selectedMoP.">December</option>"; 
                                echo "</select>";
                            @endphp

                            <div class="form-group" style="display:none">
                                <label class="control-label">Region</label>                                        
                                <select class="custom-select" name="pro_id_pips" required readonly>
                                    <option value=""></option>
                                    @foreach($pros as $row_p)
                                        @if($row_p->pro_id == '1')
                                            <option value="{{ $row_p->pro_id }}"  selected>{{ $row_p->title }}</option>
                                        @else
                                            <option value="{{ $row_p->pro_id }}">{{ $row_p->title }}</option>    
                                        @endif
                                        
                                    @endforeach
                                </select>                      
                                {{-- @error('region_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                       --}}
                            </div>

                            {{-- <div class="form-group"> --}}
                                <label>Branch / Unit</label>
                                <select name="branchunit_id_pips" required>
                                    <option value=""></option>
                                    @foreach($branchunits as $row_bu)
                                        <option value="{{ $row_bu->branchunit_id }}">{{ $row_bu->title }}</option>                                            
                                    @endforeach
                                </select>
                            {{-- </div>

                            <div class="form-group"> --}}
                                <label >LHIO/Section</label>
                                <select name="lhiosection_id_pips">
                                    <option value=""></option></select>
                            {{-- </div> --}}
                            {{-- <div class="form-group">
                                <label class="control-label">LHIO/Section</label>
                                <select class="custom-select" name="lhiosection_id_dtr">
                                    <option value=""></option></select>
                                    @foreach($lhiosections as $row_l)
                                        <option value="{{ $row_l->lhiosection_id }}">{{ $row_l->title }}</option>                                            
                                    @endforeach
                                </select>
                            </div> --}}
                            
                            {{-- <div class="form-group"> --}}
                                {{-- <div class="col-md-6"> --}}
                                <input type="submit" name="convToPipsPerOffice" value='Convert to PIPS Per Office' class='btn btn-success'>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </form>
                    <br /><br />

                    <form action="{{route('pipsConversionV2')}}" enctype='multipart/form-data' method="post" >
                        {{csrf_field()}}
    
                        <div class="form-group">
                            <strong><p style="color:darkblue; font-size:28px; text-align: center;">STEP 4B (Optional): </p></strong>
                            <p style="color:blue; font-size:28px; text-align: center;">Generate PIPS File Version</p>
                            @php
                                $curYearP = date('Y');
                                echo "<label>Select Year</label>";
                                echo "<select name='yearP'>";
                                    for ($year=2020; $year <= $curYearP; $year++){
                                        $selected = ($curYearP == $year ? 'selected' : '');
                                        echo "<option value='".$year."' ".$selected.">".$year."</option>"; 
                                    }
                                echo "</select>";
                                echo "<br />";
    
                                $curMonthP = date('m');
                                echo "<label>Select Month</label>";
                                echo "<select name='monthP'>";
                                    $selectedMoP = ($curMonthP == '01' ? 'selected' : '');
                                    echo "<option value='01'".$selectedMoP.">January</option>"; 
                                    $selectedMoP = ($curMonthP == '02' ? 'selected' : '');
                                    echo "<option value='02'".$selectedMoP.">February</option>"; 
                                    $selectedMoP = ($curMonthP == '03' ? 'selected' : '');
                                    echo "<option value='03'".$selectedMoP.">March</option>"; 
                                    $selectedMoP = ($curMonthP == '04' ? 'selected' : '');
                                    echo "<option value='04'".$selectedMoP.">April</option>"; 
                                    $selectedMoP = ($curMonthP == '05' ? 'selected' : '');
                                    echo "<option value='05'".$selectedMoP.">May</option>"; 
                                    $selectedMoP = ($curMonthP == '06' ? 'selected' : '');
                                    echo "<option value='06'".$selectedMoP.">June</option>";
                                    $selectedMoP = ($curMonthP == '07' ? 'selected' : ''); 
                                    echo "<option value='07'".$selectedMoP.">July</option>";
                                    $selectedMoP = ($curMonthP == '08' ? 'selected' : ''); 
                                    echo "<option value='08'".$selectedMoP.">August</option>";
                                    $selectedMoP = ($curMonthP == '09' ? 'selected' : ''); 
                                    echo "<option value='09'".$selectedMoP.">September</option>";
                                    $selectedMoP = ($curMonthP == '10' ? 'selected' : ''); 
                                    echo "<option value='10'".$selectedMoP.">October</option>";
                                    $selectedMoP = ($curMonthP == '11' ? 'selected' : ''); 
                                    echo "<option value='11'".$selectedMoP.">November</option>";
                                    $selectedMoP = ($curMonthP == '12' ? 'selected' : ''); 
                                    echo "<option value='12'".$selectedMoP.">December</option>"; 
                                echo "</select>";
                            @endphp
    
                        {{-- </div>
    
                        <div class="form-group">
                            <div class="col-md-6"> --}}
                            <input type="submit" name="convToPips" value='Convert to PIPS' class='btn btn-success'>
                            {{-- </div> --}}
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </body>
</html>


{{-- Populate Departments --}}
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('select[name="office"]').on('change',function(){
            var officeid = $(this).val();
            //alert(officeid);
            //clear department and sections
            $('select[name="department"]').empty();
            $('select[name="section"]').empty();
            if (officeid) {//with selected item
                spinner('Loading...');
                $.ajax({
                    type:"GET",
                    url: "{{ url('location-management/departments-office/show/') }}"+"/"+officeid,  
                    dataType: "json",
                    cache: false,
                    success: function(result){
                        //alert(JSON.stringify(result));
                        var d = $('select[name="department"]').empty();
                                $('select[name="department"]').append('<option value="""></option>'); //first item
                        $.each(result, function(key, value){

                            $('select[name="department"]').append('<option value="'+value.id+'">'+value.title+'</option>');

                        });
                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                    },
                });
            } else {   
                //alert('No selected item.');
            }
        });
    });
</script> --}}
{{-- /Populate Departments --}}



<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/app.min.js')}}"></script>




{{-- Populate LHIO / SECTION DTR GENERATION --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="branchunit_id_dtr"]').on('change',function(){
            var branchunitid = $(this).val();
            //alert(branchunitid);
            //clear sections
            $('select[name="lhiosection_id_dtr"]').empty();
            if (branchunitid) {//with selected item
                //spinner('Loading...');
                $.ajax({
                    type:"GET",
                    url: "{{ url('lhios-sections/show/') }}"+"/"+branchunitid,  
                    dataType: "json",
                    cache: false,
                    success: function(result){
                        //alert(JSON.stringify(result));
                        var d = $('select[name="lhiosection_id_dtr"]').empty();
                                $('select[name="lhiosection_id_dtr"]').append('<option value="""></option>'); 
                        $.each(result, function(key, value){

                            $('select[name="lhiosection_id_dtr"]').append('<option value="'+value.lhiosection_id+'">'+value.title+'</option>');

                        });
                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                    },
                });
            } else {   
                //alert('No selected item.');
            }
        });
    });
</script>
{{-- /Populate LHIO / SECTION DTR GENERATION --}}

{{-- Populate LHIO / SECTION PIPS GENERATION --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="branchunit_id_pips"]').on('change',function(){
            var branchunitid = $(this).val();
            //alert(branchunitid);
            //clear sections
            $('select[name="lhiosection_id_pips"]').empty();
            if (branchunitid) {//with selected item
                //spinner('Loading...');
                $.ajax({
                    type:"GET",
                    url: "{{ url('lhios-sections/show/') }}"+"/"+branchunitid,  
                    dataType: "json",
                    cache: false,
                    success: function(result){
                        //alert(JSON.stringify(result));
                        var d = $('select[name="lhiosection_id_pips"]').empty();
                                $('select[name="lhiosection_id_pips"]').append('<option value="""></option>'); 
                        $.each(result, function(key, value){

                            $('select[name="lhiosection_id_pips"]').append('<option value="'+value.lhiosection_id+'">'+value.title+'</option>');

                        });
                    },
                    error: function (request, status, error) {
                        //alert(request.responseText);
                    },
                });
            } else {   
                //alert('No selected item.');
            }
        });
    });
</script>
{{-- /Populate LHIO / SECTION PIPS GENERATION --}}