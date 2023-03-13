<?php
require("class/dbconnection.php");
require("class/features.php");
session_start();
$feature=new features();
// If already loggedin redirect to submit page.
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)
  header("Location:submit.php");

// If not redirected from forgot password page then redirect to login page.
if (!isset($_SESSION['userId']))
  header("Location:class/error.php");

?>
<html>

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="stylesheet/style.css">
  <title>Password Reset</title>
  <script src="class/validation.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />


</head>
<?php
if (isset($_POST['pass']) && isset($_POST['confirmPass']) && !empty($_POST['pass']) && !empty($_POST['confirmPass'])) {

  if ($_POST['pass'] == $_POST['confirmPass'] && $feature->validpass($_POST['pass'])) {
    $db = new Database();
    $up = $db->connect("login_credentials");
    $sql = 'UPDATE user_pass SET pass= "' . $_POST['pass'] . '" WHERE userid="' . $_SESSION['userId'] . '"';
    $up->query($sql);
    echo "<h4 class='success'>Password updated successfully</h4>";
    unset($_SESSION['userId']);
    echo "<span >Redirecting page in <span class='counter'>10</span> sec.</span>";
    header("refresh:10;url=index.php");
  } 
  elseif((!$feature->validpass($_POST['pass']) || !$feature->validpass($_POST['confirmPass'])) && $_POST['pass'] == $_POST['confirmPass']){
    echo "<h4 class='error'>Password not valid</h4>";
  }
  else {
    echo "<h4 class='error'>Password not matched</h4>";
  }
}

?>

<body>

  <form class="form-div fd-col sp-bw" action=<?php if (isset($_SESSION['userId']))
    echo $_SERVER["PHP_SELF"] . "?user=" . $_GET['user'] ?> method="POST" onsubmit="return validate()">
      <div>

        <label for="password">Password:</label><span class="error" name="passerr">*
        </span><br>
        <input type="password" name="pass" id="pass" value='<?php if (isset($_POST['pass']))
    echo $_POST['pass']; ?>'><i class="bi bi-eye-slash " id="togglePassword"></i>
    </div>

    <div>
      <label for="password">Confirm Password:</label><span class="error" name="confpasserr">*
      </span><br>
      <input type="password" name="confirmPass" id="confirmPass" value='<?php if (isset($_POST['confirmPass']))
        echo $_POST['confirmPass']; ?>'><i class="bi bi-eye-slash " id="toggleConfirmPassword"></i>
    </div>
    <?php
    // If the userId is not valid as query param then disable RESET button.
    if (isset($_GET['user']) && isset($_SESSION['userId']) && base64_decode($_GET['user']) == $_SESSION['userId']) {
      echo '<input class="click-eff hover-eff btn" type="submit" value="Reset Password">';
    }

    ?>

  </form>
</body>
<script>
  function validate() {
    if (document.querySelector("#pass").value === document.querySelector("#confirmPass").value && document.querySelector("#pass").value !== "")
      return TRUE;
    else
      return FALSE;
  }
  togglePass("#togglePassword", "#pass");
  togglePass("#toggleconfirmPassword", "#confirmPass");
  validPass("pass", "passerr");
  validPass("confirmPass", "confpasserr");
  countDown(".counter",10);

</script>

</html>
