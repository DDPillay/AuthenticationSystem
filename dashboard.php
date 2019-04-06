<html>
  <head>
    <title>User Dashboard</title>
    <link type="text/css" href="inclusions/style.css" rel="stylesheet">
  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION['username']))
      {
        $username = $_SESSION['username'];
        echo("<p>Welcome $username. You have been signed in.</p>");
      }
      else
      {
        header("Location: index.html");
      }
    ?>
    <a href="index.php?signOut=success">Sign out</a>
