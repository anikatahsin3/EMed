<?php
session_start();
if(
    isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])
){///already logged in
 if(
    isset($_GET['mid']) && !empty($_GET['mid'])
 ){
    $updateid=$_GET['mid'];
    
    try{
        $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        $sqlquery="SELECT * FROM medicine WHERE id=$updateid";
        $returnobj=$conn->query($sqlquery);
        
        if($returnobj->rowCount()==0){
          ///no data found
          echo"No data found";   
        }
        else{
           $tabledata=$returnobj->fetchAll();
           foreach($tabledata AS $row){
               echo $row['image1'];
               ?><br><?php
               
               echo"Product ID: ";
               echo $row['id'];             
            ?>
              <form action="mupdateprocess.php" method="post" enctype="multipart/form-data">
                 <label for="mid"></label>
                 <input type="hidden" id="mid" name="mid" value="<?php echo $row['id'];?>">
                 <br><br>
                 <label for="mname">Name:</label>
                 <input type="text" id="mname" name="mname" value="<?php echo $row['name'];?>">
                 <br><br>
                 <label for="mcompany">Company:</label>
                 <input type="text" id="mcompany" name="mcompany" value="<?php echo $row['company'];?>">
                 <br><br>
                 <label for="mprice">Price:</label>
                 <input type="text" id="mprice" name="mprice" value="<?php echo $row['price'];?>">
                 <br><br>
                 <label for="mimage">Image:</label>
                 <input type="file" id="mimage" name="mimage" value="<?php echo $row['image1'];?>" >
                 <img src="<?php echo $row['image1'];?>">
                 <br><br>
                 <label for="mdescrip">Description:</label>
                 <input type="text" id="mdescrip" name="mdescrip" value="<?php echo $row['description'];?>">
                 <br><br>
                 <label for="mshipping_charge">Shipping Charge:</label>
                 <input type="text" id="mshipping_charge" name="mshipping_charge" value="<?php echo $row['shipping_charge'];?>">
                 <br><br>
                 <label for="mstock">Stock:</label>
                 <input type="number" id="mstock" name="mstock" value="<?php echo $row['stock'];?>">
                 <br><br>
                 <label for="mavailable">Availability:</label>
                 <input type="text" id="mavailable" name="mavailable" value="<?php echo $row['availability'];?>">
                 <br><br>
                 <label for="mfeature">Feature:</label>
                 <input type="number" id="mfeature" name="mfeature" value="<?php echo $row['feature'];?>">
                 <br><br>
                  
                 <input type="submit" value="Save Change"> 
            </form>
                 <input type="button" value="Cancel" onclick="cancelfn();"><br>

                  
            <script>
                
                function cancelfn(){
                    location.assign('adminpanel.php');
                }
            </script>
            <?php
           }
        }  
    }catch(PDOException $ex){
        ?><script>location.assign('adminpanel.php')</script><?php
    }
 }
 else{
    ?><script>location.assign('adminpanel.php')</script><?php
 }
}
else{
    ?><script>location.assign('login.php')</script><?php
}
?>
