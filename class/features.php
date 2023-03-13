<?php

require('../../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use GuzzleHttp\Client;

//Getting secret credentials using dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
/** 
 * Provides some usefull features for the checking, validating and upload files.
 * 
 * @method onlyAlpha().
 *   Checks wether given str is only alphabet or not.
 * 
 * @method onlyDigit().
 *   Checks wether given str is only digit or not. 
 * 
 * @method validMailId().
 *   Checks if Mail Id is valid or not using RegEx.
 * 
 * @method validMailBox().
 *   Checks if Mail Id is valid or not using MailBoxLayer and Guzzle.
 * 
 * @method sendMail().
 *   sends mail to given email Id.
 * 
 * @method getURL().
 *   Get response body of given URL using GuzzleHTTP client request.
 * 
 * @method validPass
 *   Checks for password validity with alphabets, digits and special characters.
 * 
 * @property string $name
 *  Store name off the user.
 * 
 * @property string $mailId
 *  Store mailId of the user.
 * 
 * @property string $marks
 *  Store marks of the user.
 * 
 * @property string $phoneNo
 *  Store phoneNo of the user.
 * 
 * @property string $imagePath
 *  Store path of profile-pic of the user.
 * 
 **/
class Features
{
  // String methods here 

  /** 
   * Checks if a string only contains alphabets and whitespaces
   * 
   * @param  $string
   *   stores the string to varify. 
   **/
  function onlyAlpha($string)
  {
    if (preg_match("/^[a-zA-Z-' ]*$/", $string)) {
      return TRUE;
    } 
    else {
      return FALSE;
    }
  }

  /** 
   * Fucntion to check the string only has digits
   * 
   * @param  $string
   *   stores the string to varify. 
   **/
  function onlyDigit($string)
  {
    if (preg_match("/^[1-9][0-9]{0,15}$/", $string)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }


  /**
   * Checks if Mail Id is valid or not using RegEx.
   * 
   * @param  $mailId
   *  Stores the Mail Id of the user. 
   * 
   **/
  function validMailId($mailId)
  {
    if (preg_match("/^[a-z-.]{1,20}[@][a-z]{1,10}[.][a-z]{2,4}$/", $mailId)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * Checks Mail Id validation with mailBoxLayer API.
   * 
   * @param  $mailId
   *  Stores the Mail Id of the user. 
   * 
   **/
  function validMailBox($mailId)
  {
    // API Calling using HttpGuzzle.
    $client = new Client([
      //base uri of the site
      'base_uri' => 'https://api.apilayer.com/ ?email=',
    ]);

    $request = $client->request('GET', 'email_verification/check', [
      "headers" => [
        'apikey' => $_ENV['apiKey']
      ],
      'query' => [
        'email' => $mailId,
      ]
    ]);
    $response = $request->getBody();



    // Checking format, mx, smtp, and deliverablity score for the mail
    if (json_decode($response)->format_valid == TRUE && json_decode($response)->mx_found == TRUE && json_decode($response)->smtp_check == TRUE) {
      echo "<br>(E-mail deliverablity score is: " . ((json_decode($response)->score) * 100) . "% ).";
      return TRUE;
    } 
    else {
      echo "<div class='error'>Error:<br>";

      if (isset(json_decode($response)->format_valid) && json_decode($response)->format_valid == FALSE) {
        echo "E-mail format is not valid<br>";
      }
      if (isset(json_decode($response)->mx_found) && json_decode($response)->mx_found == FALSE) {
        echo "MX-Records not found<br>";
      }
      if (isset(json_decode($response)->smtp_check) && json_decode($response)->smtp_check == FALSE) {
        echo "SMTP validation failed<br>";
      }
      echo "</div>";
      return false;
    }
  }

  //Send Mails using PHP-Mailer
  /** 
   * Send Mails using PHP-Mailer. 
   * @param  $mailId
   *   takes mailId as input field data of the user. 
   * 
   * @param  $subject
   *   takes subject for the mail. 
   * 
   * @param  $body
   *   takes body of the mail. 
   * 
   **/
  function sendMail($mailId, $subject = "Subject", $body = "no data found")
  {
    $mail = new PHPMailer(true);

    try {
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $_ENV['SMTPMail'];
      $mail->Password = $_ENV['SMTPKey'];
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom($mailId, 'PHP-MYSQL Task');
      $mail->addAddress($mailId);

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->AltBody = 'Body in plain text for non-HTML mail clients';
      $mail->send();
      echo "<h4 class='success'>Mail successfully sent to: " . $mailId . "</h4>";
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  /** 
   * Get response body from url using Guzzle.
   * @param  $url
   *   takes url as input and return response body. 
   * 
   **/
  function getURL($url)
  {
    $client = new Client([
      //base uri of the site
      'base_uri' => $url,
    ]);

    $request = $client->request('GET');
    return $request->getBody();
  }

  /**
   * Checks for password validity with alphabets, digits and special characters.
   * 
   * @param mixed $pass
   *  stores the password
   */
  function validPass($pass)
  {

    if (preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $pass)) {
      return TRUE;
    } 
    else {
      return FALSE;
    }

  }


}

?>
