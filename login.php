

<?php
   session_start();
   $servername = "localhost";
   $username = "phpmyadmin";
   $password = "space123";
   $dbname = "farming";

   			// Create connection
   			$conn = new mysqli($servername, $username, $password, $dbname);
   			// Check connection
   			if ($conn->connect_error) {
   				die("Connection failed: " . $conn->connect_error);
   			}
   			if(isset($_POST["loginBtn"])){
   			$username = mysqli_real_escape_string($conn, $_POST["username"]);
   			$password = mysqli_real_escape_string($conn, $_POST["pass"]);

   			$sel_user = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";

   			$run_user = mysqli_query($conn, $sel_user);

   			$check_user = mysqli_num_rows($run_user);

   			if($check_user > 0){
   				$_SESSION['username'] = $username;
   				echo "<script>window.open('buyerProfile.php', '_self')</script>";
   			}
   			else{
   			echo "invalid password or usename";
   			}

   		}

   ?>
<!DOCTYPE html>
<html >
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>E-Farm</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/heroic-features.css" rel="stylesheet">
   </head>
   <body style = "background-color:teal">
      <div style = "height: 75%;">
         <div class="login-form"  style = "margin-top: 75px;">
            <div class = "thumbnail" style="width: 50%; margin:auto;">
               <form method = "POST" style = "width:80%; margin: auto;">
                  <h1 align = "center"><strong>E-FARM</strong></h1>
                  <h2 align = "center">Customer Sign In</h2>
                  <div class="form-group">
                     <input type="text" class="form-control"  id="UserName" name ="username" placeholder="Username" value = ""  >
                     <i class="fa fa-user"></i>
                  </div>
                  <div class="form-group log-status">
                     <input type="password" class="form-control" placeholder="Password" id="Passwod" name = "pass">
                     <i class="fa fa-lock"></i>
                  </div>
                  <a class="link" style = "float: left;padding-left: 20px;"href="register.php">Register Here</a><a class="link" style = "float: right; padding-right: 20px;"href="forgot_pass.php">Forgot password?</a></br>
                  </br>
                  <div align = "center">
                     <button style =" width: 45%;" name = "loginBtn" type="submit" class="btn btn-primary" ><strong>SIGN IN</strong></button>
                     </br>
                     </br>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="js/index.js"></script>
      <div style = "padding: 1em 0 2em 0;">
      <footer id="footer" class="container" style ="color: black; width: 100%; ">
         <hr style = "border-top: 1px solid #ccc;">
         <br/><br/><br/>
         <p align = "center">Contact Us: +91 1234567890
            &copy; E-Farm. All rights reserved
         </p>
      </footer>
   </body>
</html>
