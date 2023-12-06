<?php
  session_start(); // Start the session to access session variables

  $token = $_GET["token"];

  $token_hash = hash("sha256", $token);

  $mysqli = require __DIR__ . "/database_mysqli.php";

  $sql = "SELECT * FROM logcredentials
            WHERE reset_token_hash = ?";

  $stmt = $mysqli->prepare($sql);

  $stmt->bind_param("s", $token_hash);

  $stmt->execute();

  $result = $stmt->get_result();

  $email = $result->fetch_assoc();
  date_default_timezone_set('Asia/Manila');

  if ($email === null) {
      //echo '<script>console.error("Token not found");</script>';
      die("Oops! There was an Error.");
  }

  //var_dump($email);

  //echo "Token: " . $token . "<br>";
  //echo "Hash: " . $token_hash;

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
<script>
    <?php
      if ($email === null) {
          echo 'alert("Oops! There was an error with the link.");';
          echo 'window.location.href = "signin.php";'; 
        }
        if (strtotime($email["reset_token_expires_at"]) <= time()) {
            echo 'alert("Link has expired. Please request a new password reset link.");';
            echo 'window.location.href = "signin.php";'; 
        }
    ?>
    </script>
  <section>
    <div class="form-box">
      <div class="changepass_box">
        <form method="post" action="process-reset-password.php">
          <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
          <h2>Reset Password</h2>
          <div class="inputbox3">
            <input type="password" name="pword"required>
            <label for="">New Password</label>
          </div>
          <div class="inputbox3">
            <input type="password" name="cpword" required>
            <label for="">Confirm Password</label>
          </div>
          <button type="submit" name="submit">Change Password</button>
        </form>
      </div>
      <div>
        <?php
          // Display error messages if set
          if (isset($_SESSION['errorMessages']) && !empty($_SESSION['errorMessages'])) {
            echo '<div class="error-message">Error(s) occurred:<ul>';
            foreach ($_SESSION['errorMessages'] as $errorMessage) {
              echo '<li>' . $errorMessage . '</li>';
            }
            echo '</ul></div>';
            unset($_SESSION['errorMessages']); // Clear the session variable
          }
        ?>
      </div>
    </div>
  </section>
</body>
</html>
