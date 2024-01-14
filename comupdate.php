<?php
session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    if(
            isset($_GET['cid']) && isset($_GET['cstatus']) && !empty($_GET['cid'])
    ){
        
        $id=$_GET['cid'];
        $status=$_GET['cstatus'];
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //deleting the database row
            if($status==1){
               $sqlquery="UPDATE company SET status=0 WHERE id=$id"; 
            }
            else if($status==0){
               $sqlquery="UPDATE company SET status=1 WHERE id=$id"; 
            }
            
            $conn->exec($sqlquery);
            
            ?>
                <script>location.assign('companymanage.php')</script>
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
            <script>location.assign('home.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
