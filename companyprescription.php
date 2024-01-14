
<?php
session_start();
if(
       isset($_SESSION['comemail']) && !empty($_SESSION['comemail'])
  ){
      if(isset($_GET['cid'])){
          $cmid=$_GET['cid'];
        ?>
        <!DOCTYPE html>
       <head>
           <meta charset="utf-8">
           <title>EMed/company/inbox</title>
           <style>
           #cbody{
               background-color: LightSteelBlue;
           }
           #ctable{
                   width: 70%;
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
           <h4 style="font-family:verdana;"><u>Inbox:</u></h1>
           user: <?php echo $_SESSION['comemail'];?>
           <br><br>
           
           <!__creating companyhome button__>
           <input type="button" id="btn" name="btn" value="home" onclick="homefn();">
            <?php
            try{
               $email=$_SESSION['comemail'];
               $sta="done";

               $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
               $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

               //database code execute, default : warning generate
               $sqlquery="SELECT * FROM prescription_order WHERE (company_id LIKE $cmid) && (order_status LIKE 'done')";
               $returnobj=$conn->query($sqlquery); 
                    
               if($returnobj->rowCount()==0){
                    ///no data found
                    echo"No data found";   
               }
               else{
                  $tabledata=$returnobj->fetchAll();
                   ?>
                     <table id="ctable">
                     <br><br>
                       <thead>
                        <tr>
                           <th>Order Id</th>
                           <th>Company Id</th>
                           <th>Prescription Id</th>
                        </tr>
                       </thead>
                       <tbody>
                       <?php
                           foreach($tabledata AS $row){
                               $id=$row['id'];
                           ?>
                           <tr>
                               <td><?php echo $row['id']; ?></td>
                               <td><?php echo $row['company_id']; ?></td>
                               <td><?php echo $row['prescription_id']; ?></td>  
                           </tr>
                           <?php
                           }                          
                       ?> 
                       </tbody>
                      </table>
                      <br>
                      <hr>
                      <br>
                      
                   <?php
               }
           }
           catch (PDOException $ex){
               
           }
           ?>
           <script>
               function homefn(){
                location.assign('companyhome.php');
            }
           </script>

       </body>
     <?php
      }
      else{
          echo "not found";
      }
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}
?>