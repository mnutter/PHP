<html>
<head>
 
    <link href="JavaScript/jquery-ui-1.11.3.custom/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <style>
        
    </style>
    <script type="text/javascript" src="JavaScript/utilities.js"></script>
    <script type="text/javascript" src="JavaScript/creditcard.js"></script>
    <script src="JavaScript/jquery-ui-1.11.3.custom/external/jquery/jquery.js" type="text/javascript"></script>
    <script src="JavaScript/jquery-ui-1.11.3.custom/jquery-ui.js" type="text/javascript"></script>
     
</head>
<body>
<?php include("header.php");?>
<?php include("database.php");?>
    
<form id="frame1" name="frame1" method="post" action="database.php">
<input type="hidden" name="hiddenvalue" value="ServiceRequestAdd">
<section id="main">
<h3>General Information</h3>
<div class="attr1">Name</div><div class="attr2"><input type="text" id='fname' name='fname' ></div>
<div div class="attr1">Address</div><div class="attr2"><input type="text" id='faddress' name='faddress' /></div>
<div div class="attr1">City</div><div class="attr2"><input type="text" id='fcity' name='fcity' /></div>
<div div class="attr1">Phone</div><div class="attr2"><input type="text" id='fphone' name='fphone' placeholder="(000) 000-0000" /></div>
<div div class="attr1">Email</div><div class="attr2"><input type="text" id='femail' name='femail' placeholder="id@domain"/></div>

<h3>Service Requested</h3>
<div class="attr1">Type of Service</div><div class="attr2">
 <select  id='fservice' name='fservice'>
   <?php 
        //Get active services
        $data = GetServices("where active = 1","Order By name");               
    
        //Build the combo box
        foreach ($data as $row)
        {       
            echo "<option value={$row['id']}>{$row['name']}</option>";
        }
    ?>
       
   
</select> 

</div>
<div  class="attr1">Date of Request</div><div class="attr2"><input type="text" class="datepicker" id='frequest_date' name='frequest_date' placeholder="dd/mm/yyyy"/></div>
<div  class="attr1">Date of Completion</div><div class="attr2"><input type="text" class="datepicker" id='fcomplete_date' name='fcomplete_date' placeholder="dd/mm/yyyy"/></div>

<div class="attr1">Note</div><div class="attr2"><textarea rows="5" cols="40" id='fnote' name='fnote'></textarea></div>

<h3>Payment</h3>
<div id="ucsd">
<div  class="attr1">Index Number</div><div class="attr2"><input type="text" class="ucsd" id='findex' name='findex'/></div></div>

<h3>Billing Info</h3>
<div  class="attr1">Bill to:</div><div class="attr2"><input type="text" id='fbillto'name='fbillto' /></div>
<div  class="attr1">Address</div><div class="attr2"><input type="text" id='fbill_address' name='fbill_address'/></div>
<div  class="attr1">Email</div><div class="attr2"><input type="text" id='fbill_email' name='fbill_email' placeholder="id@domain"/></div>
<div  class="attr1">&nbsp;</div><div class="attr2">
<input type="submit" name='submit' style="width: 133px" value="Submit" class="small button"/>&nbsp;<input type="reset" style="width: 133px" value="Reset" class="small button" /></div>
			
</section>
</form>
<span class="error" id="ErrorMessage" style="visibility: hidden">
        Error Message
</span>
</form>
<script>
var validations = [];
validations[0] = ["document.frame1.fname", "notblank", "Name is required", "ErrorMessage"];
validations[1] = ["document.frame1.faddress", "notblank", "Address is required","ErrorMessage"];
validations[2] = ["document.frame1.fcity", "notblank", "City is required","ErrorMessage"];
validations[3] = ["document.frame1.fphone", "validphone", "A valid phone is required","ErrorMessage"];
validations[4] = ["document.frame1.femail", "validemail", "A valid email is required","ErrorMessage"];
validations[5] = ["document.frame1.fservice", "notblank", "Service is required","ErrorMessage"];
validations[6] = ["document.frame1.frequest_date", "validdate", "A valid date is required","ErrorMessage"];
validations[7] = ["document.frame1.fcomplete_date", "validdate", "A valid date is required","ErrorMessage"];
validations[8] = ["document.frame1.fnote", "notblank", "Note is required","ErrorMessage"];
validations[9] = ["document.frame1.findex", "isInteger", "An integer Index is required","ErrorMessage"];
validations[10] = ["document.frame1.fbillto", "notblank", "Bill To is required","ErrorMessage"];
validations[11] = ["document.frame1.fbill_address", "notblank", "Address is required","ErrorMessage"];
validations[12] = ["document.frame1.fbill_email", "validemail", "A valid email is required","ErrorMessage"];

window.onload = function () {
    document.getElementById("findex").onkeypress = function () {
                return isNumberInput(this,event);
            }
    document.getElementById("frame1").onsubmit = function () {
        return validate();
    }
}

$(function() {
    $( ".datepicker" ).datepicker();
  });
</script>
<?php include("footer.php");?>
</body> 
</html>
