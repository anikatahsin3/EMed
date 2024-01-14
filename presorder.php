<?php 
 session_start();
 error_reporting(0);
 if(
        isset($_SESSION['comemail']) && !empty($_SESSION['comemail'])
   ){ //already logged in
    
     ?>
     <!DOCTYPE html>
     <head>
         <title>EMed/Prescription-Order</title>
         <style>
             #pbody {background-color: antiquewhite;}
             #acnt {border-radius:10px;width:95px;padding:5px;background-color:Thistle;
                    text-align:center;font-size:15px;cursor:pointer;margin:5px;border:3px solid Lavender;}
             
             #fdate {background-color: Thistle; border:3px solid Purple;margin-right:1%}
             #tdate {background-color: Thistle; border:3px solid Purple;margin-right:1%}
             #pnum {background-color: Thistle; border:3px solid Purple;margin-right:1%}
             #phos {background-color: Thistle; border:3px solid Purple;margin-right:1%}
             #pbtn {background-color: Thistle; border:3px solid Purple;margin-right:1%}
             #ptable{width: 100%;
                    border: 3px solid Purple;
                    border-collapse: collapse;
                    text-align: center;}
             #ptable tr:hover{background-color:Thistle}
             #sbtn{border-radius:10px;width:95px;padding:5px;background-color:Thistle; 
                    text-align:center;font-size:15px;cursor:pointer;margin:5px;border:3px solid Lavender;}
         </style>
     </head>
     <body id="pbody">
         <hr>
         <h5 style="color:PaleVioletRed"><u>Prescription</u></h5>
         user: <?php echo $_SESSION['comemail'];?>
         <br><br>
         <input type="button" name="acnt" id="acnt" value="My Account" onclick="acntfn();">
         <hr>
            <!__filtering elements:__>
         <h5 style="color:LightPink"><i>Filter prescription from here</i></h5>
         <form method="GET">
            <label for="fdate">From:</label>
            <input type="date" id="fdate" name="fdate">
            <label for="tdate">To:</label>
            <input type="date" id="tdate" name="tdate">
            <label for="pnum">Quantity:</label>
            <input type="number" id="pnum" name="pnum">
            <label for="distype">Disease:</label>
            <input list="distype" style="background-color:Thistle;border:3px solid Purple;margin-right:1%" name="dtype">
            <datalist id="distype">
                 <option value="heart">
                 <option value="eye">
                 <option value="kidney">
                 <option value="lung">
                 <option value="skin">
            </datalist>
            <label for="phos">Hospital:</label>
            <input type="text" id="phos" name="phos">
            <input type="submit" name="pbtn" id="pbtn" value="Search">
         </form>
         <br><br>
         <?php
            //storing search values
            if(isset($_GET['fdate']) || isset($_GET['tdate']) || isset($_GET['pnum']) || isset($_GET['dtype']) || isset($_GET['phos'])){
                $from=$_GET['fdate'];
                $to=$_GET['tdate'];
                $quan=$_GET['pnum'];
                $type=$_GET['dtype'];
                $hospital=$_GET['phos'];
            }
         ?>
         <table id="ptable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Hospital</th>
                    <th>Doctor</th>
                    <th>Disease Type</th>
                    <th>Upload Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tab='';
                if(empty($to) && empty($quan) && empty($type) && empty($hospital)){
                      ?>  
                      <tr>
                        <td colspan="5">No data</td>
                      </tr>
                      <?php    
                    }
                    else{
                        try{
                            $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                            
                            if(!empty($from) && !empty($to) && !empty($quan) && !empty($type) && !empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (disease_type LIKE '%$type%') AND (hospital LIKE '%$hospital%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($from) && !empty($to) && !empty($type) && !empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (disease_type LIKE '%$type%') AND (hospital LIKE '%$hospital%') AND (status LIKE 1)";
                            }
                            else if(!empty($from) && !empty($to) && !empty($quan) && !empty($type)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (disease_type LIKE '%$type%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($from) && !empty($to) && !empty($quan) && !empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (hospital LIKE '%$hospital%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($type) AND !empty($hospital) AND !empty($quan)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (disease_type LIKE '%$type%') AND (hospital LIKE '%$hospital%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($type) AND !empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (disease_type LIKE '%$type%') AND (hospital LIKE '%$hospital%') AND (status LIKE 1)";
                            }
                            else if(!empty($hospital) AND !empty($quan)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (hospital LIKE '%$hospital%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (hospital LIKE '%$hospital%') AND (status LIKE 1)";
                            }
                            else if(!empty($type) AND !empty($quan)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (disease_type LIKE '%$type%') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                            }
                            else if(!empty($type)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (disease_type LIKE '%$type%') AND (status LIKE 1)";
                            }
                            else if(!empty($from) && !empty($to) && !empty($type)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (disease_type LIKE '%$type%') AND (status LIKE 1)";
                            }
                            else if(!empty($from) && !empty($to) && !empty($hospital)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (hospital LIKE '%$hospital%') AND (status LIKE 1)";
                            }
                            else if(!empty($from) && !empty($to) && !empty($quan)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (status LIKE 1) ORDER BY upload_date LIMIT $quan";
                                echo $quan;
                            }
                            else if(!empty($from) && !empty($to)){
                                $sqlquery="SELECT * FROM prescriptions WHERE (upload_date BETWEEN '$from' AND '$to') AND (status LIKE 1)";
                            }
                            $returnobj=$conn->query($sqlquery);
                           
                            if($returnobj->rowCount()==0){
                                ///no data found
                                ?>
                                <tr>
                                    <td colspan="5">No data found</td>
                                </tr>
                                <?php
                            }
                            else{ 
                                $arr=array();
                                $tabledata=$returnobj->fetchAll();
                                foreach($tabledata AS $row){
                                    array_push($arr,$row['id']);
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['hospital'];?></td>
                                    <td><?php echo $row['doctor'];?></td>
                                    <td><?php echo $row['disease_type'];?></td>
                                    <td><?php echo $row['upload_date'];?></td>
                                </tr>
                                <?php
                                }
                            }
                        }
                        catch(PDOException $ex){
                          //can't connect to database
                        }
                    }
                ?>
            </tbody>
         </table>
         <br>
         
         <a href="presorderprocess.php?prid=<?php echo htmlentities (serialize($arr)); ?>">Order</a>
        <?php
         
         ?>
         <script>
                function acntfn(){
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
