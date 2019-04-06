<?php
  if(!isset($_POST['signUp']))
  {
    header("Location: ../");
    exit();
  }
  include("db.php");
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  if(empty($username) || empty($email) || empty($password) || empty($confirmPassword))
  {
    header("Location: ../signUp.php?signUp=blank");
    exit();
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    header("Location: ../signUp.php?signUp=invalidEmail");
    exit();
  }
  if($password != $confirmPassword)
  {
    header("Location: ../signUp.php?signUp=passwordMismatch");
    exit();
  }
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO tbl_users (USERNAME, EMAIL, PASS) VALUES (?,?,?);";
  $stmt = mysqli_stmt_init($connection);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
  mysqli_stmt_execute($stmt);
  if(mysqli_stmt_affected_rows($stmt) == -1)
  {
    header("Location: ../signUp.php?signUp=duplicate");
    exit();
  }
  header("Location: ../index.php?signUp=success");
?>
