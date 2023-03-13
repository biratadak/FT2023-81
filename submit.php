<?php

require("class/dbconnection.php");
session_start();
if (!isset($_SESSION['loggedIn']))
  header("Location:index.php");
else {
  // Connect with user-pass table.
  $db = new Database();
  $up = $db->connect("login_credentials");
  $id = $_SESSION['userId'];
  $sql = "select name from user_pass where userid='" . $id . "'";
  $name = $up->query($sql)->fetch_row()[0];
}
?>

<head>
  <title>My Site</title>
  <link rel="stylesheet" href="stylesheet/style.css">
</head>
 
<body>
  <div class="container">
    <h3>Welcome, <i><b>
          <?php echo $name; ?>.
        </b></i></h3>

    <?php include('../Assignment 6/index.php') ?>
    <a class="logout-btn" href="logout.php">Logout</a>
  </div>

</body>
