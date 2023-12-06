<?php
  session_start();

  if(isset($_POST['submit'])) {
    $token = $_POST["token"];
    $pass = $_POST["pword"];

    $token_hash = hash("sha256", $token);

    $mysqli = require __DIR__ . "/database_mysqli.php";

    $sql = "SELECT * FROM logcredentials
            WHERE reset_token_hash = ?";

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("s", $token_hash);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    $errorMessages = array();

    if ($user === null) {
        $errorMessages[] = "User not found";
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        $errorMessages[] = "Session Expired";
    }

    if (strlen($pass) < 8) {
        $errorMessages[] = "Password must be at least 8 characters";
    }

    if (!preg_match("/[a-z]/i", $pass)) {
        $errorMessages[] = "Password must contain at least one letter";
    }

    if (!preg_match("/[0-9]/", $pass)) {
        $errorMessages[] = "Password must contain at least one number";
    }

    if ($pass !== $_POST["cpword"]) {
        $errorMessages[] = "Passwords must match";
    }

    if (!empty($errorMessages)) {
        // Store error messages in session variable
        $_SESSION['errorMessages'] = $errorMessages;
        header("Location: reset-password.php?token=$token"); 
        exit();
    } else {
        $sql = "UPDATE logcredentials
                SET password = ?,
                    reset_token_hash = NULL,
                    reset_token_expires_at = NULL
                WHERE logID = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("ss", $pass, $user["logID"]);

        $stmt->execute();

        $_SESSION['successMessage'] = "Password updated. You can now login.";
        header('Location: signin.php');
        exit();
    }

    echo "Token: " . $token . "<br>";
    echo "Hash: " . $token_hash . "<br>";
    var_dump($user);
  }
?>
