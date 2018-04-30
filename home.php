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
    <p style = "font-size:45px; text-align:center; background-image: url(./images&gifs/stargif.gif); color: white; font-family:fantasy; ">Home</p>
     <div style = "width = 100%;">
     <div style = "float: right">
         <div style = "width:400px; margin-left:-30%;" align = "left">
                   <div class = "board">
            <div style = "background-color:#333333; color:coral; padding:3px; font-size: 28px; font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Functionalities</b></div>
            <div style = "margin:20px;">
               
               <form action = "" method = "post">
                  <a href="create_group.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Create New Group<br></a><br>
                  <a href="joinExistingGroup.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Join Existing Group<br></a><br>
                 <a href="leaveGroup.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Leave A Current Group<br></a><br>
                 <a href="delete_group.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Delete Group<br></a><br>
                 <a href="create_task.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Create New Task<br></a><br>
                  <a href="edit_task.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Edit A Task's Progress<br></a><br>
                 <a href="delete_task.php" style = " font-family:cursive; color: coral; text-decoration: blink; font-size: large">Delete Task<br></a><br>
               </form>
						 	 <hr></hr>
               <a href="login.php"style = "font-family: fantasy; font-size: large; color: brown;">Logout</a>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
              </div>
           </div>
           </div>
            </div>		
         </div> 
    <div style = "float: left;">
      <div style = "width:400px; margin-left:30%; " align = "left" >
            
            <div style = "background-color:#333333; color:coral; padding:3px; font-size: 28px; font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Dashboard</b></div>
            <div style = "margin:20px;" >
               
               <form action = "" method = "post" >
                 
                 <div style = "float: left;">
                 <p style = "font-family: cursive; color: white; font-size:large">Your Groups:</p>
                 <div style =" background-color:white; border-radius:20px">
                 <?php
                  include("config.php"); 
                  session_start();//gives us access to $_SESSION values
                  $sql = "SELECT groupName FROM Groups g Natural Join Members m  Natural Join Users u WHERE u.username = '";
                  $sql .= $_SESSION['username'] . "'";
                  $result = mysqli_query($db, $sql);
                  echo "<br>";
                  while ($tuple = mysqli_fetch_assoc($result)){
                      printf ("%s<br>", $tuple["groupName"]);
                      echo "<br>";
                  }
                  mysqli_free_result($result);
                ?>
                 </div>
                 </div>
                 <div style = "float: right;">
                   <p style = "font-family: cursive; color: white; font-size:large">Your Tasks:</p>
                   <div style =" background-color:white; border-radius:20px">
                     <?php
                        include("config.php");
                        session_start();
                        $sql = "SELECT * FROM Tasks t Natural Join Task2Group tg Natural Join Members m Natural Join Users u WHERE u.username = '";
                        $sql .= $_SESSION['username'] . "'";
                        $result = mysqli_query($db, $sql);

                        $hi = array();
                        $med = array();
                        $lo = array();
                        while ($tuple = mysqli_fetch_assoc($result)) {
                            if($tuple["priority"] == 'H')
                              array_push($hi, $tuple);
                            else if($tuple["priority"] == 'M')
                              array_push($med, $tuple);
                            else
                              array_push($lo, $tuple);
                        }
                        mysqli_free_result($result);
                        printf("<br>High Priority:<br>");
                        foreach($hi as $var) {
                          printf("<br>%s<br>Date Due: ", $var["taskName"]);
                          echo $var["dueDate"];
                          printf("<br>Progress: %s<br>", $var["progress"]);
                        }
                        printf("<br>Medium Priority:<br>");
                        foreach($med as $var) {
                          printf("<br>%s<br>Date Due: ", $var["taskName"]);
                          echo $var["dueDate"];
                          printf("<br>Progress: %s<br>", $var["progress"]);
                        }
                        printf("<br>Low Priority:<br>");
                        foreach($lo as $var) {
                          printf("<br>%s<br>Date Due: ", $var["taskName"]);
                          echo $var["dueDate"];
                          printf("<br>Progress: %s<br>", $var["progress"]);
                        }
                        echo "<br>";
                        ?>
                   </div>
                 </div>
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
           </div>
            </div>
     
    
    
     </div>
      </div>
   
</div>	
   </body>
</html>


