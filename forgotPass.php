<?php
require("class/dbconnection.php");
require("class/features.php");
session_start();

// If already loggedin redirect to submit page.
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
  header("Location:submit.php");

// Connect with user-pass table database.
$db = new Database();
$up = $db->connect("login_credentials");


// Checks first if submit is clicked
if (isset($_POST["userId"]) && isset($_POST["mailId"])) {
  // Checks if user id and mail id fields are not empty.
  if ($_POST['userId'] != "" && $_POST["mailId"] != "") {
    $sql = "select mailid from user_pass where userid='" . $_POST['userId'] . "'";
    $mail = $up->query($sql)->fetch_row()[0];
    if ($mail == $_POST['mailId']) {
      // If mail id is matched with user id send mail
      $feature = new features();
      $_SESSION['userId'] = $_POST['userId'];
      $feature->sendMail($_POST['mailId'], "Password reset link", '<a href="http://php.nginx/FT2023-81/resetPass.php?user=' . base64_encode($_SESSION['userId']) . '">Reset Password</a>');

    } 
    else {
      echo "<br><h5 class='error'>Mail Id is not valid for the user</h5>";
    }
  } 
  else {
    echo "<br><h5 class='error'>Fill User ID and Mail Id both</h5>";
  }
}
?>
<html>

<head>
  <link rel="stylesheet" href="stylesheet/style.css">
  <title>Login</title>
</head>

<body>

  <h2>Create New Password</h2>
  <form class="form-div" method="POST" action="forgotPass.php">
    User Id: <span class="error" name="usererr">*</span><br>
    <input type="text" name="userId" value=<?php if (isset($_SESSION['userId']))
      echo $_SESSION['userId']; ?>>

    </span>
    <br><br>
    Mail Id: <span class="error">*</span><br>
    <input type="email" name="mailId" value=<?php if (isset($_POST['mailId']))
      echo $_POST['mailId']; ?>>

    <br><br>
    <div class="sp-bw">
      <input class="hover-eff click-eff btn" type="submit" name="send mail" id="sendMailBtn" value="Send Mail">
      <a class="link-btn grow" href="register.php">I'm new</a>

    </div>

  </form>

</body>
<script>
  // If mail is sent then disable the sent mail button
  if (document.getElementsByClassName('success')[0].innerHTML);
  {
    console.log("mail sent");
    document.getElementById("sendMailBtn").disabled = true;
  }
</script>

</html>