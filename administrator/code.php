<?php

require_once 'dbconfig.php';

session_start();

function redirect($location)
{
    header("Location: " . $location);
    exit();
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $permission = 0;
    $password = hash('sha256', $_POST['password']);

    $query = "SELECT * FROM account WHERE email = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "User with the same email already exists!";
        redirect("../index.php");
    }
    $query = "INSERT INTO account (name, email, password, permission) VALUES (?, ?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("sssi", $name, $email, $password, $permission);
    if ($statement->execute()) {
        $_SESSION['message'] = "Registration successful! You can now log in.";
        redirect("../index.php");
    } else {
        $_SESSION['message'] = "Error occurred while registering!";
        redirect("../index.php");
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['passwordLogin']);

    $query = "SELECT * FROM account WHERE email = ?";
    $statement = $db->prepare($query);
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $statement->close();

        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['message'] = "Successfully login as " . $_SESSION['name'];
            redirect("../index.php");
        }
    } else {
        $_SESSION['message'] = "Invalid email or password!";
        redirect("../index.php");
    }
}
if (isset($_POST['logout'])) {
    $_SESSION['message'] = "Successfully Logged Out!";
    header("Location: ../index.php");
    session_destroy();
}

if (isset($_POST['submitBook'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $idCard = $_POST['idCard'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $roomType = $_POST['roomType'];

    $query = "INSERT INTO `order` (name, address, id_card, email, phone_number, room_type) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("ssssss", $name, $address, $idCard, $email, $phoneNumber, $roomType);
    if ($statement->execute()) {
        $_SESSION['message'] = "Booking successfully sent!";
        redirect("../book.php");
    } else {
        $_SESSION['message'] = "Error occurred while booking!";
        redirect("../book.php");
    }
}
if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO `comment` (name, email, message) VALUES (?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->bind_param("sss", $name, $email, $message);
    if ($statement->execute()) {
        $_SESSION['message'] = "Successfuly sended!";
        redirect("../index.php");
    } else {
        $_SESSION['message'] = "Error occurred while sending!";
        redirect("../index.php");
    }
}
