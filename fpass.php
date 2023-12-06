<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Reset Password | MiCasa Events</title>
    <link rel="stylesheet" type="text/css" href="signStyle.css">
    <!-- Favicon -->
    <link href="img/calendar2-event-fill.svg" rel="icon" type="image/svg+xml">
</head>
<body>
  <section>
    <div class="form-box">
      <div class="forgetpass_box">
        <form action="send-password-reset.php" method="post">
          <h2>Forgot Password</h2>
          <div class="inputbox3">
            <input type="email" name="email" required>
            <label for="email">Email</label>
          </div>
          <button type="submit">Send</button>
          <a href="signin.php" class="back_btn">Login</a>
        </form>
      </div>
      <div class="error_box">
        <?php
        if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) {
          echo '<p class="error-message">' . $_SESSION['errorMessage'] . '</p>';
          unset($_SESSION['errorMessage']); 
        }
        if (isset($_SESSION['successMessage']) && !empty($_SESSION['successMessage'])) {
          echo '<p class="success-message">' . $_SESSION['successMessage'] . '</p>';
          unset($_SESSION['successMessage']); 
        }
        ?>
      </div>
    </div>
  </section>
  
</body>
</html>