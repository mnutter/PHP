<html>
 
    <head>
        <meta charset="UTF-8">
        <title>Service Maintenance </title>
        <script type="text/javascript" src="JavaScript/utilities.js"></script>
    </head>
    <body>
<?php 
include("database.php");
$service_id = $_GET['service_id'];

$service_name = '';
$unit = '';
$price = '';
$note = '';
$active = 'checked';  //Active
    
if(isset($service_id) && $service_id=='new'){
    //Allow all fields
    $readonly = '';
    $readonly_add = 'readonly';
    $add_or_update = 'ServiceAdd';
}
else{
    $readonly = 'readonly';
    $readonly_add = '';
    $data = GetService($service_id); 
    $service_id = $data['id'];
    $service_name = $data['name'];
    $unit = $data['unit'];
    $price = $data['price'];
    $note = $data['note'];
    $active = ($data['active']==1?'checked':'');  
    $add_or_update = 'ServiceUpdate';
}

?>
        <?php include("header.php");?>
      
        <form id="service_maintenance" name="service_maintenance" method="post" action="database.php">
        <input type="hidden" name="hiddenvalue" value="<?php echo $add_or_update ?>"> 
        
        <h3>Service Information</h3>
        <div class="attr1">Service ID</div><div class="attr2"><input type="text" id="service_id" name="service_id" value="<?php echo $service_id ?>" <?php echo $readonly_add; ?> <?php echo $readonly; ?>/></div>
        <div class="attr1">Name of service</div><div class="attr2"><input type="text" id="service_name"  name="service_name" value="<?php echo $service_name ?>" <?php echo $readonly; ?>/></div>
        <div class="attr1">Unit</div><div class="attr2"><input type="text"  id="unit"  name="unit" value="<?php echo $unit ?>" <?php echo $readonly; ?>/></div>
        <div class="attr1">Price/Unit </div><div class="attr2"><input type="text" id="price" name="price" value="<?php echo $price ?>" <?php echo $readonly; ?>/></div>
        <div class="attr1">Note</div><div class="attr2"><textarea rows="5" cols="40" id="note" name="note" <?php echo $readonly; ?>/> <?php echo $note ?> </textarea></div>
        <div class="attr1">Active </div><div class="attr2"><input type="checkbox" id="active" name="active" value="1" <?php echo $active ?>/></div>
        <span class="error" id="ErrorMessage" style="visibility: hidden">
                Error Message
        </span>
        <input type="submit" name='submit' style="width: 133px" value="Submit" class="small button"/>&nbsp;
       
        </form>
        <script>
        var validations = [];        
        validations[0] = ["document.service_maintenance.service_name", "notblank", "Service Name is required","ErrorMessage"];
        validations[1] = ["document.service_maintenance.unit", "isInteger", "An integer Unit is required","ErrorMessage"];
        validations[2] = ["document.service_maintenance.price", "isDecimal", "A numeric Price is required","ErrorMessage"];

        window.onload = function () {
             document.getElementById("unit").onkeypress = function () {
                return isNumberInput(this,event);
            }
            document.getElementById("service_maintenance").onsubmit = function () {
                return validate();
            }
        }
        </script>
       
    </body>
</html>
