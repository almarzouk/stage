<?php
function insert_categories()
{
    global $conn;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == '' || empty($cat_title)) {
            echo "<div class='alert alert-warning' role='alert'>";
            echo "<h3>";
            echo "This field should not be empty!";
            echo "</h3>";
            echo "</div>";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
            $statement = $conn->prepare($query);
            $statement->execute();
        }
    }
};

function findAllCategories()
{
    global $conn;
    $query = "SELECT * FROM categories";
    $stat = $conn->query($query);
    $result = $stat->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $item) {
        $cat_id = $item['cat_id'];
        $cat_title = $item['cat_title'];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo " <td>$cat_title</td>";
        echo " <td><a class='btn btn-danger me-2' href='categories.php?delete=$cat_id'>Delete</a>";
        echo " <a class='btn btn-primary' href='categories.php?edit=$cat_id'>Edit</a>";
        echo " </td>";
        echo " </tr>";
    }
}

function deleteCategory()
{
    global $conn;

    if (isset($_GET['delete'])) {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            $id_cat =  $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = '$id_cat'";
            $statement = $conn->prepare($query);
            $statement->execute();
            header('Location: categories.php');
        }
    }
}


function is_admin($username)
{
    global $conn;
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $stat = $conn->query($query);
    $result = $stat->fetch(PDO::FETCH_ASSOC);
    if ($result['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}
