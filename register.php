<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>EMed/register page</title>
      <style>
      #rbody {
        background-color: SlateGray;
      }
     </style>

 </head>
 <body id="rbody">
  <h4 style="text-align:center;">__Register Here__</h4>
     <!__registerinfo.php will contain all register information__>
     <form style="text-align:center;" action="registerinfo.php" method="post">
         <!__Company Name__>
         <label for="cname">Name: </label>
         <input type="text" id="cname" name="cname" placeholder="Enter your name here">
         <br><br>
         
         <!__Company email__>
         <label for="cemail">Email: </label>
         <input type="email" id="cemail" name="cemail" placeholder="Enter your Email here">
         <br><br>
         
         <!__password__>
         <label for="cpass">Password: </label>
         <input type="password" id="cpass" name="cpass" placeholder="Enter a password">
         <br><br>
         
         <!__Contact__>
         <label for="ccontact">Contact No: </label>
         <input type="text" id="ccontact" name="ccontact" placeholder="Enter your Company Contact No. here">
         <br><br>
         
         <!__Address__>
         <label for="caddress">Address: </label>
         <input type="text" id="caddress" name="caddress" placeholder="Enter your Company Address here">
         <br><br><br>
         
         <!__Submit Button__>
         <input type="submit" value="Click to Register">    
     </form>
     </body>
</html>