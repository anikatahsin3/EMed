<?php
/*
1.WE will receive data of Company login information here
2.IF the data is valid, we will let the company access Home Page.
3.Else forward to login page.
4.we will only need email and password to login.
cemail,cpass
*/

 if($_SERVER['REQUEST_METHOD']=="POST"){
     //checking if the info are valid and not empty.
     if(
         !empty($_POST["cemail"]) && !empty($_POST["cpass"]) &&
         isset($_POST["cemail"]) && isset($_POST["cpass"]) 
       ){
         //storing the informations in variables     
         $email=$_POST["cemail"];
         $pass=$_POST["cpass"];
         
         
         /*trying to access database and check if the login information are valid.*/
         try{
             //creating connection with EMed database
             $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
             $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
             //database code executing
             $sqlquery="SELECT * FROM company WHERE email='$email' AND pass='$pass' AND status=1";
             $returnobj=$conn->query($sqlquery);
             if($returnobj->rowCount()==1){
                 //it means this login information belongs to a company and is valid.
                 //login successful
                 session_start();
                 $_SESSION['comemail']=$email;
                 
                 //forwarding to home page
                 echo"<script>location.assign('companyhome.php')</script>";  
             }
             else{
                 //the info is invalid and returning to login page
                 echo"<script>location.assign('login.php')</script>";         
             }             
         }catch(PDOException $ex){
             //if found error forward to login page
            echo"<script>location.assign('login.php')</script>";
         }
     }else{
         //if any value is empty or invalid, then forward to login page again.
         echo"<script>location.assign('login.php')</script>";
     }
 }
else{
    //forwarding to login page if not post method.
    echo"<script>location.assign('login.php')</scrpit>";
}
?>