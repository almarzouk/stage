<?php include './inc/header.php';
include './inc/db.php' ?>
<!-- Responsive navbar-->
<?php include './inc/navbar.php' ?>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <!-- looping for the posts -->
            <?php
            if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];
            }
            $query = "SELECT * FROM posts WHERE post_cat_id = $post_category_id";
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
                $post_tags = $post['post_tags'];
                $post_comment_count = $post['post_comment_count'];
                $post_status = $post['post_status'];
                $post_view_count = $post['post_view_count'];
                ?>
                <div class="card mb-4 bordered">
                    <a href="post.php?p_id=<?= $post_id ?>"><img class="card-img-top" src="./images/<?= $post_image ?>" alt="..." /></a>
                    <div class="card-body">
                        <a href="post.php?p_id=<?= $post_id ?>" class="card-title h2 mb-3 text-decoration-none"><?= $post_title ?></a>
                        <div class="small text-muted mb-3 mt-3">by: <a href="author_posts.php?author=<?= $post_user ?>&p_id=<?= $post_id ?>"><?= $post_user ?></a></div>
                        <p class="card-text">date: <?= $post_date ?></p>
                        <p class="card-text text-secondary">status: <?= $post_status ?></p>
                        <p href="#" class="card-text p d-block mb-3 text-decoration-none"><?= $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read more →</a>
                    </div>
                </div>
                <!-- First Blog Post -->
            <?php endforeach; ?>
        </div>
        <?php include './inc/sidebar.php' ?>
        <!-- Side widget-->
        <?php include './inc/widget.php' ?>
    </div>
</div>
</div>
<!-- Footer-->
<?php include './inc/footer.php' ?>