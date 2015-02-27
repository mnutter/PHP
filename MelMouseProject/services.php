<?php 

include("database.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Services</title>
        <link href="styles/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include("header.php");?>
        
      
        <?php
            //Get the services
            $data = GetServices("where 1", "Order by id");               
    
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th><th>Name</th><th>Unit</th><th>Price</th><th>Note</th><th>Active</th>";
            echo "</tr>";
            echo "<tr>";                
            echo "<td><a href='service_maintenance.php?service_id=new'>New</a></td><td></td><td class='align-right'></td><td class='align-right'></td><td></td><td class='align-center'></td>";
            echo "</tr>";
            
            //Build the combo box
            foreach ($data as $row)
            {   
                echo "<tr>";                
                echo "<td><a href='service_maintenance.php?service_id={$row['id']}'>{$row['id']}</a></td><td>{$row['name']}</td><td class='align-right'>{$row['unit']}</td><td class='align-right'>{$row['price']}</td><td>{$row['note']}</td><td class='align-center'>{$row['active']}</td>";
                echo "</tr>";
            }  
          
            echo "</table>";
        ?>
        
     
        <?php include("footer.php");?>
    </body>
</html>
