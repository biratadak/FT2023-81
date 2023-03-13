<?php

require("class/dbconnection.php");

// If already loggedin redirect to submit page.
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
  header("Location:submit.php");

// Password validation section
$db = new Database();
// Connect with user-pass table database.
$up = $db->connect("login_credentials");
 
// Checks first if submit is clicked
if (isset($_POST["name"]) && isset($_POST["mailId"]) && isset($_POST["userId"]) && isset($_POST["pass"])) {
  // If id and pass fields are not empty.
  if ($_POST['name'] != "" && $_POST["mailId"] != "" && $_POST['userId'] != "" && $_POST["pass"] != "") {
    if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['name']))
      echo "<br><h4 class='error'>Invalid name</h4>";
    if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $_POST['mailId']))
      echo "<br><h4 class='error'>Invalid email address.</h4>";
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['userId']))
      echo "<br><h4 class='error'>User Id should only contain alphabet numbers and space</h4>";
    if (isset($up->query("select pass from user_pass where userid='" . $_POST["userId"] . "'")->fetch_assoc()['pass'])) {
      // If pass and user is correct and available in db
      echo "<br><h4 class='error'>User Id is unavailable</h4>";
    } 
    else {
      try {

        $sql = "INSERT INTO user_pass(name, mailid, userid, pass) values('" . $_POST['name'] . "','" . $_POST["mailId"] . "','" . $_POST['userId'] . "','" . $_POST['pass'] . "')";
        $up->query($sql);
        echo "<h3 class='success'>Account Successfully created<br> Try to Login</h3>";
        echo "<span >Redirecting page in <span class='counter'>10</span> sec.</span>";
        header("refresh:10;url=index.php");

      } 
      catch (Exception $e) {
        echo $e;
      }

    }
  } 
  else {
    echo "<h4 class='error'>All fileds should be filled</h4>";
  }
}
?>
<html>

<head>
  <link rel="stylesheet" href="stylesheet/style.css">
  <title>Register</title>
  <script src="class/validation.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />


</head>

<body>

  <h2>Registration Page</h2>
  <form class="form-div" method="POST" action="register.php" onsubmit="return validate()">
    Name: <span class="error" name="nameerr">*
    </span><br> <input type="text" name="name" value=<?php if (isset($_POST['name']))
      echo $_POST['name']; ?>>

    <br><br>
    Email: <span class="error" name="mailerr">*
    </span><br><input type="text" name="mailId" value=<?php if (isset($_POST['mailId']))
      echo $_POST['mailId']; ?>>

    <br><br>
    User Id: <span class="error" name="usererr">*
    </span><br><input type="text" name="userId" value=<?php if (isset($_POST['userId']))
      echo $_POST['userId']; ?>>

    <br><br>
    Password: <span class="error" name="passerr">*
    </span><br><input type="password" name="pass" id="pass" value=<?php if (isset($_POST['pass']))
      echo $_POST['pass']; ?>><i class="bi bi-eye-slash " id="togglePassword"></i>

    <br><br>
    <div class="sp-bw">
      <input type="submit" class="hover-eff click-eff btn" name="register" value="Regiser User">
      <a class="link-btn grow" href="index.php">Already have account.</a>

    </div>

  </form>


</body>
<script>
  //Check validation
  function validate() {
    if (document.getElementsByName("nameerr")[0].innerHTML == "" && document.getElementsByName("mailerr")[0].innerHTML == "" && document.getElementsByName("usererr")[0].innerHTML == "" && document.getElementsByName("passerr")[0].innerHTML == "") {
      return true;
    }
    else {
      alert("Fill all fields properly");
      return false;
    }
  };

  allLetter("name", "nameerr");
  validMail("mailId", "mailerr");
  validUser("userId", "usererr");
  validPass("pass", "passerr");
  togglePass("#togglePassword", "#pass");
  countDown(".counter", 10);
</script>

</html>
