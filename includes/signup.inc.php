<?php

if (isset($_POST["submit"])) {


  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];

  require_once "functions.inc.php";

  require_once "dbh.inc.php";

  if (emptyInputsSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
   header('location: /singup.php?error=emptyinput');
    exit();
  }

  if (invalidUid($username) !== false) {
    header('location: /singup.php?error=invaliduid');
    exit();
  }

  if (invalidEmail($email) !== false) {
   header('location: /singup.php?error=invalidemail');
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header('location: /singup.php?error=passwordnotmatch');
    exit();
  }

  if (uidExists($conn, $username, $email) !== false) {

    header('location: /singup.php?error=sameinput');
    exit();
  }

    createUser($conn, $name, $email, $username, $pwd);



}
else {

  header("location: /signup.php");
  exit();
}
