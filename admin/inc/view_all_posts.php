<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $query = $conn->prepare("UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValueId");
                $query->execute();
                break;
            case 'draft':
                $query = $conn->prepare("UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValueId");
                $query->execute();
                break;
            case 'delete':
                $query = $conn->prepare("DELETE FROM posts WHERE post_id = $postValueId");
                $query->execute();
                break;
        }
    }
}
?>
<form action="" method="post">
    <!-- To select elements -->
    <div class="d-flex justify-content-start align-items-center mb-3 mt-3">
        <select class="form-select  w-25 me-5" aria-label="Default select example" name="bulk_options">
            <option class="dropdown-item" value="">select an option</option>
            <option class="dropdown-item" value="published">Publish</option>
            <option class="dropdown-item" value="draft">Draft</option>
            <option class="dropdown-item" value="delete">Delete</option>
        </select>
        <div class="btn btn-dark me-2 d-flex justify-content-start align-items-center pt-1 pb-1">
            <i class="fa-solid fa-check p-0"></i>
            <input class="bg-dark border-0 text-white" type="submit" value="Apply">
        </div>
        <a class="btn btn-primary pt-1 pb-1" href="posts.php?source=add_post"><i class="fa-solid fa-plus"></i> add new </a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" id="selectAllBoxex"></th>
                <th scope="col">ID</th>
                <th scope="col">Author</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col" style="width: 154px;">Tags</th>
                <th scope="col" style="min-width: 107px;">Date</th>
                <th>View</th>
                <th scope="col" style="min-width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- delete post -->
            <?php
            if (isset($_GET['delete'])) {
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $the_post_id = $_GET['delete'];
                    $query = $conn->prepare("DELETE FROM posts WHERE post_id =$the_post_id");
                    $query->execute();
                    header("Location:posts.php");
                }
            }
            ?>
            <?php
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $stat = $conn->query($query);
            $result = $stat->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $post) {
                $post_id = $post['post_id'];
                $post_user = $post['post_user'];
                $post_author = $post['post_author'];
                $post_title = $post['post_title'];
                $post_cat_id = $post['post_cat_id'];
                $post_status = $post['post_status'];
                $post_image = $post['post_image'];
                $post_tags = $post['post_tags'];
                $post_date = $post['post_date'];
                echo "<tr>";
            ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?= $post_id ?>'></td>
            <?php
                echo "<td>$post_id</td>";
                if (isset($post_author) || !empty($post_author)) {
                    echo "<td>$post_author</td>";
                } elseif (isset($post_user) || !empty($post_user)) {
                    echo "<td>$post_user</td>";
                }
                echo substr("<td>$post_title</td>", 0, 35);
                // to get category tite
                $query = "SELECT * FROM categories WHERE cat_id = $post_cat_id";
                $stat = $conn->query($query);
                $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $cat) {
                    $cat_id = $cat['cat_id'];
                    $cat_title = $cat['cat_title'];
                    echo "<td>$cat_title</td>";
                }
                // to get category title
                echo "<td>$post_status</td>";
                echo "<td><img class='img-fluid' src='../images/$post_image' style='max-width: 160px;'></td>";
                echo "<td>$post_tags</td>";
                echo  "<td>$post_date</td>";
                echo  "<td style='
                min-width: 141px;
            '><a class='btn btn-success' href='../post.php?p_id=$post_id'>view post <i class='fa-solid fa-eye'></i></a></td>";
                echo  "<td>
                <a class='btn btn-primary' href='posts.php?source=edit_post&p_id=$post_id'>Edit <i class='fa-solid fa-pen-to-square'></i></a>
                <a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete the post?')\"  href='posts.php?delete=$post_id'>Delete <i class='fa-solid fa-trash'></i></a>
                </td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        </ul>
    </nav>
    </div>
</form>