welcome
<?php
session_start();
if(isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){//already logged in
    if(isset($_GET['cid']) && isset($_GET['qua']) && !empty($_GET['cid'])){
        $id=$_GET['cid'];
        $quan=$_GET['qua'];
        try{
            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql="SELECT * FROM prescription_order WHERE (company_id LIKE $id) && (quantity LIKE $quan)";
            $returnobj=$conn->query($sql);
            $tabledata=$returnobj->fetchAll();
            foreach($tabledata AS $row){
                    $amt=$row['amount'];
            }

            $sqlquery="UPDATE prescription_order SET order_status='done' WHERE (company_id LIKE $id) && (quantity LIKE $quan) && (amount LIKE $amt)";
            $conn->exec($sqlquery);
            
            ?><script>location.assign('adminpresorder.php')</script><?php

        }
        catch(PDOException $ex){
            ?>
                <script>location.assign('adminpresorder.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>location.assign('adminpresorder.php')</script>
        <?php
    }
}
else{
    ?><script>location.assign('adminlogin.php')</script><?php
}
?>