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
    $user_type = $_POST['user_type'];

    // Create new user
    createUser($email, $password, $user_type);

    // Redirect to login page
    header('Location: login.php');
    exit();
  } else {
    // Generate CSRF token
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
</head>
<body>
  <h1>Registration</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="user_type">User Type:</label>
    <select name="user_type" id="user_type" required>
      <option value="user">User</option>
      <option value="operator">Operator</option>
    </select>
    <br>
    <input type="submit" value="Register">
  </form>
</body>
</html>
