<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}
// Dispaly the data in the form
$query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";
$stat = $conn->query($query);
$result = $stat->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $post) {
    $post_id = $post['post_id'];
    $post_user = $post['post_user'];
    $post_title = $post['post_title'];
    $post_status = $post['post_status'];
    $post_image = $post['post_image'];
    $post_tags = $post['post_tags'];
    $post_content = $post['post_content'];
    $post_comment_count = $post['post_comment_count'];
    $post_date = $post['post_date'];
}
// submit the data to data base
if (isset($_POST['edit_post'])) {
    $post_user = $_POST['post_user'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_date = date('d-m-y');
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        $query = $conn->query("SELECT * FROM posts WHERE post_id = '$the_post_id'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $image) {
            $post_image = $image['post_image'];
        }
    }

    $query = $conn->prepare("UPDATE `posts` SET post_cat_id = :post_cat_id, post_title =:post_title, post_user =:post_user, post_image = :post_image, post_content =:post_content, post_tags=:post_tags, post_status=:post_status, post_date = :post_date WHERE post_id = $the_post_id");
    $query->bindValue(':post_cat_id', $post_category_id, PDO::PARAM_STR);
    $query->bindValue(':post_title', $post_title, PDO::PARAM_STR);
    $query->bindValue(':post_user', $post_user, PDO::PARAM_STR);
    $query->bindValue(':post_date', $post_date, PDO::PARAM_STR);
    $query->bindValue(':post_image', $post_image, PDO::PARAM_STR);
    $query->bindValue(':post_content', $post_content, PDO::PARAM_STR);
    $query->bindValue(':post_tags', $post_tags, PDO::PARAM_STR);
    $query->bindValue(':post_status', $post_status, PDO::PARAM_STR);
    if ($query->execute()) {
        echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        post has been edited <a class=' text-dark' href='../post.php?p_id=$post_id'>View the post</a>
        or  <a class=' text-dark' href='posts.php'>Go to posts table</a>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    } else {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // header('Location:posts.php');
}
?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="title">
    </div>
    <div class="mb-3">

        <!-- Select category -->
        <label class="form-label">Post Category</label>
        <select name="post_category" class="form-select" aria-label="Default select example">
            <?php
            $query = "SELECT * FROM categories";
            $stat = $conn->query($query);
            $result = $stat->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($result as $item) : ?>
                <?php
                $cat_id = $item['cat_id'];
                $cat_title = $item['cat_title'];
                ?>
                <option value="<?= $cat_id ?>"><?= $cat_title ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <!-- Select category -->
        <label class="form-label">Post user</label>
        <select name="post_user" class="form-select" aria-label="Default select example">
            <?php
            $query = "SELECT * FROM users";
            $stat = $conn->query($query);
            $result = $stat->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($result as $user) : ?>
                <?php
                $user_id = $user['user_id'];
                $username = $user['username'];
                ?>
                <option value="<?= $username ?>"><?= $username ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!-- <div class="mb-3">
        <label class="form-label">Post Author</label>
        <input value="" type="text" class="form-control" name="author">
    </div> -->
    <div class="mb-3">
        <label class="form-label">Post Status</label>
        <select name="post_status" class="form-select" aria-label="Default select example">
            <option value="<?= $post_status ?>"><?= $post_status ?></option>
            <?php
            if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Published</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label d-block">Post Image</label>
        <img class="mb-3" src="../images/<?= $post_image ?>" alt="" style="
    max-width: 100px;
">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="mb-3">
        <label class="form-label">Post Tags</label>
        <input value="<?= $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Post Content</label>
        <textarea class="form-control" id="summernote" rows="3" name="post_content"><?= $post_content ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit">
</form>