<?php
/*
1.WE will receive data of Company Register information here
2.IF the data is valid, we will store it in Database and forward to login page.
3.Else forward to register page.
cname,cemail,cpass,caddress
*/

 if($_SERVER['REQUEST_METHOD']=="POST"){
     //checking if the info are valid and not empty.
     if(
         !empty($_POST["cname"]) && !empty($_POST["cemail"]) &&
         !empty($_POST["cpass"]) && !empty($_POST["ccontact"]) &&
         !empty($_POST["caddress"]) &&
         isset($_POST["cname"]) && isset($_POST["cemail"]) && 
         isset($_POST["cpass"]) && isset($_POST["ccontact"]) &&
         isset($_POST["caddress"])
       ){
         //storing the informations in variables
         $name=$_POST["cname"];
         $email=$_POST["cemail"];
         $pass=$_POST["cpass"];
         $contact=$_POST["ccontact"];
         $address=$_POST["caddress"];
         
         /*trying to access database and store all the information there.*/
         try{
             //creating connection with EMed database
             $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
             $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           
             //database code executing
             $sqlquery="INSERT INTO company(id,name,email,pass,contact_no,address) VALUES(NULL,'$name','$email','$pass','$contact','$address')";
             $conn->exec($sqlquery);
            
             //after successful registration forwarding to login page
             echo"<script>location.assign('login.php')</script>";
             
         }catch(PDOException $ex){
             //if found error forward to register page
            
            echo"<script>location.assign('register.php')</script>";
         }
     }else{
         //if any value is empty or invalid, then forward to register page again.
         
         echo"<script>location.assign('register.php')</script>";
     }
 }
else{
    //forwarding to register page if not post method.
    
    echo"<script>location.assign('register.php')</scrpit>";
}
?>