<!DOCTYPE html>
<?php
session_start();
// Code to redirect the page to given URL 
function redirect_to($url)
{
    header("Location: " . $url);
    exit;
}
?>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../stylesheet/error-style.css">
    <title>Error</title>
</head>
<body>
    <div class="text-clip center">
        <H1 >Opps!</H1>
    </div>
    <div class="center">
        <h2>Errors:</h1>
        </div>
        <!-- <?php
        // echo'<div class="center">';

        // echo $_SESSION['userId-err'];
        // echo $_SESSION['pass-err'];
        // echo '</div>'
        
        ?> -->
</body>
</html>