<?php
include("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
      preg_replace('/[^A-Za-z0-9\-]/', '', $myusername);
      preg_replace('/[^A-Za-z0-9\-]/', '', $email);

        if($_POST['password'] != $_POST['password2'])
            $error = "Passwords do not match";
        else {
          $sql = "SELECT COUNT(*) FROM Users WHERE username = '" . $myusername . "'";
          if(mysqli_fetch_row(mysqli_query($db, $sql))[0])
              $error = "Username already exists";
          else {
            $mypassword = password_hash($_POST["password"],PASSWORD_DEFAULT);
              $sql = "INSERT INTO Users (username, userType, password, email) VALUES ('" . $myusername . "', 'P', '" . $mypassword . "', '" . $email . "')";
            mysqli_query($db, $sql);
            header("location:login.php");
          }
      }
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
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Create Account</b></div>
            <div style = "margin:20px;">
               
               <form action = "" method = "post" style = "width: 400px;" >
                  <label>UserName  :</label><input type = "text" name = "username" class = "box" style = "margin-left:18%;"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" style = "margin-left:21%;"/><br/><br />
                  <label>Confirm Password  :</label><input type = "password" name = "password2" class = "box" /><br/><br />
                  <label>Email  :</label><input type = "email" name = "email" class = "box" style = "margin-left:30%;"/><br/><br />
                  <input type = "submit" value = " Submit "/><br />
                 
               </form>
						 	 <hr></hr>
               <a href="create_account.php"style = "font-family: fantasy; font-size: large; color: coral;">Create new account</a>
               <a href="login.php"style = "font-family: fantasy; font-size: large; color: coral; margin-left:108px;">Go Back</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
              
              </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>