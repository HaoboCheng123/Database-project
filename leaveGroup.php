

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
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Leave A Group</b></div>
            <div style = "margin:20px;">
               
               <form method="post" style = "width: auto;">
                 <p style = "font-family: cursive; font-size: large; color: black;">Groups Your Are In:</p>
                 <?php
                  include("config.php");
                  session_start();
                  $sql = "SELECT groupName FROM Groups g Natural Join Members m  Natural Join Users u WHERE u.username = '";
                  $sql .= $_SESSION['username'] . "'";
                  $result = mysqli_query($db, $sql);
                  while ($tuple = mysqli_fetch_assoc($result))
                      printf ("%s<br>", $tuple["groupName"]);
                  mysqli_free_result($result);

                     if($_SERVER["REQUEST_METHOD"] == "POST") {
                       //change this logic to display current user's groups, then remove current user from selected group
                          $mygroupname = mysqli_real_escape_string($db,$_POST['groupName']);
                              $temp = "SELECT userID FROM Users WHERE username = '" . $_SESSION['username'] . "'";
                              $userID = mysqli_fetch_row(mysqli_query($db, $temp))[0]; 
                              $temp = "SELECT groupID FROM Groups WHERE groupName = '" . $mygroupname . "'";
                              $groupID = mysqli_fetch_row(mysqli_query($db, $temp))[0];
                              $sql = "DELETE FROM Members WHERE groupID = '" . $groupID . "' AND userID = '" . $userID . "'";
                              mysqli_query($db, $sql);
                              header("location:leaveGroup.php");
                            }
                  ?>
                 <hr></hr>
                 <label for="groupName" style = "color: black">Group Name</label>
                 <input type="text" name="groupName" id="groupName" class = "box">
                 <input type="submit" name="submit" value="Leave">
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