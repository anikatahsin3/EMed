<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    if(
            isset($_GET['mid'])
        && !empty($_GET['mid'])
    ){
        
        $deletemedid=$_GET['mid'];
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            $sqlquery="SELECT * FROM medicine WHERE id=$deletemedid";
            
            $returnobj=$conn->query($sqlquery);
            
            //deleting file from server folder
            $fileimagepath=$returnobj->fetchAll()[0]['image1'];
            
            print_r($fileimagepath);
            unlink($fileimagepath); ///unlink function will delete the file
            

            //deleting the database row
            $sqlquery="DELETE FROM medicine WHERE id=$deletemedid";
            $conn->exec($sqlquery);
            
            ?>
                <script>location.assign('adminpanel.php')</script>
            <?php
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('adminpanel.php')</script>
            <?php
        }
        
    }
    else{
         ?>
            <script>location.assign('adminpanel.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
