<?php

require("class/dbconnection.php");
session_start();

// If already loggedin redirect to submit page.
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
  header("Location:submit.php");


// Password validation section
$db = new Database();
// Connect with user-pass table database.
$up = $db->connect("login_credentials");

// Checks first if submit is clicked
if (isset($_POST["userId"]) && isset($_POST["pass"])) {
  // If id and pass fields are not empty.
  if ($_POST['userId'] != "" && $_POST["pass"] != "") {
    if (isset($up->query("select pass from user_pass where userid='" . $_POST["userId"] . "'")->fetch_assoc()['pass'])) {
      $PASSWORD = $up->query("select pass from user_pass where userid='" . $_POST["userId"] . "'")->fetch_assoc()['pass'];
      // If pass and user is correct and available in db
      if ($_POST["pass"] == $PASSWORD) {
        $_SESSION["loggedIn"] = TRUE;
        $_SESSION['userId'] = $_POST['userId'];
        $_SESSION['pass'] = $_POST['pass'];
        header("Location:submit.php");
      }
      // If pass is incorrect for given user
      else {
        echo "<br><h4 class='error'>Incorrect Password</h4>";
        $forgotPass = TRUE;
        $_SESSION['userId'] = $_POST['userId'];
 
      }
    } else {
      echo "<br><h4 class='error'>Login credentials not valid</h4>";
    }
  } else {
    echo "<br><h4 class='error'>Fill all fileds</h4>";
  }
}
?>
<html>

<head>
  <link rel="stylesheet" href="stylesheet/style.css">
  <script src="class/validation.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <title>Login</title>

</head>

<body>

  <h2>Login Page</h2>
  <form class="form-div" method="POST" action="index.php" onsubmit="return validation()">
    User Id: <span class="error" name="usererr">*
    </span><br> <input type="text" name="userId" value=<?php if (isset($_POST['userId']))
      echo $_POST['userId']; ?>>
   
    <br><br>
    Password:<span class="error" name="passerr">*
    </span><br><input type="password" name="pass" id="pass" value=<?php if (isset($_POST['pass']))
      echo $_POST['pass']; ?>><i class="bi bi-eye-slash " id="togglePassword"></i>
    
    <?php if (isset($forgotPass) && $forgotPass)
      echo '<br><a class="link-btn" href="forgotPass.php">forgotten password?</a>' ?>
      <br><br>
      <div class="sp-bw">
        <input class="hover-eff click-eff btn" type="submit" name="submit" id="login-btn" value="Login">
        <a class="link-btn grow " href="register.php">I'm new</a>

      </div>

    </form>
   
  </body>
  <script>
    togglePass("#togglePassword","#pass");
  </script>
  </html>
