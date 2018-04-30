<?php
include("config.php");
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $mygroupname = mysqli_real_escape_string($db,$_POST['groupName']);
      preg_replace('/[^A-Za-z0-9\-]/', '', $mygroupname);
         $sql = "SELECT COUNT(*) FROM Groups WHERE groupName = '" . $mygroupname . "'";
         if(mysqli_fetch_row(mysqli_query($db, $sql))[0])
              $error = "Group Name already exists";
          else {
            $temp = "SELECT userID FROM Users WHERE username = '" . $_SESSION['username'] . "'";
            $userID = mysqli_fetch_row(mysqli_query($db, $temp))[0];
            $sql = "INSERT INTO Groups (ownerID, groupName)
                  VALUES ('" . $userID . "', '" . $mygroupname . "')";
            mysqli_query($db, $sql);
            header("location:home.php");
          }
      }
?>

<?php /*include "templates/header.php"; ?><h2>Create Group</h2>

<form method="post">
	<label for="groupName">Group Name</label>
	<input type="text" name="groupName" id="groupName">
	<input type="submit" name="submit" value="Submit">
</form>
<a href="home.php">Back to home</a>
<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
<?php include "templates/footer.php"; */?>

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
            <div style = "background-color:#333333; color:coral; padding:3px; font-size: 30px;
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Create Group</b></div>
            <div style = "margin:20px;">
               
               <form action = "" method = "post" style = "width: 400px;" >
                  <label for="groupName">Group Name</label>
                  <input type="groupName" name="groupName" id="groupName" class = "box">
                  <input type="submit" name="submit" value="Submit" >
                 
               </form>
						 	 <hr></hr>
               <a href="home.php"style = "font-family: fantasy; font-size: large; color: coral;">Back to home</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
              
              </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>