<?php 
 session_start();
 error_reporting(0);
 if(
        isset($_SESSION['comemail']) && !empty($_SESSION['comemail'])
   ){ //already logged in
     $cmail=$_SESSION['comemail'];
     ?>
       <!DOCTYPE html>
     <head>
         <title>EMed/Prescription-Order</title>
         <style>
             #acnt {border-radius:10px;width:95px;padding:5px;background-color:Bisque;margin-left:40px;
                    text-align:center;font-size:15px;cursor:pointer;border:3px solid PaleVioletRed;}
             #filter {border-radius:10px;width:95px;padding:5px;background-color:Bisque;margin-left:40px;
                    text-align:center;font-size:15px;cursor:pointer;border:3px solid PaleVioletRed;}
             #pid{
                 background-color:PapayaWhip; 
             }
             #cancel{border-radius:10px;width:110px;padding:5px;background-color:Bisque;margin-left:480px;
                    border:3px solid PaleVioletRed;text-align:center;font-size:15px;cursor:pointer;}
             #cancel:hover{background-color:PaleVioletRed;}
             #confirm{border-radius:10px;width:110px;padding:5px;background-color:Bisque;margin-left:70px;
                    border:3px solid PaleVioletRed;text-align:center;font-size:15px;cursor:pointer;}
             #confirm:hover{background-color:PaleVioletRed;}
         </style>
     </head>
     <body id="pid">
         <hr>
         <h5 style="color:PaleVioletRed"><u>Prescription</u></h5>
         user: <?php echo $_SESSION['comemail'];?>
        
         <input type="button" name="acnt" id="acnt" value="My Account" onclick="acntfn();">
         <input type="button" name="filter" id="filter" value="Back" onclick="filterfn();">
         <?php
            if(
               isset($_GET['prid']) && !empty($_GET['prid'])
             ){
                $arrid=unserialize($_GET['prid']);// array of prescription id
                
                try{
                    $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    
                    $total=0;
                    $prc=0;
                    
                    foreach($arrid AS $r){
                        $amount=$amount+40;
                        $total=$total+1;
                    }
                    ?>
                        <hr>
                        <form method="post">
                        <label for="payment">Payment Method:</label>
                        <input list="paymentm" style="background-color:Bisque;border:3px solid PaleVioletRed;margin-right:1%" name="payment">
                        <datalist id="paymentm">
                            <option value="Bkash">
                            <option value="Rocket">
                            <option value="Nagad">
                        </datalist>
                            
                        <label for="total" style="margin-left:40px;">Quantity:</label>
                        <span style="color:MediumVioletRed" name="total" id="total"><?php echo $total ?> Prescriptions</span>
                        
                        <label for="amount" style="margin-left:40px;">Total Amount:</label>
                        <span style="color:MediumVioletRed" name="amount" id="amount"><?php echo $amount ?> BDT</span>
                        
                        <br><br><br>
                        <input type="button" id="cancel" value="Cancel" value="cancel" onclick="cancelfn();">
                        <input type="submit" name="confirm" id="confirm" value="Confirm Order">
                        </form>
                    <?php 
                     //if order is confirmed 
                     $dtype=array();  
                    $submitted=$_POST['confirm'];
                    if($submitted && $total!=0){
                        foreach($arrid AS $r){
                            echo "<br/>";
                            $sqlquery="SELECT * FROM prescriptions WHERE id=$r";
                            $returnobj=$conn->query($sqlquery);
                            $tabledata=$returnobj->fetchAll();
                            
                            foreach($tabledata AS $row){
                                $pid=$row['id']; $qua=$total;
                                $amo=$amount; $type=$row['disease_type']; $met=$_POST['payment'];
                                
                                //echo $cid," ",$pid," ",$qua," ",$amo," ",$type," ",$met;
                                echo "Order Placed";
                               
                                $sqquery="INSERT INTO prescription_order VALUES(NULL,9,$pid,$qua,$amo,'$type','$met','precessing','2021-06-19')";
                               $conn->exec($sqquery);
                            }
                        }
                        ?>
                        <?php
                    }  
                }
                catch(PDOException $ex){
                   ?><script>location.assign('presorderprocess.php')</script><?php 
                }
            }
            else{
                ?><script>location.assign('presorder.php')</script><?php
            }
         ?>
         <script>
             function cancelfn(){
                 location.assign('presorder.php');
             }
             function acntfn(){
                    location.assign('companyhome.php');
            }
            function filterfn(){
                location.assign('presorder.php');
            }
        </script>
     </body>
    <?php 
 }
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}
?>