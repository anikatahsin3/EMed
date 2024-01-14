<?php
/*
1.WE will receive data of Admin login information here
2.IF the data is valid, we will let the admin access Home Page.
3.Else forward to admin login page.
4.we will only need email and password to login.
aemail,apass
*/

 if($_SERVER['REQUEST_METHOD']=="POST"){
     //checking if the info are valid and not empty.
     if(
         !empty($_POST["aemail"]) && !empty($_POST["apass"]) &&
         isset($_POST["aemail"]) && isset($_POST["apass"]) 
       ){
         //storing the informations in variables     
         $email=$_POST["aemail"];
         $pass=$_POST["apass"];
         
         
         /*trying to access database and check if the login information are valid.*/
         try{
             //creating connection with EMed database
             $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
             $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             //database code executing
             $sqlquery="SELECT * FROM admin WHERE email='$email' AND password='$pass'";
             $returnobj=$conn->query($sqlquery);
             if($returnobj->rowCount()==1){
                 //it means this login information belongs to an Admin and is valid.
                 //login successful
                 session_start();
                 $_SESSION['useremail']=$email;
                 
                 //forwarding to home page
                 echo"<script>location.assign('adminpanel.php')</script>";  
             }
             else{
                 //the info is invalid and returning to login page
                 echo"<script>location.assign('adminlogin.php')</script>";         
             }             
         }catch(PDOException $ex){
             //if found error forward to login page
            echo"<script>location.assign('adminlogin.php')</script>";
         }
     }else{
         //if any value is empty or invalid, then forward to login page again.
         echo"<script>location.assign('adminlogin.php')</script>";
     }
 }
else{
    //forwarding to login page if not post method.
    echo"<script>location.assign('adminlogin.php')</scrpit>";
}
?>