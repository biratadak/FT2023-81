<?php
require("class/dbconnection.php");
require("class/features.php");
session_start();


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
if (isset($_POST['pass']) && isset($_POST['confirmPass'])) {

    if ($_POST['pass'] == $_POST['confirmPass']) {
        $db = new Database();
        $up = $db->connect("login_credentials");
        $sql = 'UPDATE user_pass SET pass= "' . $_POST['pass'] . '" WHERE userid="' . $_SESSION['userId'] . '"';
        $up->query($sql);
        echo "Password updated successfully";
    } else {
        echo "Password not matched";
    }
}


?>

<body>
    <form class="form-div fd-col sp-bw" action=<?php echo $_SERVER["PHP_SELF"]?> method="POST" onsubmit="return validate()" >
        <div>

            <label for="password">Password:</label>
            <input type="password" name="pass" id="pass" value='<?php if (isset($_POST['pass']))
                echo $_POST['pass']; ?>'><i class="bi bi-eye-slash " id="togglePassword"></i>
        </div>

        <div>
            <label for="password">Confirm Password:</label>
            <input type="password" name="confirmPass" id="confirmPass" value='<?php if (isset($_POST['confirmPass']))
                echo $_POST['confirmPass']; ?>'><i class="bi bi-eye-slash " id="toggleConfirmPassword"></i>
        </div>
        <?php
        // If the userId is not valid as query param then disable RESET button.
        if (isset($_GET['user']) && base64_decode($_GET['user']) == $_SESSION['userId']) {

            echo '<input class="click-eff hover-eff btn" type="submit" value="Reset Password">';
        }
        // else if(isset($_GET['user']) && base64_decode($_GET['user']) != $_SESSION['userId'] )
        // header("Location:class/error.php");
        ?>

    </form>
</body>
<script>
togglepass("#togglePassword","#pass");
togglepass("#toggleconfirmPassword","#confirmPass");
function validate(){
    if(document.querySelector("#pass").value===document.querySelector("#confirmPass").value)
        return TRUE;
    else
        return FALSE;  
}

</script>

</html>