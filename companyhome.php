
<?php 
 session_start();
 if(
        isset($_SESSION['comemail']) && !empty($_SESSION['comemail'])
   ){ //already logged in
     ?>
       <!DOCTYPE html>
        <head>
            <meta charset="utf-8">
            <title>EMed/company/profile</title>
            
            <style>
               #btn {
                    border-radius: 10px;width:90px;padding: 5px;
                    text-align: center;font-size: 15px;cursor: pointer;margin: 5px;
               }
               #btn:hover {background-color:LightBlue;}

               #ord {
                    border-radius: 10px;width:150px;padding: 5px;
                    text-align: center;font-size: 15px;cursor: pointer;margin: 5px;
               }
               #ord:hover {background-color:LightBlue;}

               #inb {
                    border-radius: 10px;width:100px;padding: 5px;
                    text-align: center;font-size: 15px;cursor: pointer;margin: 5px;
               }
               #inb:hover {background-color:LightBlue;}

               #log {
                    border-radius: 10px;width:90px;padding: 5px;
                    text-align: center;font-size: 15px;cursor: pointer;margin: 5px;
               }
               #log:hover {background-color:Lavender;}
                           
               #cbody{width:100%;
                    background-color: LightSteelBlue;
                    border: 4px solid LightSlateGrey;
                    border-collapse: collapse;
                   align-items: center;
                   align-content: center;
                   border-style: double;
                }
                
                #fr{width:50%;
                    border: 5px solid LightCyan;
                    border-collapse: collapse;
                    background-color:LightSteelBlue; 
                    text-align: center;
                }
                #cname{width: 480px; padding: 5px; border-radius:5px; text-align: center; background-color:MintCream;}
                #cemail{width: 480px; padding: 5px; border-radius:5px; text-align: center; background-color:MintCream;}
                #cpass{width: 480px; padding: 5px; border-radius:5px; text-align: center; background-color:MintCream;}
                #ccontact{width: 480px; padding: 5px; border-radius:5px; text-align: center; background-color:MintCream;}
                #caddress{width: 470px; padding: 10px; border-radius:5px; text-align: center; background-color:MintCream;}
                #save{border-radius:480px; width: 100px; padding: 5px; text-align: center; background-color:AliceBlue;}
                #save:hover {background-color:LightBlue;}
                #cancel {
                    border-radius: 10px;width:90px;padding: 5px;
                    text-align: center;font-size: 15px;cursor: pointer;margin: 5px;
               }
               #cancel:hover {background-color:Lavender;}  
                
                #ctable{
                    width: 50%;
                    border: 4px solid LightCyan;
                    border-collapse: collapse;
                    text-align: center;
                }
                #ctable th, #ctable td{
                    border: 1px solid LightCyan;
                    border-collapse: collapse;
                }
                #ctable th, #ctable td{
                    background-color: LightBlue;
                    
                }
            </style>
        </head>

        <body id="cbody">
            <h1 style="font-family:verdana;"><u>EMed/Profile:</u></h1>
            user: <?php echo $_SESSION['comemail'];?>
            <br><br>
            
            <!__creating home button__>
            <input type="button" id="btn" name="btn" value="home" onclick="homefn();">

            <!__creating order button__>
            <input type="button" id="ord" name="ord" value="Order Prescription" onclick="orderfn();">

            
            
            <!__creating logout button__>
            <input type="button" id="log" name="log" value="logout" onclick="logoutfn();">
            <br><br><hr><br>
        
            <?php
                try{
                    $email=$_SESSION['comemail'];
                    
                    $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    //database code execute, default : warning generate
                    $sqlquery="SELECT * FROM company WHERE email='$email'";
                    $returnobj=$conn->query($sqlquery);
      
                    if($returnobj->rowCount()==0){
                         ///no data found
                         echo"No data found";   
                    }
                    else{
                       $tabledata=$returnobj->fetchAll();
                       foreach($tabledata AS $row){
                         echo "Company Profile Information:";
                          ?><br><?php    
                          echo"Company ID: ";
                          echo $row['id'];
                        ?>
                        <br>
                         <!__creating Inbox button__>
                        <input type="button" id="inb" name="inb" value="Inbox" onclick="inboxfn(<?php echo $row['id']; ?>);">
                        <br>
                          <table id="ctable">
                          <br><br>
                            <thead>
                             <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                             </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['pass']; ?></td>
                                    <td><?php echo $row['contact_no']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                            </tbody>
                           </table>
                           <br>
                           <hr>
                           <br>
                           Update Profile:<br><br>
                           <form id="fr" action="updateprocess.php" method="post" > 
                             <label for="cid"></label>
                             <input type="hidden"  id="cid" name="cid" value="<?php echo $row['id'];?>">
                             <br>
                             <label for="cname">Name:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</label>
                             <input type="text" id="cname" name="cname" value="<?php echo $row['name'];?>">
                             <br><br>
                             <label for="cemail">Email:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</label>
                             <input type="text" id="cemail" name="cemail" value="<?php echo $row['email'];?>">
                             <br><br>
                             <label for="cpass">Password:&nbsp; &nbsp; &nbsp; &nbsp;</label>
                             <input type="text" id="cpass" name="cpass" value="<?php echo $row['pass'];?>">
                             <br><br>
                             <label for="ccontact">Contact no.:&nbsp;&nbsp;&nbsp;</label>
                             <input type="text" id="ccontact" name="ccontact" value="<?php echo $row['contact_no'];?>">
                             <br><br>
                             <label for="caddress">Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                             <input type="text" id="caddress" name="caddress" value="<?php echo $row['address'];?>">
                            
                             <br><br><br>

                             <input type="submit" id="save" value="Save Change"> 
                               <br><br>
                        </form>
                            <br>
                              <input type="button" id="cancel" value="Cancel" onclick="cancelfn();">
                              <br><br><br>
                        <script>
                            
                        </script>
                        <?php
                       }
                    }
                }
                catch (PDOException $ex){
                     ?><script>location.assign('companyhome.php')</script><?php
                }
                ?>   
            <script>
              function orderfn(){
                location.assign('presorder.php');
              } 
                
              function homefn(){
                 location.assign('home.php'); 
              }  

              function inboxfn(cmid){
                  location.assign('companyprescription.php?cid='+cmid);
              } 


                
              function logoutfn(){
                 location.assign('logout.php');  
              } 
                
             function cancelfn(){
                 location.assign('companyhome.php');
             }
            </script>     
        </body>
     <?php
 }else{
     ?>
        <script>location.assign('login.php')</script>
    <?php
 }
?>
    