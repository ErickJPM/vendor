<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "TestDB";
    $table = "Students"; 
 
    //This command came from the app, you will see it soon 
    $action = $_POST["action"];
     
    // Create Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check Connection
    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
        return;
    } 
    // If connection is OK...
 
    // For table creation, temporal table maybe for shopping cart and so on 
    if("CREATE_TABLE" == $action){
        $sql = "CREATE TABLE IF NOT EXISTS $table ( 
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(50) NOT NULL,
            last_name VARCHAR(50) NOT NULL,
            last_name2 VARCHAR(50) NOT NULL,
            phone_number VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            matricula VARCHAR(50) NOT NULL,
            u_foto TEXT(64000) NOT NULL
            )";
 
        if($conn->query($sql) === TRUE){
            // send back success message
            echo "success";
        }else{
            echo "error";
        }
        $conn->close();
        return;
    }

    //SELECT ALL THE DATA
    if("SELECT_TABLE" == $action){
         $database_data = array();         
         $sql = "SELECT 
            id ,
            first_name,
            last_name,
            last_name2,
            phone_number,
            email,
            matricula,
            u_foto
            FROM $table ORDER BY id ASC";
            $result = $conn->query($sql);
            
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $database_data[]=$row;
            }
            echo json_encode($database_data );
        }else{
            echo "error";
        }
        $conn->close();
        return;
    }
    //Check ALL THE DATA
    if("CHECK_TABLE" == $action){
        $database_data = array();   
        $matricula = $_POST["matricula"];      
        $sql = "SELECT 
           id ,
           first_name,
           last_name,
           last_name2,
           phone_number,
           email,
           matricula,
           u_foto
           FROM $table WHERE matricula = $matricula ";
           $result = $conn->query($sql);
           
       if($result->num_rows>0){
           while($row = $result->fetch_assoc()){
               $database_data[]=$row;
           }
           echo json_encode($database_data );
       }else{
           echo "error";
       }
       $conn->close();
       return;
   }
   if("UPDATE_DATA" == $action){
    $ID = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $last_name2 = $_POST["last_name2"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $matricula = $_POST["matricula"];
    $u_foto = $_POST["u_foto"];

    $sql = "UPDATE $table SET `first_name`='$first_name',`last_name`='$last_name', `last_name2`='$last_name2',`phone_number`='$phone_number',`email`='$email',`matricula`='$matricula',`u_foto`='$u_foto' WHERE id = $ID";      
    $result = $conn->query($sql);
    echo "success";            
    $conn->close();
    return;
    }
    //Save Data
    if("INSERT_DATA" == $action){
       $first_name = $_POST["first_name"];
       $last_name = $_POST["last_name"];
       $last_name2 = $_POST["last_name2"];
       $phone_number = $_POST["phone_number"];
       $email = $_POST["email"];
       $matricula = $_POST["matricula"];
       $u_foto = $_POST["u_foto"];

       $sql = "INSERT INTO $table (first_name,last_name,last_name2,phone_number,email,matricula,u_foto)VALUES('$first_name','$last_name','$last_name2','$phone_number','$email','$matricula','$u_foto')";      
       $result = $conn->query($sql);
       echo "success";            
       $conn->close();
       return;
   }
   //Update y Delete 
   if("DELETE_DATA" == $action){
        $ID = $_POST["id"];
        $sql = "DELETE FROM $table WHERE id = $ID";      
        $result = $conn->query($sql);
        echo "success";            
        $conn->close();
        return;
    }
    
    ?>