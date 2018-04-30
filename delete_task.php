

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
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Delete Task</b></div>
            <div style = "margin:20px;">
           
             <p style = "font-family:cursive;">Owned Tasks:</p>
        
             <?php
              include("config.php");
              session_start();
              $sql = "SELECT taskName FROM Tasks t Join Users u ON t.ownerID = u.userID WHERE u.username = '";
              $sql .= $_SESSION['username'] . "'";
              $result = mysqli_query($db, $sql);
              while ($tuple = mysqli_fetch_assoc($result))
                  printf ("%s<br>", $tuple["taskName"]);
              mysqli_free_result($result);

                 if($_SERVER["REQUEST_METHOD"] == "POST") {
                      $mytaskname = mysqli_real_escape_string($db,$_POST['taskName']);
                    preg_replace('/[^A-Za-z0-9\-]/', '', $mytaskname);

                       $sql = "SELECT username FROM Tasks t Join Users u ON t.ownerID = u.userID WHERE t.taskName = '" . $mytaskname . "'";
                       if(mysqli_fetch_row(mysqli_query($db, $sql))[0] != $_SESSION['username'])
                            $error = "You do not own this task";
                      else {
                          $sql = "DELETE FROM Tasks2Group tg Natural Join Tasks t WHERE t.taskName = '" . $mytaskname . "'";
                          mysqli_query($db, $sql);
                          $sql = "DELETE FROM Tasks WHERE taskName = '" . $mytaskname . "'";
                          mysqli_query($db, $sql);
                          header("location:home.php");
                      }
                  }
              ?>
              <hr>
           
               
               <form method="post" style = "width: 400px;">
                <label for="taskName" style="color:black">Task Name:</label>
                <input type="text" name="taskName" id="taskName" class = "box" style = "margin-left: 8%"><br>
                <input type="submit" name="submit" value="Submit">
              </form>
              
						 	 <hr></hr>
               <a href="home.php"style = "font-family: fantasy; font-size: large; color: coral;">Back to home</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
              
              </div>
             </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>