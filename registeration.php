<?php include './inc/header.php';
include './inc/db.php' ?>
<!-- Responsive navbar-->
<?php include './inc/navbar.php' ?>
<?php include './admin/inc/functions.php' ?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($email) && !empty($password)) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT, array('const' => 11));
        // create user
        $query = $conn->prepare("INSERT INTO users (user_role, username, user_email, user_password)
                                     VALUES (:user_role,:username,:email,:user_password)");
        // Send the query to database
        $query->bindValue(':user_role', 'subscriber', PDO::PARAM_STR);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':user_password', $hash_password, PDO::PARAM_STR);
        if ($query->execute()) {
            echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Your account has been created
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    } else {
        echo "<script>alert('Make sure there is no empty field')</script>";
    }
}
?>
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow w-75 h-100">
        <div class="card-header">register</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
        </div>
    </div>
</div>
<?php include './inc/footer.php' ?>