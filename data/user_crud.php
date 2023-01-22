<?php
  /**
  bind_param() is used in prepared statements to bind variables to a prepared statement.

  When you use a prepared statement, you first create the statement with placeholders for the values, then you bind the actual values to the placeholders. This allows you to separate the data from the SQL statement, and helps to prevent SQL injection attacks.

  The bind_param() function takes two or more arguments:

  - the first argument is a string that specifies the data types of the variables to be bound,
  - and the following arguments are the variables themselves.
  The data type string is a single-letter abbreviation for the data type. For example, "s" for string, "i" for integer, and "d" for double. This is the way the function knows how to treat the values before inserting it into the query. 
  */

  require("database.php");

  function createUser($email, $password, $user_type) {
    global $db;
    // validate inputs
    $email = mysqli_real_escape_string($db, $email);
    $user_type = mysqli_real_escape_string($db, $user_type);
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Insert new user into database using prepared statement
    $stmt = $db->prepare("INSERT INTO user (email, password, user_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password, $user_type);
    $stmt->execute();
    $stmt->close();
  }

  function readUser($username) {
    global $db;
    // validate inputs
    $username = mysqli_real_escape_string($db, $username);
    // Retrieve user from database using prepared statement
    $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
  }

  function updateUser($username, $password, $email, $user_type) {
    global $db;
    // Connect to database
    // validate inputs
    $username = mysqli_real_escape_string($db, $username);
    $email = mysqli_real_escape_string($db, $email);
    $user_type = mysqli_real_escape_string($db, $user_type);
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Update user in database using prepared statement
    $stmt = $db->prepare("UPDATE user SET password = ?, email = ?, user_type = ? WHERE username = ?");
    $stmt->bind_param("ssss", $password, $email, $user_type, $username);
    $stmt->execute();
    $stmt->close();
  }

  function deleteUser($username) {
    global $db;
    // validate inputs
    $username = mysqli_real_escape_string($db, $username);
    // Delete user from database using prepared statement
    $stmt = $db->prepare("DELETE FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
  }

  function checkUserCredentials($email, $password) {
    global $db;
    // validate inputs
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    // Retrieve user from database using prepared statement
    $stmt = $db->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
      return true;
    } else {
      return false;
    }
  }

  function getUserType($email) {
    global $db;
    $stmt = $db->prepare("SELECT user_type FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_type = $result->fetch_assoc()['user_type'];
    $stmt->close();
    return $user_type;
  }


?>
