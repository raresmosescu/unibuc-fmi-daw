<?php
  // Include user CRUD functions
  require_once 'data/user_crud.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF token check
    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
      die('Invalid CSRF token');
    }

    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists and password is correct
    if (checkUserCredentials($email, $password)) {
      // // Unset session user_email so a n
      // unset($_SESSION['user_email']);

      // Start user session
      $_SESSION['user_email'] = $email;
      // Redirect to protected page
      header('Location: index.php');
      exit();
    } else {
      $error = 'Invalid email or password';
    }
  } else {
    // Generate CSRF token
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" value="Login">
  </form>
  <?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>
</body>
</html>
