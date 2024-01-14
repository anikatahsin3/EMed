<?php
session_start();
if(
    isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])
){///already logged in   
    if($_SERVER['REQUEST_METHOD']=="POST"){
       if(isset($_POST['mid']) && isset($_POST['mname']) &&  isset($_POST['mcompany']) && isset($_POST['mprice']) &&
          isset($_POST['mdescrip']) && isset($_POST['mshipping_charge']) && 
          isset($_POST['mstock']) && isset($_POST['mavailable']) && isset($_POST['mfeature']) && 
          !empty($_POST['mname']) && !empty($_POST['mcompany']) && !empty($_POST['mprice']) 
    ){
      $id=$_POST['mid'];
      $name=$_POST['mname'];
      $com=$_POST['mcompany'];
      $price=$_POST['mprice'];
      $desc= $_POST['mdescrip'];   
      $scharge=$_POST['mshipping_charge'];
      $stock=$_POST['mstock'];
      $avail=$_POST['mavailable'];     
      $feature=$_POST['mfeature'];
           
      //$image_file is the received array, it contains the same indexes.
      // print_r($_FILES['mimage']);
           
      $image_file=$_FILES['mimage'];
      $imagename=$image_file['name'];       
      $from=$image_file['tmp_name'];  //contains the previous image location
      $to="medicineimage/$imagename";  //we will store the image file in this location     
           
      try{
          $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
          $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          //print_r($image_file);
          
          if($image_file['error']==0){
            $sqlquery="UPDATE medicine SET name='$name', company='$com', price='$price',image1='$to', description='$desc', shipping_charge=$scharge, stock=$stock, availability='$avail', feature=$feature WHERE id=$id";
            $conn->exec($sqlquery);
          
            move_uploaded_file($from,$to); //uploading the image to our server folder(medicineimage).  
          }
          else{
              $sqlquery="UPDATE medicine SET name='$name', company='$com', price='$price', description='$desc', shipping_charge=$scharge, stock=$stock, availability='$avail', feature=$feature WHERE id=$id";
              $conn->exec($sqlquery);
          }
            
          //database code execute, default : warning generate
          
          ?>
            <script>location.assign('adminpanel.php')</script>
          <?php
          
      }catch(PDOException $ex){
         ?><script>location.assign('mupdate.php')</script><?php 
      }      
    }else{
        ?><script>location.assign('mupdate.php')</script><?php    
     }
    }
    else{
      echo"<script>location.assign('mupdate.php')</scrpit>";  
    }
}
else{
   ?><script>location.assign('login.php')</script><?php
}
?>