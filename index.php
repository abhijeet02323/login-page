<?php
session_start();

// Load existing users from a file
$users = json_decode(file_get_contents('users.json'), true);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // Check if username and password match
    if (isset($users[$username]) && 
        $users[$username]['password'] == $password && 
        $users[$username]['email'] == $email && 
        $users[$username]['mobile'] == $mobile) {
        
        // Save user details in the session
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid credentials. Please check your details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="mobile">Mobile Number:</label>
        <input type="text" name="mobile" id="mobile" required><br><br>

        <input type="submit" name="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="signup.php">Sign Up here</a>.</p>
</body>
</html>
