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
        .board{
          border-radius: 40px;
          margin:10px;
          background-color: white;
        }
      </style>
      
   </head>
  <body style="margin: 0;">
   <div class = "bg">
    <p style = "font-size:xx-large; margin-left: 41%; height: 30%"></p>
         <div style = "width:400px; margin-left:41%;" align = "left">
           <div class = "board">
            <div style = "background-color:#333333; color:coral; padding:3px; font-size: 30px;
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Join Existing Group</b></div>
            <div style = "margin:20px;">
               
               <form method="post" style = "width: auto;">
                 <p style = "font-family: cursive; font-size: large; color: black;">Available Groups:</p>
                 <?php
                  include("config.php");
                  session_start();
                  $sql = "SELECT DISTINCT groupName FROM Groups g Natural Join Members m Natural Join Users u WHERE NOT u.username = '";
                  $sql .= $_SESSION['username'] . "'";
                  $result = mysqli_query($db, $sql);
                  while ($tuple = mysqli_fetch_assoc($result))
                      printf ("%s<br>", $tuple["groupName"]);
                  echo "<br>";
                  mysqli_free_result($result);

                  if($_SERVER["REQUEST_METHOD"] == "POST") {
                      $groupname = mysqli_real_escape_string($db,$_POST['join']);
                      $sql = "SELECT COUNT(*) FROM Groups WHERE groupName = '" . $groupname . "'";
                           if(!mysqli_fetch_row(mysqli_query($db, $sql))[0])
                                $error = "Group Name does not exist";
                          else {
                              $temp = "SELECT userID FROM Users WHERE username = '" . $_SESSION['username'] . "'";
                              $userID = mysqli_fetch_row(mysqli_query($db, $temp))[0];
                              $temp = "SELECT groupID FROM Groups WHERE groupName = '" . $groupname . "'";
                              $sql = "INSERT INTO Members (userID, groupID) VALUES ('" . $userID . "', '";
                              $sql .= mysqli_fetch_row(mysqli_query($db, $temp))[0] . "')";
                              mysqli_query($db, $sql);
                              header("location:home.php");
                          }
                  }
                  ?>
                 <hr></hr>
                 <label for="join" style = "color: black">Join Group</label>
                 <input type="text" name="join" id="join" class = "box">
                 <input type="submit" name="submit" value="Join">
                 <hr></hr>
                 <a href="home.php"style = "font-family: fantasy; font-size: large; color: coral;">Back to home</a>
              </form>
              
						 	 
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
                 </div>
              
              </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>