<?php
if (isset($_POST['create_user'])) {
    // $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('const' => 10));
    $query = $conn->prepare("INSERT INTO users (user_firstname, user_lastname, user_role, username, user_email, user_password)
                                        VALUES (:user_firstname,:user_lastname,:user_role,:username,:user_email,:user_password)");
    $query->bindValue(':user_firstname', $user_firstname, PDO::PARAM_STR);
    $query->bindValue(':user_lastname', $user_lastname, PDO::PARAM_STR);
    $query->bindValue(':user_role', $user_role, PDO::PARAM_STR);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
    $query->bindValue(':user_password', $hash_password, PDO::PARAM_STR);
    if ($query->execute()) {
        echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        user has been created <a class=' text-dark' href='users.php'>Go to users table?</a>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    // header('Location:users.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="mb-3">
        <label class="form-label">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <!-- Select category -->
    <div class="mb-3">
        <label class="form-label">User role</label>
        <select name="user_role" class="form-select" aria-label="Default select example">
            <option value="subscriber">Select an option</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    <!-- <div class="mb-3">
        <label class="form-label">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div> -->
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
</form>