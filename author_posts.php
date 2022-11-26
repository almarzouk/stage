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
                <?php
                if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                    $post_author = $_GET['author'];
                }
                $query = "SELECT * FROM posts WHERE post_user = '$post_author'";
                $select_all_posts = mysqli_query($conn, $query);
                $result = mysqli_fetch_all($select_all_posts, MYSQLI_ASSOC);
                ?>
                <?php foreach ($result as $post) : ?>
                    <?php
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_user = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = $post['post_content'];
                    $post_cat_id = $post['post_cat_id'];
                    $post_tags = $post['post_tags'];
                    $post_comment_count = $post['post_comment_count'];
                    $post_status = $post['post_status'];
                    $post_view_count = $post['post_view_count'];
                    ?>
                    <div class="card">
                        <header class="card-header">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post_title ?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?= $post_date ?> by <a href="author_posts.php"><?= $post_author ?></a></div>
                            <!-- Post categories-->
                            <?php

                            $cat_query = "SELECT * FROM categories WHERE cat_id = '$post_cat_id'";
                            $select_cat_id = mysqli_query($conn, $cat_query);
                            $cat_result = mysqli_fetch_all($select_cat_id, MYSQLI_ASSOC);
                            foreach ($cat_result as $cat) {
                                $cat_id = $cat['cat_id'];
                                $cat_title = $cat['cat_title'];
                                echo "<a class='badge bg-secondary text-decoration-none link-light' href='./category.php?category=$cat_id'>$cat_title</a>";
                            }

                            ?>

                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4 card-image"><img class="img-fluid rounded" src="./images/<?= $post_image ?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5 card-body">
                            <p class="fs-5 mb-4"><?= $post_content ?></p>
                        </section>
                    </div>
                <?php endforeach ?>
            </article>
            <!-- Comments section-->
            <!-- Delete it -->
        </div>
        <!-- Side widgets-->

        <?php include './inc/sidebar.php' ?>
        <?php include './inc/widget.php' ?>
    </div>
</div>

<?php include './inc/footer.php' ?>