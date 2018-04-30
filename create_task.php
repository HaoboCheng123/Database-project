

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
           <div class = "board" style = "width : 400px">
            <div style = "background-color:#333333; color:coral; padding:3px; font-size: 30px;
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Create Task</b></div>
            <div style = "margin:20px;">
              <p style = "font-family: cursive; color: black;">Your Groups:</p>
              
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
                      $mytaskname = mysqli_real_escape_string($db,$_POST['taskName']);
                      $mygroupname = mysqli_real_escape_string($db,$_POST['group']);
                      preg_replace('/[^A-Za-z0-9\-]/', '', $mytaskname);
                      preg_replace('/[^A-Za-z0-9\-]/', '', $mygroupname);

                      // if multiple boxes are checked, will default to highest priority
                      if(mysqli_real_escape_string($db,$_POST['hi']))
                        $mypriority = 'H';
                      else if(mysqli_real_escape_string($db,$_POST['med']))
                        $mypriority = 'M';
                      else
                        $mypriority = 'L';
                   
                      $cat = mysqli_real_escape_string($db,$_POST['cat']);
                      $csql = "SELECT COUNT(*) FROM Tasks WHERE category = '" . $cat . "'";
                       $gsql = "SELECT COUNT(*) FROM Groups WHERE groupName = '" . $mygroupname . "'";
                       if(!mysqli_fetch_row(mysqli_query($db, $gsql))[0])
                            $error = "Group Name does not exist";
                      else if(mysqli_fetch_row(mysqli_query($db, $gsql))[0])
                            $error = "Task already exists with input Category";
                      else {
                          $sql = "SELECT userID FROM Users WHERE username = '" . $_SESSION['username'] . "'";
                          $userID = mysqli_fetch_row(mysqli_query($db, $sql))[0];
                          $sql = "INSERT INTO Tasks (taskName, category, dueDate, progress, priority, ownerID) VALUES ('";
                          $sql .= $mytaskname . "', '" . $cat . "', '";
                          $sql .= mysqli_real_escape_string($db,$_POST['dueDate']) . "', '" . mysqli_real_escape_string($db,$_POST['prog']);
                          $sql .= "', '" . $mypriority . "', '" . $userID . "')";
                          mysqli_query($db, $sql);
                          $temp = "SELECT taskID FROM Tasks WHERE taskName = '" . $mytaskname . "'";
                          $taskID = mysqli_fetch_row(mysqli_query($db, $temp))[0];
                          $temp = "SELECT groupID FROM Groups WHERE groupName = '" . $mygroupname . "'";
                          $sql = "INSERT INTO Task2Group (taskID, groupID) VALUES ('" . $taskID . "', '" . mysqli_fetch_row(mysqli_query($db, $temp))[0] . "')";
                          mysqli_query($db, $sql);
                          header("location:home.php");
                      }
                  }
              ?>
              <br>
               
               <form method="post" style = "width: 400px;">
                <label for="taskName" style = "color: black">Task Name</label>
                <input type="text" name="taskName" id="taskName" class = "box" style = "margin-left: 8%"><br>
                <label for="cat" style = "color: black">Category</label>
                <input type="text" name="cat" id="cat" class = "box" style = "margin-left: 14%"><br>
                <label for="dueDate" style = "color: black">Date Due</label>
                <input type="datetime-local" name="dueDate" id="dueDate" class = "box" style = "margin-left: 13%"><br>
                <label for="group" style = "color: black">Group</label>
                <input type="text" name="group" id="group" class = "box" style = "margin-left: 22%"><br>
                <label for="prog" style = "color: black">Progress</label>
                <input type="text" name="prog" id="prog" class = "box" style = "margin-left: 15%"><br>
                <label for="hi" style = "color: black">Priority = High</label>
                <input type="checkbox" name="hi" id="hi" value="true" class = "box">
                <label for="med" style = "color: black">Medium</label>
                <input type="checkbox" name="med" id="med" value="true" class = "box">
                <label for="lo" style = "color: black">Low</label>
                <input type="checkbox" name="lo" id="lo" value="true" class = "box">
                 <br>
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