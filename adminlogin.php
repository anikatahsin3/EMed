<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>EMed/Login Page</title>
        <style>
            #body{
                background-color:Linen;
            }
        </style>
    </head>
    <body id="body">
        <h2><u>EMED</u></h2>
        <h4><u>Admin/Login Here</u></h4>
        <form action="adminloginprocess.php" method="POST">
            
         <!__Company email__>
         <label for="aemail">Email: </label>
         <input type="mail" id="aemail" name="aemail" placeholder="Enter your Email here">
         <br><br>
         
         <!__password__>
         <label for="apass">Password: </label>
         <input type="password" id="apass" name="apass" placeholder="Enter password">
         <br><br><br>
         
         <!__Submit Button__>
         <input type="submit" value="login">    
     </form>
    </body>
</html>    