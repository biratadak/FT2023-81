<?php

session_start();
//  Code to redirect the page to given URL 

function redirect_to($url)
{
  header("Location: " . $url);
  exit;
}

if (isset($_SESSION['loggedIn'])) {
  session_destroy();
  redirect_to("index.php");
} 
else {
  redirect_to("index.php");
}
 
?>
