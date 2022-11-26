<?php

if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
}
$query = "SELECT * FROM users";
$stat = $conn->query($query);
$result = $stat->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $user) {
    $user_firstname = $user['user_firstname'];
    $user_lastname = $user['user_lastname'];
    $user_role = $user['user_role'];
    $username = $user['username'];
    $user_email = $user['user_email'];
    $user_password = $user['user_password'];
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('const' => 10));
    // make the query
    $query = $conn->prepare("UPDATE `users` SET user_firstname = :user_firstname, user_lastname = :user_lastname, user_role = :user_role, username = :username,user_password = :user_password, user_email = :user_email WHERE user_id = $the_user_id");
    // Send the query to database
    $query->bindValue(':user_firstname', $user_firstname, PDO::PARAM_STR);
    $query->bindValue(':user_lastname', $user_lastname, PDO::PARAM_STR);
    $query->bindValue(':user_role', $user_role, PDO::PARAM_STR);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':user_email', $user_email, PDO::PARAM_STR);
    $query->bindValue(':user_password', $user_password, PDO::PARAM_STR);
    if ($query->execute()) {
        echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        user has been edited <a class=' text-dark' href='users.php'>Go to users table?</a>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    header('Location:users.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Firstname</label>
        <input value="<?= $user_firstname ?>" type="text" class="form-control" name="user_firstname">
    </div>
    <div class="mb-3">
        <label class="form-label">Lastname</label>
        <input value="<?= $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>
    <!-- Select category -->
    <div class="mb-3">
        <label class="form-label">User role</label>
        <select name="user_role" class="form-select" aria-label="Default select example">
            <option value="<?= $user_role ?>"><?= $user_role ?></option>
            <?php if ($user_role == 'admin') : ?>
                <option value="subscriber">subscriber</option>
            <?php else : ?>
                <option value="admin">admin</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input value="<?= $username ?>" type="text" class="form-control" name="username">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input value="<?= $user_email ?>" type="text" class="form-control" name="user_email">
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input value="<?= $user_password ?>" type="text" class="form-control" name="user_password">
    </div>
    <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
</form>