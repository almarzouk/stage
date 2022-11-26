<?php include 'inc/header.php'; ?>
<?php include 'inc/navbar.php' ?>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
}
if (isset($_POST['edit_profile'])) {
    $post_firstname = $_POST['user_firstname'];
    $post_lastname = $_POST['user_lastname'];
    $postname = $_POST['username'];
    $post_password = $_POST['user_password'];
    $post_email = $_POST['user_email'];
    $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('const' => 10));
    // query
    $query = $conn->prepare("UPDATE `users` SET
    user_firstname = :post_firstname, 
    user_lastname = :post_lastname,
    username = :postname,
    user_password = :hash_password, 
    user_email = :post_email
    WHERE username = :postname");
    $query->bindValue(':post_firstname', $post_firstname, PDO::PARAM_STR);
    $query->bindValue(':post_lastname', $post_lastname, PDO::PARAM_STR);
    $query->bindValue(':postname', $postname, PDO::PARAM_STR);
    $query->bindValue(':post_email', $post_email, PDO::PARAM_STR);
    $query->bindValue(':hash_password', $hash_password, PDO::PARAM_STR);
    if ($query->execute()) {
        " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        user has been edited 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
        header('Location:profile.php');
    }
}
?>
<!-- Form to add category Start-->
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="text-center bg-light">
                <h3 class="p-5">welcome <?= strtoupper($_SESSION['username']) ?> to your dashboard</h3>
            </div>
            <!-- insert  the form -->
            <div class="card text-bg-light m-3 shadow">
                <div class="card-header">Edit Your Profile</div>
                <div class="card-body  px-4">
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
                            <div class="mb-3">
                                <input value="<?= $user_role ?>" type="text" disabled class="form-control" name="username">
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
                            <input type="submit" class="btn btn-primary" name="edit_profile" value="Edit Profile">
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Form to add category End-->
<?php include 'inc/footer.php'; ?>