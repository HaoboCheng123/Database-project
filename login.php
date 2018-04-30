<?php
include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      //SECURITY MEASURE TO REMOVE SPECIAL CHARS
       preg_replace('/[^A-Za-z0-9\-]/', '', $myusername);      
      $sql = "SELECT password FROM Users WHERE username LIKE '" . $myusername . "'";
     
      if ($tuple = mysqli_fetch_assoc(mysqli_query($db, $sql))) {
        if(password_verify($_POST["password"], $tuple["password"])){
          $_SESSION['username'] = $myusername;

          $sql = "SELECT userType FROM Users WHERE username = '" . $myusername . "'";
          
          if(mysqli_fetch_row(mysqli_query($db, $sql))[0] == 'P')
              header("location:home.php");
          else
              header("location:admin.php");
        } else
         $error = "Your Login Name or Password is invalid";
      }
     else
       $error = "Your Login Name or Password is invalid";
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
        
        .bg{
              background-image: url("./images&gifs/city.jpeg");
              height: 100%;
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
        }
         label {
            font-weight:bold;
            width:100px;
            font-size:20px;
            color: white;
            font-family: cursive
         }
         .box {
            border-radius: 40px;
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
  <body style="margin: 0;">
   <div class = "bg">
    <p style = "font-size:xx-large; margin-left: 41%; height: 30%"></p>
         <div style = "width:400px; margin-left:41%;" align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px; font-size: large;
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Login</b></div>
            <div style = "margin:20px;">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" style = "margin-left:3%" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
                 
               </form>
						 	 <hr></hr>
               <a href="create_account.php"style = "font-family: fantasy; font-size: large; color: coral;">Create new account</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
              
              </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>