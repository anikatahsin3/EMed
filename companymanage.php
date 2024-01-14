<?php 
 session_start();
 if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
   ){//already logged in
        ?>
        <!DOCTYPE html>
        <head>
            <meta charset="utf-8">
            <title>EMed/admin/company management</title>  
            
           <style>
               #cbody{
                   background-color:antiquewhite;
               }
               
                #ctable{
                    width: 100%;
                    border: 4px solid Purple;
                    border-collapse: collapse;
                    text-align: center;
                }
                
                #ctable th, #ctable td{
                    border: 1px solid Purple;
                    border-collapse: collapse;
                }
                
                #ctable tr:hover{
                    background-color: darkseagreen;
                }
                
                #ctable th, #ctable td{
                    background-color: Thistle;
                }
            </style>
        </head>
        <body id="cbody">
            <h4 style="color:Gray"><u>Admin Panel/company management:</u></h4>
            Admin: <?php echo $_SESSION['useremail'];?>       
            <br><br>
            
            <!__creating home button__>
            <input type="button" value="home" onclick="homefn();">
            
            <!__creating Admin button__>
            <input type="button" value="Admin Panel" onclick="apanelfn();">
            
            
            <h4 style="color:DarkMagenta"><u>Company Information:</u></h4>
            <table id="ctable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Register Date</th>
                        <th>Status</th>
                        <th>Update/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     try{
                        $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                        //database code execute, default : warning generate
                        $sqlquery="SELECT * FROM company";
                        $returnobj=$conn->query($sqlquery); 
                         
                        if($returnobj->rowCount()==0){
                            ///no data found
                             ?>
                                <tr>
                                    <td colspan="8">No data found</td>
                                </tr>
                            <?php
                        } 
                        else{
                            ///company data found
                            $tabledata=$returnobj->fetchAll();
                            
                            foreach($tabledata AS $row){
                            ///$row = array(id,name,email,pass,contact_no,address,registration_date,status) 
                                ?>
                                 <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['contact_no']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['registration_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                         <input type="button" value="Block/Unblock" onclick="mupdatefn(<?php echo $row['id'];?>,<?php echo $row['status'];?>);">
                                         <br>
                                         <input type="button" value="Delete Profile" onclick="mdeletefn(<?php echo $row['id']; ?>);">
                                    </td>
                                </tr>
                                <?php  
                            }                           
                        }
                    }
                    catch (PDOException $ex){
                        ?>
                            <tr><td colspan="8">No data found</td></tr>  
                        <?php
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
               
              function mupdatefn(comid,comstatus){
                     location.assign('comupdate.php?cid='+comid+'&cstatus='+comstatus); //GET
              }
                
              function mdeletefn(comid){
                     location.assign('comdelete.php?cid='+comid); //GET
              }  
            </script>               
        </body>
     <?php
 }
 else{
     ?>
        //JS code: forwarding to login page
        <script>location.assign('login.php')</script>
    <?php
 }
?>
     