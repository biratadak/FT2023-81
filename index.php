<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <?php
  // Define variables and set to empty values
  $userIdErr = $passErr = "";
  $userId = $pass = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["userId"]) && !empty($_POST["pass"]))


      if (empty($_POST["userId"])) {
        $userIdErr = "UserId is required";
      } else {
        $userId = test_input($_POST["userId"]);
        // Check if userId only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $userId)) {
          $userIdErr = "Only letters and white space allowed";

        }
      }

    if (empty($_POST["pass"])) {
      $passErr = "Email is required";
    } else {
      $pass = test_input($_POST["pass"]);
    }

  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <h2>Login Page</h2>
  <form class="login-form" method="post" action="submit.php">
    <p><span class="error">* required field</span></p>
    User Id: <input type="text" name="userId" value="<?php echo $userId; ?>">
    <span class="error">*
      <?php echo $userIdErr; ?>
    </span>
    <br><br>
    Password: <input type="text" name="pass" value="<?php echo $pass; ?>">
    <span class="error">*
      <?php echo $passErr; ?>
    </span>
    <br><br>
    <div class="center">
      <input type="submit" name="submit" id="login-btn" value="Login">
    </div>

  </form>

</body>
</html>