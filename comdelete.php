<?php
session_start();
if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    if(
            isset($_GET['cid']) && !empty($_GET['cid'])
    ){
        
        $deletecomid=$_GET['cid'];
        
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //deleting the database row
            $sqlquery="DELETE FROM company WHERE id=$deletecomid";
            $conn->exec($sqlquery);
            
            ?>
                <script>location.assign('companymanage.php')</script>
            <?php
        }
        catch (PDOException $ex){
            ?>
                <script>location.assign('companymanage.php')</script>
            <?php
        }     
    }
    else{
         ?>
            <script>location.assign('companymanage.php')</script>
        <?php
    }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
