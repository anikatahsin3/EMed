
<?php 
 session_start();
 if(
        (isset($_SESSION['useremail']) && !empty($_SESSION['useremail'])) ||
        (isset($_SESSION['comemail']) && !empty($_SESSION['comemail']) ) 
   ){ //already logged in
     ?>
       <!DOCTYPE html>
        <head>
            <meta charset="utf-8">
            <title>EMed/Home Page</title>
            
            <style>
               #hbody{
                    width:100%;
                    background-color: darkseagreen;
                    border: 4px solid cadetblue;
                    border-collapse: collapse;    
                }
                
                #srch{
                    border-radius:20px;
                    width:  500px;
                    padding: 10px;
                    background-color: HoneyDew;
                }
                #srch:hover{
                    background-color:aliceblue;
                }
                #btn{
                    border-radius: 10px;
                    width:  90px;
                    padding: 10px;
                    background-color: HoneyDew;
                    text-align: center;
                    font-size: 15px;
                    cursor: pointer;
                    margin: 5px;
                }  
                #btn:hover {
                     background-color:#008B8B;
                 } 
            </style>
        </head>
        <body id="hbody">
            <h1 style="font-family:verdana;"><u>EMed</u></h1>
            
            <!__creating search bar__>
            <form method="GET">
            <input type="search" name="srch" id="srch" value="search here">
            <input type="submit" name="btn" id="btn" value="Search">
            </form>
            
            <?php
             if(isset($_GET['srch'])){
                 $search=$_GET['srch'];
             }
            
             try{
                $conn=new PDO('mysql:host=localhost:3306;dbname=emed;','root','');
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                 
                 if(empty($search) || $search=='search here'){
                     //not searching
                 }
                 else{
                     $sqlquery="SELECT * FROM medicine WHERE (name LIKE '%$search%') OR (company LIKE '%$search%') OR (type LIKE '%$search%')";
                     $returnobj=$conn->query($sqlquery);
                     if($returnobj->rowCount()==0){
                         ///no data found
                         echo "No Match Found.";
                     }
                     else{
                         ///product data found
                         $tabledata=$returnobj->fetchAll();
                         foreach($tabledata AS $row){
                             echo $row['name'];
                             ?>
                             <img src="<?php echo $row['image1'];?>" alt="image" style="width:128px;height:128px">
                             <br>
                             <?php
                         }
                     } 
                 }
            }catch(PDOException $ex){
               ?><script>location.assign('home.php')</script><?php
            } 
     ?>
        </body>
     <?php
 }else{
     ?>
        <script>location.assign('login.php')</script>
    <?php
 }
?>
    