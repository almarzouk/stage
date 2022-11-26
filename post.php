<?php include './inc/header.php';
include './inc/db.php' ?>
<!-- Responsive navbar-->
<?php include './inc/navbar.php' ?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <?php if (isset($_GET['p_id'])) : ?>
                    <?php
                    $the_post_id = $_GET['p_id'];
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    $stat = $conn->query($query);
                    $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($result as $post) : ?>
                        <?php
                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_user = $post['post_user'];
                        $post_date = $post['post_date'];
                        $post_image = $post['post_image'];
                        $post_content = $post['post_content'];
                        $post_cat_id = $post['post_cat_id'];
                        $post_tags = $post['post_tags'];
                        $post_status = $post['post_status'];
                        ?>
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post_title ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?= $post_date ?> by <?= $post_user ?></div>
                            <!-- Post categories-->
                            <?php
                            $query = "SELECT * FROM categories WHERE cat_id = '$post_cat_id'";
                            $stat = $conn->query($query);
                            $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $cat) {
                                $cat_id = $cat['cat_id'];
                                $cat_title = $cat['cat_title'];
                                echo "<a class='badge bg-secondary text-decoration-none link-light' href='./category.php?category=$cat_id'>$cat_title</a>";
                            }
                            ?>

                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="/blog/images/<?= $post_image ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4 w-100"><?= $post_content ?></p>
                        </section>
                    <?php endforeach ?>
                <?php endif; ?>
                <!-- Comment form-->
                <?php
                // Select the current comment from db
                if (isset($_POST['create_comment'])) {
                    // $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    $query = $conn->prepare("INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content,comment_status) 
                                                            VALUES(:comment_post_id,:comment_author,:comment_email,:comment_content,:comment_status)");
                    $query->bindValue(':comment_post_id', $the_post_id, PDO::PARAM_STR);
                    $query->bindValue(':comment_author', $comment_author, PDO::PARAM_STR);
                    $query->bindValue(':comment_email', $comment_email, PDO::PARAM_STR);
                    $query->bindValue(':comment_content', $comment_content, PDO::PARAM_STR);
                    $query->bindValue(':comment_status', "unapproved", PDO::PARAM_STR);
                    $query->execute();
                }
                ?>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <form method="post" action="" class="mb-4">
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" name="comment_author" require>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="comment_email" require>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Leave a comment</label>
                                <textarea require name="comment_content" class="form-control mb-2" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" name="create_comment" value="submit">
                        </form>
                        <!-- Comment with nested comments-->
                        <hr>
                        <!-- Single comment-->

                        <?php
                        $query = "SELECT * from comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ORDER By comment_id DESC";
                        $stat = $conn->query($query);
                        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($result as $comment) : ?>
                            <?php
                            $comment_author = $comment['comment_author'];
                            $comment_content = $comment['comment_content'];
                            $comment_date = $comment['comment_date'];
                            ?>
                            <div class="d-flex bg-white  rounded p-3 mt-3 mb-3">
                                <div class="ms-3">
                                    <p class="text-secondary m-0 p-0"><?= $comment_date ?></p>
                                    <div class="fw-bold fs-5"><?= $comment_author ?></div>
                                    <p><?= $comment_content ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->

        <?php include './inc/sidebar.php' ?>
        <?php include './inc/widget.php' ?>
    </div>
</div>

<?php include './inc/footer.php' ?>