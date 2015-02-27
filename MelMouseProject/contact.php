<html>
<head>
    <style>
        
    </style>
    <script type="text/javascript" src="JavaScript/utilities.js"></script>
   
</head>
<body> 
<?php include("header.php");?>
<?php include("database.php");?>
  
    
<form id="contact" name="contact" method="post" action="database.php">
<input type="hidden" name="hiddenvalue" value="ContactAdd">    
<h3>Contact Information</h3>
<div class="attr1" id='lname'>Name</div><div class="attr2"><input type="text"  id='fname' name='fname'/></div>
<div class="attr1" id='lemail'>Email</div><div class="attr2"><input type="text" id='femail' name='femail'  placeholder="id@domain"/></div>
<div class="attr1" id='lsubject'>Subject</div><div class="attr2"><input type="text" id='fsubject' name='fsubject'/></div>
<div class="attr1" id='fdescription'>Description</div><div class="attr2"><textarea rows="10" cols="40" id='fdescription' name='fdescription'></textarea></div>
<div class="attr1">&nbsp;</div><div class="attr2">
<input type="submit" name='submit' style="width: 133px" value="Submit" class="small button"/>&nbsp;<input type="reset" style="width: 133px" value="Reset" class="small button" /></div>
<span class="error" id="ErrorMessage" style="visibility: hidden">
        Error Message
</span>
</form>
<script>
var validations = [];
validations[0] = ["document.contact.fname", "notblank", "Name is required", "ErrorMessage"];
validations[1] = ["document.contact.femail", "validemail", "A valid email is required","ErrorMessage"];
validations[2] = ["document.contact.fsubject", "notblank", "Subject is required","ErrorMessage"];
validations[3] = ["document.contact.fdescription", "notblank", "Description is required","ErrorMessage"];

window.onload = function () {
    document.getElementById("contact").onsubmit = function () {
        return validate();
    }
}
</script>
<?php include("footer.php");?>
</body> 
</html>

