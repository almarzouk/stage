<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $userValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'admin':
                $query = $conn->prepare("UPDATE users SET user_role = 'admin' WHERE user_id = $userValueId");
                $query->execute();
                break;
            case 'subscriber':
                $query = $conn->prepare("UPDATE users SET user_role = 'subscriber' WHERE user_id = $userValueId");
                $query->execute();
                break;
            case 'delete':
                $query = $conn->prepare("DELETE FROM users WHERE user_id = $userValueId");
                $query->execute();
                break;
        }
    }
}
$pre_page = 4;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

if ($page == '' || $page == 1) {
    $page_1 = 0;
} else {
    $page_1 = ($page * $pre_page) - $pre_page;
}
?>
<form action="" method="post">
    <div class="card-body">
        <div class="d-flex justify-content-start align-items-center mb-3 mt-3">
            <select class="form-select  w-25 me-5" aria-label="Default select example" name="bulk_options">
                <option class="dropdown-item" value="">select an option</option>
                <option class="dropdown-item" value="admin">Admin</option>
                <option class="dropdown-item" value="subscriber">Subscriber</option>
                <option class="dropdown-item" value="delete">Delete</option>
            </select>
            <div class="btn btn-dark me-2 d-flex justify-content-start align-items-center pt-1 pb-1">
                <i class="fa-solid fa-check p-0"></i>
                <input class="bg-dark border-0 text-white" type="submit" value="Apply" onClick="javascript: return confirm('Are you sure?')">
            </div>
            <a class="btn btn-primary pt-1 pb-1" href="users.php?source=add_user"><i class="fa-solid fa-plus"></i> add new </a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="selectAllBoxex"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Change to Admin</th>
                    <th scope="col">Change to subscriber</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- delete post -->
                <?php
                // Delte user
                if (isset($_GET['delete'])) {
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $the_user_id = $_GET['delete'];
                        $query = $conn->prepare("DELETE FROM users WHERE user_id = $the_user_id");
                        $query->execute();
                        header('Location:users.php');
                    }
                }
                // Change role to admin
                if (isset($_GET['change_to_admin'])) {
                    $the_user_id = $_GET['change_to_admin'];
                    $query = $conn->prepare("UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id");
                    $query->execute();
                    header('Location:users.php');
                }
                // Change role to subscriber
                if (isset($_GET['change_to_sub'])) {
                    $the_user_id = $_GET['change_to_sub'];
                    $query = $conn->prepare("UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id");
                    $query->execute();
                    header('Location:users.php');
                }
                ?>
                <?php
                $query = "SELECT * FROM users";
                $stat = $conn->query($query);
                $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $user) {
                    $user_id = $user['user_id'];
                    $username = $user['username'];
                    $user_password = $user['user_password'];
                    $user_firstname = $user['user_firstname'];
                    $user_lastname = $user['user_lastname'];
                    $user_email = $user['user_email'];
                    $user_image = $user['user_image'];
                    $user_role = $user['user_role'];
                    echo "<tr>";
                ?>
                    <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?= $user_id ?>'></td>
                <?php
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>";
                    echo "<td>$user_lastname</td>";
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";
                    echo  "<td>
            <a class='btn btn-success' href='users.php?change_to_admin=$user_id'>Admin</a>
            </td>";
                    echo  "<td>
            <a class='btn btn-warning' href='users.php?change_to_sub=$user_id'>Subscriber</a>
            </td>";
                    echo  "<td>
            <a class='btn btn-primary' href='users.php?source=edit_user&edit_user=$user_id'>Edit <i class='fa-solid fa-pen-to-square'></i></a>
            <a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete the user?')\" href='users.php?delete=$user_id'>Delete <i class='fa-solid fa-trash'></i></a>
            </td>";
                    echo "</tr>";
                } ?>
            </tbody>
        </table>
</form>