<?php
session_start();
if(isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){//already logged in
   ?>
    <!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>EMed/admin/company management</title>
        <style>
            #cbody{background-color:antiquewhite;}
            #ctable{width:100%;border:4px solid Purple;
                    border-collapse:collapse;text-align:center;}
            #ctable th, #ctable td{border:1px solid Purple; border-collapse:collapse;}
            #ctable tr:hover{background-color: darkseagreen;}
            #ctable th, #ctable td{background-color: Thistle;}
        </style>
    </head>
    <body id="cbody">
        <h4 style="color:Gray"><u>Admin Panel/Prescription Order:</u></h4>
        Admin: <?php echo $_SESSION['useremail'];?>       
        <br><br>
        
        <!__creating home button__>
        <input type="button" value="home" onclick="homefn();">    
        <!__creating Admin panel button__>
        <input type="button" value="Admin Panel" onclick="apanelfn();">
        
        <h4 style="color:DarkMagenta"><u>Ordered Prescription:</u></h4>
        <table id="ctable">
            <thead>
                <tr>
                        <th>Id</th>
                        <th>Company Id</th>
                        <th>Prescription Id</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        <th>Update/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try{
                    $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    
                    $sqlquery="SELECT * FROM prescription_order";
                    $returnobj=$conn->query($sqlquery);
                    
                    if($returnobj->rowCount()==0){
                             ?><tr><td colspan="10">No data found</td></tr><?php
                        } 
                    else{
                        $tabledata=$returnobj->fetchAll();
                            
                        foreach($tabledata AS $row){ 
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['company_id']; ?></td>
                            <td><?php echo $row['prescription_id']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['order_status']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td>
                                <input type="button" value="Complete Order" onclick="orderfn(<?php echo $row['company_id']; ?>,<?php echo $row['quantity']; ?>);">
                            </td>
                            </tr>
                        <?php  
                        }
                    }
                }
                catch(PDOException $ex){
                   ?> <tr><td colspan="10">No data found</td></tr> <?php
                }
                ?>
            </tbody>
        </table>
        <script>
             function homefn(){
                location.assign('home.php');  
            }      
                
            function apanelfn(){
                location.assign('adminpanel.php'); 
            }  
            
            function orderfn(cmid,quan){
                location.assign('adminpresdone.php?cid='+cmid+'&qua='+quan);
            }
        </script>
    </body>
<?php
}
else{
  ?><script>location.assign('adminlogin.php')</script><?php  
}
?>