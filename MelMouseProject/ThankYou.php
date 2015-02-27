<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thank You!</title>
    </head>
    <body>
         <?php include("header.php");?>
        
        <img src="images/thanks.png" alt="Thank You" style="width:150px;height:200px"/>
        <?php
            
            if (isset($_SESSION['message'])){
                $msg = $_SESSION['message'];     
                echo $msg;            
            }
        ?>
        
     
        <?php include("footer.php");?>
    </body>
</html>
