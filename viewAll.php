<html>
   
   <head>     
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
            <div style = "margin:20px;">
               
               <form method="post" style = "width: auto;">
                 <p style = "font-family: cursive; font-size: large; color: black;">All Users:</p>
                 <?php
                  include("config.php");
                  session_start();
                  $sql = "SELECT username FROM Users WHERE NOT username = '" . $_SESSION['username'] . "'";
                  $result = mysqli_query($db, $sql);
                  echo "<br>";
                  while ($tuple = mysqli_fetch_assoc($result))
                      printf ("%s<br>", $tuple["username"]);
                  echo "<br>";
                  mysqli_free_result($result);
                  ?>
                 <hr>
                 <p style = "font-family: cursive; font-size: large; color: black;">All Tasks:</p>
                 <?php
                  include("config.php");
                  session_start();
                  $sql = "SELECT taskName FROM Tasks";
                  $result = mysqli_query($db, $sql);
                  echo "<br>";
                  while ($tuple = mysqli_fetch_assoc($result))
                      printf ("%s<br>", $tuple["taskName"]);
                  echo "<br>";
                  mysqli_free_result($result);
                  ?>
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