<head>
    <title>Assgnment 5</title>
    <link rel="stylesheet" href="../stylesheet/style.css">
</head>
<?php
session_start();
// Code to redirect the page to given URL 
function redirect_to($url)
{
    header("Location: " . $url);
    exit;
}
?>
<?php
$ID = "admin";
$PASSWORD = "password";

echo '<div class="logout-btn ">';
    echo "<a href='logout.php'><input class='hover-eff click-eff' type=button value='Logout' name='logout'></a>";
    echo '</div>';
if (isset($_SESSION['userId'])) {

    // pager section to redirect pages using query
    if (isset($_GET['q']))
        switch ($_GET['q']) {
            case 1:
                redirect_to("http://php.nginx/Assignment%201/index.html");
                break;
            case 2:
                redirect_to("http://php.nginx/Assignment%202/index.html");
                break;
            case 3:
                redirect_to("http://php.nginx/Assignment%203/index.html");
                break;
            case 4:
                redirect_to("http://php.nginx/Assignment%204/index.html");
                break;
            case 5:
                redirect_to("http://php.nginx/Assignment%205/index.html");
                break;
            case 6:
                redirect_to("http://php.nginx/Assignment%206/index.html");
                break;
            default:
                echo ("<br><h2 class='error'>#" . $_GET['q'] . " is not a valid Assignment");
                $wrongInput=true;
        }
        if(!isset($wrongInput)){
        echo '<div class="welcome-txt">';
        echo "<h1>WELCOME " . $_SESSION['userId'] . "</h1>";
        echo '</div>';
        }

        

    // echo "";
    // echo "<a href='http://php.nginx/Assignment%202/index.html'>A2</a><br>";
    // echo "<a href='http://php.nginx/Assignment%203/index.html'>A3</a><br>";
    // echo "<a href='http://php.nginx/Assignment%204/index.html'>A4</a><br>";
    // echo "<a href='http://php.nginx/Assignment%205/index.html'>A5</a><br>";
    // echo "<a href='http://php.nginx/Assignment%206/index.html'>A6</a><br>";
    

} else {
    if ($_POST['userId'] == $ID && $_POST['pass'] == $PASSWORD) {
        $_SESSION['userId'] = $ID;
        redirect_to("submit.php");

    } else {

        // echo '<div class="error">';
        // echo "Login credentials  failed";
        if ($_POST['userId'] != $ID)
            $_SESSION['userId-err'] = "<br>UserId not valid";
        if ($_POST['pass'] != $PASSWORD)
            $_SESSION['pass-err'] = "<br>Password not valid";
        // echo '</div>';
        redirect_to('../class/error.php');
    }
}
?>
<div class="grid">
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%201/index.html'>Assignment 1</a><br>
        </div>
        
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%202/index.html'>Assignment 2</a><br>
        </div>
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%203/index.html'>Assignment 3</a><br>
        </div>
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%204/index.html'>Assignment 4</a><br>
        </div>
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%205/index.html'>Assignment 5</a><br>
        </div>
        <div class="grid-items">
        <a class="grid-items hover-eff click-eff" href='http://php.nginx/Assignment%206/index.html'>Assignment 6</a><br>
        </div>

</div>