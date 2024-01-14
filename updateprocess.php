<?php
session_start();
if(
    isset($_SESSION['comemail']) && !empty($_SESSION['comemail'])
){///already logged in   
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['cid']) && isset($_POST['cname'])  &&  isset($_POST['cemail']) && 
           isset($_POST['cpass']) && isset($_POST['ccontact']) && isset($_POST['caddress']) && 
           !empty($_POST['cname']) && !empty($_POST['cemail']) && !empty($_POST['cpass'])
    ){
        $id=$_POST['cid'];
        $name=$_POST['cname'];
        $email=$_POST['cemail'];
        $pass=$_POST['cpass'];
        $contact= $_POST['ccontact'];   
        $address=$_POST['caddress'];
        
      try{
          $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
          //database code execute, default : warning generate
          $sqlquery="UPDATE company SET name='$name', email='$email', pass='$pass', contact_no='$contact', address='$address' WHERE id=$id";
          $conn->exec($sqlquery);
          
          ?>
            <script>location.assign('companyhome.php')</script>ss
          <?php
          
      }catch(PDOException $ex){
         ?><script>location.assign('companyhome.php')</script><?php 
      }      
    }else{
        ?><script>location.assign('companyhome.php')</script><?php 
    }
        
  }else{
      echo"<script>location.assign('mupdate.php')</scrpit>";  
   }
    
}else{
   ?><script>location.assign('login.php')</script><?php
}
?>