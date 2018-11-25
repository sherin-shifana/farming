
<!DOCTYPE html>
<html>
<head>
  <title>E-Farm</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    form{
      padding: 3%;
      background-color:white;
      border-radius: 5px;

    }
  </style>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</head>
<body style= "background-color:teal">
    <div style = "height: 75%; margin-top: 50px;" >
        <form method="post" action="login.php" style = "width:50%; margin: auto;">
          <h1>Registration Form</h1>
          
        	<?php include('errors.php'); ?>
        	<div class="form-group">
        	  <label>Username</label>
        	  <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        	</div>
        	<div class="form-group">
        	  <label>Email</label>
        	  <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
        	</div>
        	<div class="form-group">
        	  <label>Password</label>
        	  <input class="form-control" type="password" name="password_1">
        	</div>
        	<div class="form-group">
        	  <label>Confirm password</label>
        	  <input class="form-control" type="password" name="password_2">
        	</div>
        	<div class="form-group">
        	  <button type="submit" class="btn" name="reg_user">Register</button>
            <?php
            session_start();


            $errors = array();

            // connect to the database
            $db = mysqli_connect('localhost', 'phpmyadmin', 'space123', 'farming');
            if(! $db)
            {
            die('Connection Failed'.mysql_error());
            }
            // REGISTER USER
            if (isset($_POST['reg_user'])) {
              // receive all input values from the form
              $username = $_POST['username'];
              $email = $_POST['email'];
              $password_1 = $_POST['password_1'];
              $password_2 = $_POST['password_2'];

              // form validation: ensure that the form is correctly filled ...
              // by adding (array_push()) corresponding error unto $errors array
              if (empty($username)) { array_push($errors, "Username is required"); }
              if (empty($email)) { array_push($errors, "Email is required"); }
              if (empty($password_1)) { array_push($errors, "Password is required"); }
              if ($password_1 != $password_2) {
            	array_push($errors, "The two passwords do not match");
              }

              // first check the database to make sure
              // a user does not already exist with the same username and/or email
              $user_check_query = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
              $result = mysqli_query($db, $user_check_query);
              $user = mysqli_fetch_assoc($result);

              if ($user) { // if user exists
                if ($user['username'] === $username) {
                  array_push($errors, "Username already exists");
                }

                if ($user['email'] === $email) {
                  array_push($errors, "email already exists");
                }
              }

              // Finally, register user if there are no errors in the form
              if (count($errors) == 0) {
              	// $password = md5($password_1);//encrypt the password before saving in the database

              	$query = "INSERT INTO `customers`(`username`, `email`, `password`) VALUES ('$username', '$email', '$password_1')";

              	mysqli_query($db, $query);
              	$_SESSION['username'] = $username;
              	$_SESSION['success'] = "You are now logged in";
              	header('location: index.php');
              }
            }
            ?>
        	</div>
        	<p>
        		Already a member? <a href="login.php">Sign in</a>
        	</p>
        </form>
    </div>
</body>
</html>
