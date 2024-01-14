<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    ///already logged in
    
    ?>

    <!DOCTYPE html>

    <html>

        <head>
            <meta charset="utf-8">
            <title>EMed/insert-medicine</title>
            
            <style>
                #ubody{
                    width:100%;
                    background-color:HoneyDew;
                    border: 2px solid SeaGreen;
                    border-collapse: collapse;
                }
            </style>
        </head>

        <body id="ubody">
        
            <!__creating home button__>
            <input type="button" value="home" onclick="homefn();">
            
            <h4>Upload New Medicine Info Here:</h4>
            <form action="muploadprocess.php" method="POST" enctype="multipart/form-data">
                <label for="mname">Name:</label>
                <input type="text" id="mname" name="mname">
                <br><br>
                <label for="mcompany">Company:</label>
                <input type="text" id="mcompany" name="mcompany">
                <br><br>
                <label for="mprice">Price:</label>
                <input type="text" id="mprice" name="mprice">
                <br><br>
                <label for="mimage">Image:</label>
                <input type="file" id="mimage" name="mimage">
                <br><br>
                <label for="mdescrip">Description:</label>
                <input type="text" id="mdescrip" name="mdescrip">
                <br><br>
                <label for="mshipping_charge">Shipping Charge:</label>
                <input type="text" id="mshipping_charge" name="mshipping_charge">
                <br><br>
                <label for="mstock">Stock:</label>
                <input type="number" id="mstock" name="mstock">
                <br><br>
                <label for="mavailable">Availability:</label>
                <input type="text" id="mavailable" name="mavailable">
                <br><br>
                <label for="mfeature">Feature:</label>
                <input type="text" id="mfeature" name="mfeature">
                <br><br>
                
                <input type="submit" value="Upload Medicine Info.">
            </form>
            <br>
            <input type="button" value="Cancel" onclick="cancelfn();">
            
            <script>             
              function homefn(){
                 location.assign('home.php');  
              }  
                
              function cancelfn(){
                    location.assign('adminpanel.php');
              }
            </script>
        </body>

    </html>

    <?php
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
