<?php

// Code to redirect the page to given URL 
function redirect_to($url)
{
    header("Location: " . $url);
    exit;
}

// Pager section to redirect pages using query parameter
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
      $wrongInput = TRUE;
  }

?>
