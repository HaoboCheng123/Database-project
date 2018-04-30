

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
    font-family: cursive;  text-align: center;  border-radius: 40px;"><b>Edit Task</b></div>
            <div style = "margin:20px;">
               
               <form method="post" style = "width: auto;">
                 <p style = "font-family: cursive; font-size: large; color: black;">Your Tasks:</p>
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
                  printf("High Priority:<br>");
                  foreach($hi as $var) {
                    printf(" %s<br>", $var["taskName"]);
                  }
                  printf("<br>Medium Priority:<br>");
                  foreach($med as $var) {
                    printf(" %s<br>", $var["taskName"]);
                  }
                  printf("<br>Low Priority:<br>");
                  foreach($lo as $var) {
                    printf(" %s<br>", $var["taskName"]);
                  }
                  echo "<br>";


                   if($_SERVER["REQUEST_METHOD"] == "POST") {
                          $mytaskname = mysqli_real_escape_string($db,$_POST['taskName']);
                          $sql = "UPDATE Tasks SET progress = '" . mysqli_real_escape_string($db,$_POST['prog']) . "'";
                          $sql .= "WHERE taskName = '" . $mytaskname ."'";
                          mysqli_query($db, $sql);
                          header("location:home.php");
                      }
                  ?>

                 <hr>

                  <form method="post">
                    <label for="taskName" style = "color: black">Task Name:</label>
                    <input type="text" name="taskName" id="taskName" class = "box">
                    <label for="prog" style = "color: black">Progress:</label>
                    <input type="text" name="prog" id="prog"  class = "box" style = "margin-left:7%">
                    <br>
                    <input type="submit" name="submit" value="Submit">
                    <hr>
                    
                    <a href="home.php" style = "font-family: fantasy; font-size: large; color: coral;">Back to Home</a>
                  </form>
                  
              </form>
              <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?>
                 </div>
              
              </div>
					
             
            </div>
				
         </div>
      </div>
   

   </body>
</html>