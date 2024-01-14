<?php 
 session_start();
 if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
   ){ //already logged in
        ?>
        <!DOCTYPE html>
        <head>
            <meta charset="utf-8">
            <title>EMed/Admin Panel</title>  
            
            <style>
                #abody{
                    background-color: Azure;
                }

                #msrch{
                    border-radius:20px;
                    width:  500px;
                    padding: 5px;
                    background-color: HoneyDew;
                }
                #msrch:hover{
                    background-color:aliceblue;
                }
                
                #mbtn{
                    border-radius: 10px;
                    width:  90px;
                    padding: 5px;
                    background-color: HoneyDew;
                    text-align: center;
                    font-size: 15px;
                    cursor: pointer;
                    margin: 5px;
                }  
                #mbtn:hover { background-color:Lavender;} 
                      
                #home:hover {background-color:Lavender;}
                #upm:hover {background-color:Lavender;}
                #mcom:hover {background-color:Lavender;}
                #logout:hover {background-color:plum;}
                #up:hover{background-color:forestgreen}
                #del:hover{background-color:red}
                
                #mtable{
                    width: 100%;
                    border: 4px solid cadetblue;
                    border-collapse: collapse;
                    text-align: center;
                    background-color: Lavender;
                }
                
                #mtable tr:hover{
                    background-color:Thistle; 
                } 
                #mtable th, #mtable td{
                    border: 1px solid cadetblue;
                    border-collapse: collapse;
                }
            </style>   
        </head>
        <body id="abody">
            <h4 style="color:Gray"><u>Admin Panel</u></h4>
            Admin: <?php echo $_SESSION['useremail'];?>       
            <br><br>
  
            <!__creating home button__>
            <input type="button" id="home" value="home" onclick="homefn();">
            
            <!__creating medicine upload button__>
            <input type="button" id="upm" value="upload medicine" onclick="muploadfn();">
            
            <!__creating company management button__>
            <input type="button" id="mcom" value="Manage company" onclick="managecomfn();">

            <!__creating prescription order button__>
            <input type="button" id="porder" value="Prescription Order" onclick="orderfn();">
            
            <!__creating logout button__>
            <input type="button" id="logout" value="logout" onclick="logoutfn();">
            
            <h4 style="color:cadetblue"><u>All Products:</u></h4>
            
            <!__creating search bar and search button__>
            <form method="GET">
            <input type="search" name="msrch" id="msrch" value="search here">
            <input type="submit" name="mbtn" id="mbtn" value="Search">
            </form>
            <br>

            <?php 
            //storing the search value
            if(isset($_GET['msrch'])){
                $search=$_GET['msrch'];
                $sub=substr($search,0,4);
            }
            ?>

            <table id="mtable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Shipping Charge</th>
                        <th>Stock</th>
                        <th>Availability</th>
                        <th>feature</th>
                        <th>Posting Date</th>
                        <th>Update/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     try{
                        $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //database code execute, default : warning generate
                        $sqlquery="SELECT * FROM medicine";
                        $returnobj=$conn->query($sqlquery);

                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
                                <tr>
                                    <td colspan="13">No data found</td>
                                </tr>
                            <?php
                        } 
                        else{
                            if(empty($search) || $search=='search here'){
                                ///product data found
                                $tabledata=$returnobj->fetchAll();
                            
                                foreach($tabledata AS $row){
                                ///$row = array(id,name,company,price,image1,type,description,shipping_charge,stock,availability,feature,posting_date)
                                
                                ?>
                                 <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['company']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td>
                                        <img src="<?php echo $row['image1'];?>" width="100" height="100">
                                    </td> 
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['shipping_charge']; ?></td>
                                    <td><?php echo $row['stock']; ?></td>
                                    <td><?php echo $row['availability']; ?></td>
                                    <td><?php echo $row['feature']; ?></td>
                                    <td><?php echo $row['posting_date']; ?></td>
                                    <td>
                                         <input type="button" id="up" value="Update" onclick="mupdatefn(<?php echo $row['id']; ?>);">
                                         <br>
                                         <input type="button" id="del" value="Delete" onclick="mdeletefn(<?php echo $row['id']; ?>);">
                                    </td>
                                </tr>
                                <?php  
                                } 
                            }
                            else{

                                $sqlquery="SELECT * FROM medicine WHERE (name LIKE '%$search%') OR (company LIKE '%$search%') OR (type LIKE '%$search%') 
                                                                         OR (name LIKE '%$sub%') OR (company LIKE '%$sub%') OR (type LIKE '%$sub%')"; 
                                $returnobj=$conn->query($sqlquery);

                                if($returnobj->rowCount()==0){
                                    ///no data found
                                     ?>
                                        <tr>
                                            <td colspan="13">No data found</td>
                                        </tr>
                                    <?php
                                } 
                                else{
                                    $tabledata=$returnobj->fetchAll();
                                    foreach($tabledata AS $row){
                                       ///$row = array(id,name,company,price,image1,type,description,shipping_charge,stock,availability,feature,posting_date)
                                       ?>
                                       <tr>
                                       <td><?php echo $row['id']; ?></td>
                                       <td><?php echo $row['name']; ?></td>
                                       <td><?php echo $row['company']; ?></td>
                                       <td><?php echo $row['price']; ?></td>
                                       <td>
                                        <img src="<?php echo $row['image1'];?>" width="100" height="100">
                                       </td>
                                       <td><?php echo $row['type']; ?></td>
                                       <td><?php echo $row['description']; ?></td>
                                       <td><?php echo $row['shipping_charge']; ?></td>
                                       <td><?php echo $row['stock']; ?></td>
                                       <td><?php echo $row['availability']; ?></td>
                                       <td><?php echo $row['feature']; ?></td>
                                       <td><?php echo $row['posting_date']; ?></td>
                                       <td>
                                            <input type="button" id="up" value="Update" onclick="mupdatefn(<?php echo $row['id']; ?>);">
                                            <br>
                                            <input type="button" id="del" value="Delete" onclick="mdeletefn(<?php echo $row['id']; ?>);">
                                       </td>
                                       </tr>
                                       <?php
                                    }
                                }
                            }
                        }
                    }catch (PDOException $ex){
                        ?>
                            <tr><td colspan="13">No data found</td></tr>  
                        <?php
                    }
                    ?>       
                </tbody>
            </table>
            
            <script> 
              function homefn(){
                 location.assign('home.php');  
              }      
                
              function muploadfn(){
                 location.assign('medupload.php'); 
              }  
                
              function managecomfn(){
                 location.assign('companymanage.php'); 
              }    
               
              function mupdatefn(medid){
                     location.assign('mupdate.php?mid='+medid); //GET
              }

              function orderfn(){
                  location.assign('adminpresorder.php');
              }
                
              function mdeletefn(medid){
                     location.assign('mdelete.php?mid='+medid); //GET
              }  
                
              function logoutfn(){
                  location.assign('adminlogout.php');
              }  
                
            </script>               
        </body>
     <?php
 }
 else{
     ?>
        //JS code: forwarding to login page
        <script>location.assign('adminlogin.php')</script>
    <?php
 }
?>