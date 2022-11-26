<?php
include 'db.php';
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}
$query = $conn->query("SELECT * FROM users WHERE username = '$username'");
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$count = $query->rowCount();
foreach ($result as $user) {
    $db_user_id = $user['user_id'];
    $db_password = $user['user_password'];
    $db_username = $user['username'];
    $db_user_firstname = $user['user_firstname'];
    $db_user_lastname = $user['user_lastname'];
    $db_user_role = $user['user_role'];
}
// encrypting the password
if (password_verify($password, $db_password)) {
    $_SESSION['username'] = $db_username;
    $_SESSION['user_id'] = $db_id;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;
    header('Location:../index.php');
} else {
    header('Location:../index.php');
}
