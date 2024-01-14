<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>EMed/Login Page</title>
        <style>
            #body{
                background-color:HoneyDew;
            }
        </style>
    </head>
    <body id="body">
        <h2><u>EMED</u></h2>
        <h4><u>Login Here</u></h4>
        <form action="loginprocess.php" method="POST">
            
         <!__Company email__>
         <label for="cemail">Email: </label>
         <input type="email" id="cemail" name="cemail" placeholder="Enter your Email here">
         <br><br>
         
         <!__password__>
         <label for="cpass">Password: </label>
         <input type="password" id="cpass" name="cpass" placeholder="Enter a password">
         <br><br><br>
         
         <!__Submit Button__>
         <input type="submit" value="login">    
     </form>
    </body>
</html>    