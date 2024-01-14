<?php
session_start();

if(
        isset($_SESSION['useremail']) &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    //mname,mcompany,mprice,mimage,mdescrip,mshipping_charge,mstock,mavailable,mfeature
    if( 
        isset($_POST['mname']) && isset($_POST['mcompany']) && isset($_POST['mprice']) && isset($_FILES['mimage']) && isset($_POST['mdescrip']) && 
        !empty($_POST['mname']) && !empty($_POST['mcompany']) && !empty($_POST['mprice'])
    ){ 
        $name=$_POST['mname'];
        $com=$_POST['mcompany'];
        $price=$_POST['mprice'];
        $descrip=$_POST['mdescrip'];
        $shipping=$_POST['mshipping_charge'];
        $stock=$_POST['mstock'];
        $avail=$_POST['mavailable'];
        $feature=$_POST['mfeature'];
        
        //print_r($_FILES['mimage']);
        //Array ( [name] => Tablet-Cavic-C-PLUS.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php8B68.tmp [error] => 0 [size] => 87160 )
        
        //$image_file is the received array, it contains the same indexes. 
        $image_file=$_FILES['mimage'];
        $imagename=$image_file['name'];
        
        $from=$image_file['tmp_name'];  //contains the previous image location
        $to="medicineimage/$imagename";  //we will store the image file in this location 
        
        //database section:
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            //database code execute, default : warning generate
            $sqlquery="INSERT INTO medicine(id,name,company,price,image1,description,shipping_charge,stock,availability,feature) VALUES(NULL,'$name','$com',$price,'$to','$descrip',$shipping,$stock,'$avail',$feature)";          
            $conn->exec($sqlquery);
            
            move_uploaded_file($from,$to); //uploading the image to our server folder(medicineimage).
             
             ?>
                <script>location.assign('adminpanel.php')</script>
            <?php
        }
        catch (PDOException $ex){
            ?> 
                <script>location.assign('medupload.php')</script>
            <?php
        }        
         
    }
    else{
        ?>
            <script>location.assign('medupload.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
