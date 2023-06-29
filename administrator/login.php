<?php
session_start();
require_once('dbconfig.php');

// Check if the form is submitted
function redirect($location)
{
    header("Location: " . $location);
    exit();
}
if (isset($_POST['loginAdmin'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $query = "SELECT * FROM account WHERE email = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $statement->close();

        if ($password === $user['password']) {
            if ($user['permission'] === 1) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['permission'] = $user['permission'];
                redirect("index.php");
            } else {
                redirect("login.php");
            }
        }
    } else {
        redirect("login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <form class="login-form" action="login.php" method="POST">
            <h2>Administrator Login</h2>
            <div class="form-group">
                <label for="emailLabel">Email :</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="passwordLabel">Password :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="loginAdmin" name="loginAdmin">Login</button>
        </form>
    </div>
</body>

</html>