<?php
if (isset($_POST['create_post'])) {
    $post_user = $_POST['post_user'];
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    // uploading image
    $post_image = $_FILES['image']['name'];
    // temp
    $post_image_temp = $_FILES['image']['tmp_name'];
    // finishing uploading
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // moving the image from temp to the folder images
    move_uploaded_file($post_image_temp, "../images/$post_image");
    // make the query
    $query = $conn->prepare("INSERT INTO posts (post_cat_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status)
                                        VALUES (:post_cat_id, :post_title, :post_user, :post_date, :post_image, :post_content, :post_tags, :post_status)");
    // Send the query to database
    $query->bindValue(':post_cat_id', $post_category_id, PDO::PARAM_STR);
    $query->bindValue(':post_title', $post_title, PDO::PARAM_STR);
    $query->bindValue(':post_user', $post_user, PDO::PARAM_STR);
    $query->bindValue(':post_date', $post_date, PDO::PARAM_STR);
    $query->bindValue(':post_image', $post_image, PDO::PARAM_STR);
    $query->bindValue(':post_content', $post_content, PDO::PARAM_STR);
    $query->bindValue(':post_tags', $post_tags, PDO::PARAM_STR);
    $query->bindValue(':post_status', $post_status, PDO::PARAM_STR);
    if ($query->execute()) {
        $the_post_id = $conn->lastInsertId();
        echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        post has been created <a class='text-dark' href='posts.php'>Go to posts table?</a> Or  <a class='text-dark' href='../post.php?p_id=$the_post_id'>View the post?</a>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}
?>
<div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <!-- Select category -->

        <div class="mb-3">
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
            <!-- Select user -->
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
            <input type="text" class="form-control" name="author">
        </div> -->
        <div class="mb-3">
            <label class="form-label">Post Status</label>
            <select name="post_status" class="form-select" aria-label="Default select example">
                <option value="select an option">select an option</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Content</label>
            <textarea class="form-control" id="summernote" name="post_content"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post">
    </form>

</div>