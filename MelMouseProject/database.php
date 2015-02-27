<?php
//Start a session
session_start();
     
include("utilities.php");
   
$db = "";

//Forms posted
if (isset($_POST['submit'])){
        
    switch($_POST['hiddenvalue']) {
        case 'ServiceRequestAdd':
            AddServiceRequest();
            break;
        
        case 'ContactAdd':  
            AddContact();        
            break;
        
        case 'ServiceAdd':    
            AddService();        
            break;
        
        case 'ServiceUpdate':                    
            UpdateService();        
            break;
        
    }
}
function dbConnection(){
    //Connect to the database
    global $db;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=test","root","",$options);
    } catch (Exception $ex) {
        $err_msg = $ex->getMessage();
        echo "There was an error connection to the database.";
        echo "Error message: " . $err_msg;
        exit();
    }
}
function GetServices($where, $orderBy)
 {
    global $db;
    $data = "";
    
    try{
        dbConnection();
        
        $query ="Select id, name, unit, price, note, case when active = 1 then 'Yes' else 'No' end as active From service " . $where . " " . $orderBy;
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetchAll();
        $statement->closeCursor();
    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in GetServices.";
        echo "Error message: " . $err_msg;
        exit();
     }

    //Return an array for all of the rows of the result set
    return $data;

 }


 function AddServiceRequest(){
    //Add the Service Request data   
     
     global $db;

      
    try{
      
        $name = $_POST['fname'];
        $address = $_POST['faddress'];
        $city = $_POST['fcity'];
        $phone = $_POST['fphone'];
        $email = $_POST['femail'];
        $service = $_POST['fservice'];
        $request_date = $_POST['frequest_date'];
        $complete_date = $_POST['fcomplete_date'];
        $note = $_POST['fnote'];
        $index = $_POST['findex'];
        $bill_to = $_POST['fbillto'];
        $bill_address = $_POST['fbill_address'];
        $bill_email = $_POST['fbill_email'];

        //Connect to the database
        dbConnection();

        //Insert the data
        $query = "Insert into service_request
                             (name,address,city,phone,email,service,request_date,complete_date,note,index_nbr,bill_to,bill_address,bill_email)
                      values (:name,:address,:city,:phone,:email,:service,:request_date,:complete_date,:note,:index,:bill_to,:bill_address,:bill_email)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name',$name);
        $statement->bindValue(':address',$address);
        $statement->bindValue(':city',$city);
        $statement->bindValue(':phone',$phone);
        $statement->bindValue(':email',$email);
        $statement->bindValue(':service',$service);
        $statement->bindValue(':request_date',$request_date);
        $statement->bindValue(':complete_date',$complete_date);
        $statement->bindValue(':note',$note);
        $statement->bindValue(':index',$index);
        $statement->bindValue(':bill_to',$bill_to);
        $statement->bindValue(':bill_address',$bill_address);
        $statement->bindValue(':bill_email',$bill_email);
        $success = $statement->execute();
        $row_count = $statement->rowcount();
        $statement->closeCursor();
        
        //Get the last id inserted
        $id = $db->lastInsertId();


        if($success){
          $message = "Your Service Request ID is $id.  We will respond shortly.";  
        }
        else{
          $message = "Error: No rows were inserted for Service Request.";  
        }
        
        //Pass message via session.  Don't want the information in a url
        $_SESSION['message'] = $message;
        
        
        //Mail a copy of the request
        mail_request("support@ucsd.edu","Service Request",$message,$email);
        
        
        //Redirect to Thank You page
        header('Location: ThankYou.php');

    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in AddServiceRequest.";
        echo "Error message: " . $err_msg;
        exit();
     }
 }
 
 
 function AddContact(){
    //Add the Contact data   
    global $db;
      
    try{
        $name = $_POST['fname'];
        $email = $_POST['femail'];
        $subject = $_POST['fsubject'];
        $description = $_POST['fdescription'];
 
        //Connect to the database
        dbConnection();

        //Insert the data
        $query = "Insert into contact
                         (name,email,subject,description)
                  values (:name,:email,:subject,:description)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name',$name);
        $statement->bindValue(':email',$email);
        $statement->bindValue(':subject',$subject);
        $statement->bindValue(':description',$description);
        $success = $statement->execute();
        $row_count = $statement->rowcount();
        $statement->closeCursor();
        
        //Get the last id inserted
        $id = $db->lastInsertId();

        
        if($success){
          $message = "Your Contact Request ID is $id.  We will respond shortly.";  
        }
        else{
          $message = "Error: No rows were inserted for Contact.";  
        }
        
        //Pass message via session.  Don't want the information in a url
        $_SESSION['message'] = $message;
        
        
        //Mail a copy of the request
        mail_request("support@ucsd.edu","Contact Request",$message,$email);
        
        
        //Redirect to Thank You page
        header('Location: ThankYou.php');
        
    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in AddService.";
        echo "Error message: " . $err_msg;
        exit();
     }
 }
 
 function GetService($service_id){
    global $db;
    $data = "";
    
    try{
        dbConnection();
        
        $query ="Select id, name, unit, price, note, active from service where id= '" . $service_id . "'";
        $statement = $db->prepare($query);
        $statement->execute();
        $data = $statement->fetch();
        $statement->closeCursor();
    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in GetService ID= $service_id.";
        echo "Error message: " . $err_msg;
        exit();
     }

    //Return an array for next row in resultset.
    return $data;    
 }
 
 function AddService(){
   //Add the Contact data   
    global $db;
      
    try{
                
        $service_name = $_POST['service_name'];
        $unit = $_POST['unit'];
        $price = $_POST['price'];
        $note = $_POST['note'];
        $active = ($_POST['active']?1:0);        
       
        //Connect to the database
        dbConnection();

        //Insert the data
        $query = "Insert into service
                         (name,unit,price,note,active)
                  values (:name,:unit,:price,:note,:active)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name',$service_name);
        $statement->bindValue(':unit',$unit);
        $statement->bindValue(':price',$price);
        $statement->bindValue(':note',$note);
        $statement->bindValue(':active',$active);
        $success = $statement->execute();
        $row_count = $statement->rowcount();
        $statement->closeCursor();
        
        //Get the last id inserted
        $id = $db->lastInsertId();

        
        if($success){
          $message = "Service ID $id was added.";  
        }
        else{
          $message = "Error: No rows were inserted for Service.";  
        }
        
        //Mail a copy of the request
        mail_request("support@ucsd.edu","Service",$message,"support@ucsd.edu");
        
        
        //Redirect to service page
        header('Location: services.php');

    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in AddContact.";
        echo "Error message: " . $err_msg;
        exit();
     }
 }
 
 function UpdateService(){
    //Update the Service data 
    global $db;
      
    try{
                
        $service_id = $_POST['service_id'];
        $active = ($_POST['active']?1:0);
        
        //Connect to the database
        dbConnection();

        //Insert the data
        $query = "Update service
                     Set active = :active
                   Where id = :service_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':active',$active);
        $statement->bindValue(':service_id',$service_id);
        $success = $statement->execute();
        $row_count = $statement->rowcount();
        $statement->closeCursor();
       
             
        //Redirect to services page
        header('Location: services.php');

    } catch (Exception $ex)
     {
        $err_msg = $ex->getMessage();
        echo "There was an error in UpdateService.";
        echo "Error message: " . $err_msg;
        exit();
     }
 }


?>
