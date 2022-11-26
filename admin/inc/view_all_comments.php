<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $commentValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'approved':
                $query = $conn->prepare("UPDATE comments SET comment_status = 'approved' WHERE comment_id = $commentValueId");
                $query->execute();
                break;
            case 'unapproved':
                $query = $conn->prepare("UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $commentValueId");
                $query->execute();
                break;
            case 'delete':
                $query = $conn->prepare("DELETE FROM comments WHERE comment_id = $commentValueId");
                $query->execute();
                break;
        }
    }
}
?>
<form action="" method="post">
    <div class="card text-bg-light mb-3 shadow">
        <div class="card-header">Comments</div>
        <div class="card-body ">
            <div class="d-flex justify-content-start align-items-center mb-3 mt-3">
                <select class="form-select  w-25 me-5" aria-label="Default select example" name="bulk_options">
                    <option class="dropdown-item" value="">select an option</option>
                    <option class="dropdown-item" value="approved">Approve</option>
                    <option class="dropdown-item" value="unapproved">Unapproved</option>
                    <option class="dropdown-item" value="delete">Delete</option>
                </select>
                <div class="btn btn-dark me-2 d-flex justify-content-start align-items-center pt-1 pb-1">
                    <i class="fa-solid fa-check p-0"></i>
                    <input class="bg-dark border-0 text-white" type="submit" value="Apply" onClick="javascript: return confirm('Are you sure?')">
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col"><input type="checkbox" id="selectAllBoxex"></th>
                        <th scope="col">ID</th>
                        <th scope="col">Author</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">In Resonse to</th>
                        <th scope="col">Date</th>
                        <th scope="col">Approve</th>
                        <th scope="col">Unapprove</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- delete post -->
                    <?php
                    if (isset($_GET['delete'])) {
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            $the_comment_id = $_GET['delete'];
                            $query = $conn->prepare("DELETE FROM comments WHERE comment_id = $the_comment_id");
                            $query->execute();
                            header('Location:comments.php');
                        }
                    }
                    if (isset($_GET['unapprove'])) {
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            $the_comment_id = $_GET['unapprove'];
                            $query = $conn->prepare("UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id");
                            $query->execute();
                            header('Location:comments.php');
                        }
                    }
                    if (isset($_GET['approve'])) {
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            $the_comment_id =  $_GET['approve'];
                            $query = $conn->prepare("UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id");
                            $query->execute();
                            header('Location:comments.php');
                        }
                    }
                    ?>

                    <?php
                    $query = "SELECT * FROM comments";
                    $stat = $conn->query($query);
                    $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $comment) {
                        $comment_id = $comment['comment_id'];
                        $comment_post_id = $comment['comment_post_id'];
                        $comment_author = $comment['comment_author'];
                        $comment_email = $comment['comment_email'];
                        $comment_content = $comment['comment_content'];
                        $comment_status = $comment['comment_status'];
                        $comment_date = $comment['comment_date'];
                        echo "<tr>";
                    ?>
                        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?= $comment_id ?>'></td>
                    <?php
                        echo "<td>$comment_id</td>";
                        echo "<td>$comment_author</td>";
                        echo "<td>$comment_content</td>";
                        echo "<td>$comment_email</td>";
                        echo "<td>$comment_status</td>";
                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                        $stat = $conn->query($query);
                        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $select_post) {
                            $post_id = $select_post['post_id'];
                            $post_title = $select_post['post_title'];
                            echo "<td><a class='text-decoration-none' href='../post.php?p_id=$post_id'>$post_title</a></td>";
                        }
                        echo  "<td>$comment_date</td>";
                        echo  "<td>
            <a class='btn btn-success' href='comments.php?approve=$comment_id'>Approve</a>
            </td>";
                        echo  "<td>
            <a class='btn btn-warning' href='comments.php?unapprove=$comment_id'>unapprove</a>
            </td>";
                        echo  "<td>
            <a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete the comment?')\" href='comments.php?delete=$comment_id'>Delete</a>
            </td>";
                        echo "</tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</form>